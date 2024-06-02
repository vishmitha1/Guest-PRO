<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';







    function sendEmail($email,$name){



        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
           
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vishyt236@gmail.com';                     //SMTP username
            $mail->Password   = 'zwcjezcshwhilsmi';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('vishyt236@gmail.com', 'Guest PRO');
            $mail->addAddress($email, $name);     //Add a recipient
            
            $mail->addReplyTo('vishyt236@gmail.com', 'Guest PRO');
          

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
           

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    function sendOtpEmail($email,$name,$otp){



        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
           
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'anurakumara7527@gmail.com';                     //SMTP username
                                      //SMTP password
            $mail->Password   = 'xpqgiiqkrhpwgoux';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('anurakumara7527@gmail.com', 'Guest PRO');
            $mail->addAddress($email, $name);     //Add a recipient
            
            $mail->addReplyTo('anurakumara7527@gmail.com', 'Guest PRO');
          

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verify Your Email';

            $mail->Subject = 'OTP for Registration';

            // HTML email body
            $mail_body = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>OTP for Registration</title>
                <style>
                    /* You can style your email here */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    }
                    h2 {
                        color: #333;
                    }
                    p {
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>OTP for Registration</h2>
                    <p>Your OTP is: <strong>' . $otp . '</strong></p>
                    <p>Please use this OTP to complete your registration process.</p>
                </div>
            </body>
            </html>
            ';

            $mail->Body = $mail_body;

           

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    //reservation fonforation email



    function reservationConfirmationEmail($email,$name,$reservation,$roomNo){



        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
           
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mihiindrajith@gmail.com';                     //SMTP username
            $mail->Password   = 'ryuxqyofkykojsdl';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mihiindrajith@gmail.com', 'Guest PRO');
            $mail->addAddress($email, $name);     //Add a recipient
            
            $mail->addReplyTo('mihiindrajith@gmail.com', 'Guest PRO');
          

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verify Your Email';

            $mail->Subject = 'OTP for Registration';

            // HTML email body
            $mail_body = '
            <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservation Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #007bff;
    }
    p {
      margin-bottom: 10px;
    }
    .reservation-details {
      margin-top: 20px;
      border-top: 2px solid #007bff;
      padding-top: 20px;
    }
    .reservation-details table {
      width: 100%;
    }
    .reservation-details table th,
    .reservation-details table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    .reservation-details table th {
      background-color: #f4f4f4;
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo img {
      max-width: 200px;
    }
    .hotel-image img {
      display: block;
      margin: 0 auto;
      max-width: 100%;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="logo">
      <img src="[System Logo URL]" alt="System Logo">
    </div>
    <h1>Reservation Confirmation</h1>
    <p>Dear ,</p>
    <p>We are pleased to confirm your reservation with us. Below are the details of your reservation:</p>
    
    <div class="reservation-details">
      <table>
        <tr>
          <th>Reservation Number:</th>
          <td>'. $reservation .'</td>
        </tr>
        
        <tr>
          <th>Customer Name:</th>
          <td>'. $name.'</td>
        </tr>
        <tr>
          <th>NIC:</th>
          <td>'.$_SESSION['nic'].'</td>
        </tr>
        <tr>
          <th>Reserved Rooms No:</th>
          <td>'. $roomNo .'</td>
        </tr>
      </table>
    </div>
    
    <div class="hotel-image">
      
    </div>
    
    <p>If you have any questions or need further assistance, please dont hesitate to contact us. We look forward to welcoming you!</p>
    <p>Best regards,<br>Your Hotel Team</p>
  </div>

</body>
</html>

           ';

            $mail->Body = $mail_body;

           

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }