<?php
use PHPMailer\PHPMailer\PHPMailer;
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 


class Customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data)
    {
        
		if(isset($_GET['from'])){
			$from="signin.php?from=".$_GET['from'];
		}else{
			$from="signin.php";
		}
        $firstname    	= $this->fm->validation($data['FirstName']);
		$lastname    	= $this->fm->validation($data['LastName']);
        $address    = $this->fm->validation($data['Address']);
        $email   	= $this->fm->validation($data['Email']);
        $phone   	= $this->fm->validation($data['tel']);
        $password  		= $this->fm->validation($data['Password']);

        $firstname  = mysqli_real_escape_string($this->db->link, $firstname);
		$lastname   = mysqli_real_escape_string($this->db->link, $lastname);
        $address 	= mysqli_real_escape_string($this->db->link, $address);
        $email 		= mysqli_real_escape_string($this->db->link, $email);
        $phone 		= mysqli_real_escape_string($this->db->link, $phone);
        $pass 		= mysqli_real_escape_string($this->db->link, password_hash($password, PASSWORD_BCRYPT));

       
        /* Email Validation */
      	if(!isset($message)) {
      	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      	$message = "Invalid Email, Please put a valid E-mail address";
      	$type = "error";
      	}
      	}
        if(!isset($message)) {
          $query = $this->db->select("SELECT DISTINCT * FROM `customers` WHERE cus_tel = '" . $phone . "'");
          if($query != false) {
            $message = "Phone number is already in use.";
      			$type = "warning";
      		}
        }
        if(!isset($message)) {
        $mailquery = "SELECT * FROM customers WHERE cus_email = '$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if ($mailchk != false) {
          $message = "User Email is already in use.";
          $type = "warning";
        } else {
            $query = "INSERT INTO customers(cus_firstname, cus_lastname, cus_email, cus_tel, cus_password, address, cus_created_at) 
			VALUES('$firstname', '$lastname', '$email', '$phone', '$pass', '$address',now())";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $getQry = $this->db->select("SELECT * FROM customers WHERE cus_email = '$email'");
                
$cust=$getQry->fetch_assoc() ;
$curr_id=$cust['cus_id'];
require './vendor/autoload.php';
$template_file = "./email_templates/template_email_activation.php";
$email_message = file_get_contents($template_file);
	// create a list of the variables to be swapped in the html template
	$swap_var = array(
		"{SITE_ADDR}" => "https://www.didiscuisine.com",
		"{EMAIL_LOGO}" => "https://www.didiscuisine.com/images/didicuisine.png",
		"{EMAIL_TITLE}" => "Activation Message!",
		"{CUSTOM_URL}" => "https://www.didiscuisine.com/activate.php?id=$curr_id",
		"{CUSTOM_IMG}" => "https://www.didiscuisine.com/images/didicuisine.png",
		"{TO_NAME}" => $firstname,
		"{TO_EMAIL}" => $email
	);

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'didi@didiscuisine.com';
$mail->Password = 'KachisiCho1';
$mail->setFrom('didi@didiscuisine.com', "DiDi's Cuisine And Event Planning");
$mail->addReplyTo('didi@didiscuisine.com', "DiDi's Cuisine And Event Planning");
$mail->addAddress($email, $firstname);
$mail->Subject = "Welcome To DiDis Cuisine and Event Planning";
// search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
	foreach (array_keys($swap_var) as $key){
		if (strlen($key) > 2 && trim($swap_var[$key]) != '')
			$email_message = str_replace($key, $swap_var[$key], $email_message);
	}
$mail->msgHTML($email_message, __DIR__);

$mail->IsHTML(true);
;
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "<script>alert('Welcome! - An activation message was sent to your email address. Please visit you email to complete your registration.'); window.location = '$from';</script>";
   
}
            } else {
              $message = "Customer Data Not Inserted. Try Again!";
              $type = "dark";
            }
        }}            
        if (isset($message)) {
          $error="<script>
  jQuery(window).on('load',function() {
	  Lobibox.notify('$type', {
		
                    position: 'top right',
                                  showClass: 'zoomInUp',
                                  hideClass: 'zoomOutDown',
                              msg: '$message'
                          });})
  </script>";
						  echo $error;
        }
    }

    public function customerLogin($data)
    {
		if(isset($_GET['from'])){
			$from="signin.php?from=".$_GET['from'];
			$from2=$_GET['from'];
		}else{
			$from="signin.php";
			$from2="cart.php";
		}
        $email 	= $this->fm->validation($data['email']);
        $pass  	= $this->fm->validation($data['password']);

        $email 	= mysqli_real_escape_string($this->db->link, $email);

        $query = "SELECT * FROM `customers` where cus_email  = '$email'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
			$stored_password = $value['cus_password'];
			if ($value['status']== 'inactive') {
			  $message = "<b>Sorry!</b>You are yet to activate this account - Check your email for verification.";
      $type = "info";
	  $error="<script>
  jQuery(window).on('load',function() {
	  Lobibox.notify('$type', {
		
                    position: 'top right',
                                  showClass: 'zoomInUp',
                                  hideClass: 'zoomOutDown',
                              msg: '$message'
                          });})
  </script>";
						  echo $error;
    }elseif ($value['status']== 'active') {
      if (password_verify($pass,$stored_password)) {
  				Session::set("cuslogin", true);
  				Session::set("cmrId", $value['cus_id']);
  				Session::set("cmrName", $value['cus_firstname']);
          $_SESSION['DiDicmrId']= $value['cus_id'];
          $_SESSION['DiDicuslogin']= 1;
          $_SESSION['DiDicustomer']= true;
		  
		  
              echo "<script>window.location = '$from2';</script>";
  				   }else{
  						$message = "<b>Sorry!</b> - Invalid password.";
  						$type = "warning";
						$error="<script>
  jQuery(window).on('load',function() {
	  Lobibox.notify('$type', {
		
                    position: 'top right',
                                  showClass: 'zoomInUp',
                                  hideClass: 'zoomOutDown',
                              msg: '$message'
                          });})
  </script>";
						  echo $error;
  				   }
  				}else {
					
            $message = "<b>Sorry!</b> - Account has been deactivated.";
            $type = "error";
			$error="<script>
  jQuery(window).on('load',function() {
	  Lobibox.notify('$type', {
		
                    position: 'top right',
                                  showClass: 'zoomInUp',
                                  hideClass: 'zoomOutDown',
                              msg: '$message'
                          });})
  </script>";
						  echo $error;
          }
    }else {
    $message= "<b>Sorry!</b> - Invalid Email.";
  $type= "warning";
  $error="<script>
  jQuery(window).on('load',function() {
	  Lobibox.notify('$type', {
		
                    position: 'top right',
                                  showClass: 'zoomInUp',
                                  hideClass: 'zoomOutDown',
                              msg: '$message'
                          });})
  </script>";
						  echo $error;
        }
    }

    public function getCustomerData($id)
    {
        $query = "SELECT * FROM tbl_customers WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function customerUpdate($data, $cmrId)
    {
        $name    	= $this->fm->validation($data['name']);
        $address    = $this->fm->validation($data['address']);
        $city    	= $this->fm->validation($data['city']);
        $zip     	= $this->fm->validation($data['zip']);
        $email   	= $this->fm->validation($data['email']);
        $country 	= $this->fm->validation($data['country']);
        $phone   	= $this->fm->validation($data['phone']);
        
        
        $name 		= mysqli_real_escape_string($this->db->link, $name);
        $address 	= mysqli_real_escape_string($this->db->link, $address);
        $city 		= mysqli_real_escape_string($this->db->link, $city);
        $zip 		= mysqli_real_escape_string($this->db->link, $zip);
        $email 		= mysqli_real_escape_string($this->db->link, $email);
        $country 	= mysqli_real_escape_string($this->db->link, $country);
        $phone 		= mysqli_real_escape_string($this->db->link, $phone);
        

        if ($name == "" || $address == "" || $city == "" || $zip == "" || $email == "" || $country == "" || $phone == "") {
            $msg = "<span class='error'>Fields must not be empty!</span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_customers
        	SET
        	name 	= '$name',
        	address = '$address',
        	city 	= '$city',
        	country = '$country',
        	zip 	= '$zip',
        	phone 	= '$phone',
        	email 	= '$email'
        	WHERE id = '$cmrId'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $msg = "<span class='success'>Customer Data Update Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer Data Not Updated.</span>";
                return $msg;
            }
        }
    }
}
