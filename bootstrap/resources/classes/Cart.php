<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'../lib/Database.php');
include_once($filepath.'../helpers/Format.php');
 ?>
<?php 


class Cart
{
    
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $proId)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $proId = mysqli_real_escape_string($this->db->link, $proId);
        $sId = session_id();

        $squery = "SELECT * FROM menu WHERE menu_id = '$proId'";
        $result = $this->db->select($squery)->fetch_assoc();
        $productName = $result['menu_name'];
        $price = $result['menu_price'];
        $image = $result['menu_img'];

        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$proId' AND sId = '$sId'";
        $getPro = $this->db->select($chquery);

        if ($getPro) {
            $msg = "Product Already Added";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) VALUES('$sId', '$proId', '$productName', '$price', '$quantity', '$image')";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
				echo "<script>window.location = 'cart.php';</script>";
            } else {
				echo "<script>window.location = '404.php';</script>";
            }
        }
    }

    public function getCartProduct()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCartQuantity($cartId, $quantity)
    {
        $cartId     = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity   = mysqli_real_escape_string($this->db->link, $quantity);
        $query = "UPDATE tbl_cart
            SET
            quantity = '$quantity'
            WHERE cartId = '$cartId'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            echo "<script>window.location = 'cart.php';</script>";
        } else {
            $msg = "<span class='error'>Quantity Not Updated.</span>";
            return $msg;
        }
    }
    public function delProductByCart($delProId)
    {
        $delProId   = mysqli_real_escape_string($this->db->link, $delProId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$delProId'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            echo "<script>window.location = 'cart.php'; </script>";
        } else {
            $msg = "<span class='error'>Product Not Deleted!</span>";
            return $msg;
        }
    }

    public function checkCartItem()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCustomerCart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $this->db->delete($query);
    }

    public function orderProduct($cmrId,$orderCode,$optionsRadio)
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getPro = $this->db->select($query);
        if ($getPro) {
            while ($result = $getPro->fetch_assoc()) {
                $productId      = $result['productId'];
                $productName    = $result['productName'];
                $quantity       = $result['quantity'];
                $price          = $result['price'] * $quantity;
                $image          = $result['image'];
				$squery = "SELECT * FROM menu WHERE menu_id = '$productId'";
				$presult = $this->db->select($squery)->fetch_assoc();
				$menu_status = $presult['menu_status'];
				$productCode = $presult['menu_code'];
				if($menu_status == "deactivated"){
					echo "<script>window.location = 'cart.php'; </script>";
				}else{
                $query = "INSERT INTO tbl_order(orderCode,cmrId, productId, productName, productCode, quantity, price, image, paymentType) VALUES('$orderCode','$cmrId', '$productId', '$productName','$productCode', '$quantity', '$price', '$image','$optionsRadio')";
                $inserted_row = $this->db->insert($query);}
            }
        }
    }

    public function payableAmount($orderCode)
    {
        $query = "SELECT * FROM tbl_order WHERE orderCode = '$orderCode'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOrderProduct($cmrId)
    {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function checkOrder($cmrId)
    {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllOrderProduct()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function productShifted($id, $time, $price)
    {
        $id     = mysqli_real_escape_string($this->db->link, $id);
        $time   = mysqli_real_escape_string($this->db->link, $time);
        $price  = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order
            SET
            status = '1'
            WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Updated Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Not Updated.</span>";
            return $msg;
        }
    }

    public function delProductShifted($id, $time, $price)
    {
        $id     = mysqli_real_escape_string($this->db->link, $id);
        $time   = mysqli_real_escape_string($this->db->link, $time);
        $price  = mysqli_real_escape_string($this->db->link, $price);

        $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $deldata = $this->db->delete($query);
        if ($deldata) {
            $msg = "<span class='success'>Data Deleted Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data Not Deleted!</span>";
            return $msg;
        }
    }

    public function productShiftConfirm($id, $time, $price)
    {
        $id     = mysqli_real_escape_string($this->db->link, $id);
        $time   = mysqli_real_escape_string($this->db->link, $time);
        $price  = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order
            SET
            status = '2'
            WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Updated Successfully</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Not Updated.</span>";
            return $msg;
        }
    }
}
