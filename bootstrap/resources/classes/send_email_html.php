<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
$template_file = "./email_templates/template_email_activation.php";
$email_message = file_get_contents($template_file);
	// create a list of the variables to be swapped in the html template
	$swap_var = array(
		"{SITE_ADDR}" => "https://www.heytuts.com",
		"{EMAIL_LOGO}" => "https://www.didiscuisine.com/images/diditech.png",
		"{EMAIL_TITLE}" => "Requirement for Website Creation.",
		"{CUSTOM_URL}" => "https://www.heytuts.com/web-dev/php/send-emails-with-php-from-localhost-with-sendmail",
		"{CUSTOM_IMG}" => "https://i1.wp.com/www.heytuts.com/wp-content/uploads/2019/05/thumbnail_Send-emails-with-php-from-localhost-with-SendMail.png",
		"{TO_NAME}" => "Paschal",
		"{TO_EMAIL}" => "jonnyp@yahoo.com"
	);

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'didi@didiscuisine.com';
$mail->Password = 'KachisiCho1';
$mail->setFrom('paschalanagha@gmail.com', "DiDi's Tech");
$mail->addReplyTo('paschalanagha@gmail.com', "DiDi's Tech");
$mail->addAddress($email, $firstname);
$mail->Subject = "Requirement for Website Creation.";
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
}
?>
