<?php
 include_once "../vendor/autoload.php";
 /*
  * Create the body of the message (a plain-text and an HTML version).
  * $text is your plain-text email
  * $html is your html version of the email
  * If the reciever is able to view html emails then only the html
  * email will be displayed
  */

$name = $_POST['name'];
$email = $_POST['email'];
//$date = $_POST['date'];
$phone = $_POST['phone'];
$message = $_POST['message'];


 $text = "Hi, you have received a booking enquiry from ". $name.
 "<br/>Their contact details are: <br/>Email: ". $email. " <br/>Phone: ". $phone. "<br/>They have written this message: ". $message."<br/>Please contact ". $name. " to confirm their request";

 // This is your From email address
 $from = array('booking@spadesiam.com.au' => 'Booking Enquiry');
 // Email recipients
 $to = array(
       'spadesiam@hotmail.com'=>'Spa De Siam'
 );
 // Email subject
 $subject = 'Booking Enquiry';

 // Login credentials
 $username = 'azure_03c8e783e3d9a6911bee238eb5b7ba19@azure.com';
 $password = 'seraphim69';

 // Setup Swift mailer parameters
 $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
 $transport->setUsername($username);
 $transport->setPassword($password);
 $swift = Swift_Mailer::newInstance($transport);

 // Create a message (subject)
 $message = new Swift_Message($subject);

 // attach the body of the email
 $message->setFrom($from);
 $message->setBody($text, 'text/html');
 $message->setTo($to);


 // send message
 if ($recipients = $swift->send($message, $failures))
 {
     // This will let us know how many users received this message
     echo 'Message sent out to '.$recipients.' users';
 }
 // something went wrong =(
 else
 {
     echo "Something went wrong - ";
     print_r($failures);
 }
