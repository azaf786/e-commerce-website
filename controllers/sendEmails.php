<?php
require_once './vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername("zasha.store123@gmail.com")
    ->setPassword("zashaSTORE");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $verification_key)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Verification</title>
      <style>
        .wrapper {
          padding: 25px;
          color: #132226;
          font-size: 1.3em;
        }
        a {
          background: #0ABDA0;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: white;
          font-size: 15px;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Thank you for signing up. Please click on the link below to verify your account.</p>
        <a href="http://localhost:8080/zashass/verify_email.php?verification_key=' . $verification_key . '">Verify Email!</a>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email'))
        ->setFrom("zasha.store123@gmail.com")
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}