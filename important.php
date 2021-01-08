<!--SEND EMAIL FORM-->
<?php
require_once "headerZashas2.php";
?>
</<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="icon" href="favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <title>Send Email</title>
</head>
<body>
<div class="container" style="margin-top:100px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3" align="center">
            <input id="name" placeholder="Name" class="form-control">
            <input id="email" placeholder="Email" class="form-control">
            <input id="subject" placeholder="Subject" class="form-control">
            <textarea class="form-control" id="body" placeholder="Email Body"></textarea>
            <input type="button" onclick="sendEmail()" value="Send An Email" class="btn btn-primary">
        </div>
    </div>
</div>

<script type="text/javascript">
    function sendEmail() {
        var name = $("#name");
        var email = $("#email");
        var subject = $("#subject");
        var body = $("#body");

        if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
            $.ajax({
                url: 'sendEmail.php',
                method: 'POST',
                data: {
                    name: name.val(),
                    email: email.val(),
                    subject: subject.val(),
                    body: body.val()
                }, success: function (response) {
                    if (response.status == "success")
                        alert('Email Has Been Sent!');
                    else {
                        alert('Please Try Again!');
                        console.log(response);
                    }
                }
            });
        }
    }

    function isNotEmpty(caller) {
        if (caller.val() == "") {
            caller.css('border', '1px solid red');
            return false;
        } else
            caller.css('border', '');

        return true;
    }
</script>


</body>
</html>

<?php
///**
// * Created by PhpStorm.
// * User: abdullahzafar
// * Date: 2019-11-03
// * Time: 17:22
// */
//
//use PHPMailer\PHPMailer\PHPMailer;
//
//$error = null;
//if(isset($_POST['submit'])){
//
//    //get form data
//    $name       = $_POST['fn'];
//    $username   = $_POST['u'];
//    $password   = $_POST['p'];
//    $r_password = $_POST['rp'];
//    $email      = $_POST['ea'];
//
//    if($r_password != $password){
//        $error = "<p>Passwords do not match</p>";
//    }
//    else {
//        $mysqli = new mysqli('localhost', 'root', '', 'project');
//        $name = $mysqli->real_escape_string($name);
//        $username = $mysqli->real_escape_string($username);
//        $password = $mysqli->real_escape_string($password);
//        $r_password = $mysqli->real_escape_string($r_password);
//        $email = $mysqli->real_escape_string($email);
//        $verificationKey = md5(time() . $username);
//        $password = md5($password);
//
//        $insert = $mysqli->query("INSERT INTO registeration(name, username, password, email, verification_key) values ('$name', '$username', '$password', '$email', '$verificationKey')");
//
//        if ($insert) {
//
//            require_once "PHPMailer/src/PHPMailer.php";
//            require_once "PHPMailer/src/SMTP.php";
//            require_once "PHPMailer/src/Exception.php";
//
//            $mail = new PHPMailer();
//            try {
//                $mail->setFrom('zasha.store123@gmail.com');
//            } catch (\PHPMailer\PHPMailer\Exception $e) {
//            }
//            try {
//                $mail->addAddress($email, $name);
//            } catch (\PHPMailer\PHPMailer\Exception $e) {
//            }
//            $mail->Subject = "Please verify email!";
//            $mail->isHTML(true);
//            $mail->Body = "
//                    Please click on the link below:<br><br>
//
//                    <a href='http://localhost:8080/zashas?email=$email&token=$verificationKey'>Click Here</a>
//                ";
//
//            if ($mail->send())
//                $msg = "You have been registered! Please verify your email!";
//            else
//                $msg = "Something wrong happened! Please try again!";
//        } else {
//            echo "Query Failed";
//            echo $mysqli->error;
//        }
//    }
//
////            $subjectEmail = "Email Verification";
////            $messages = "<a href='http://localhost:8080/zashas/index.php?verificationKey=$verificationKey'>Register Your Account Here!</a>";
////
////
////            $to = $email;
////            $subjectEmail = "Email Verification";
////            $messages = "<a href='http://localhost:8080/zashas/index.php?verificationKey=$verificationKey'>Register Your Account Here!</a>";
////            $headers = "From: zasha.store123@gmail.com" . "\r\n";
////            $headers .= "MIME-Version: 1.0" . "\r\n";
////            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
////
////            mail($to, $subjectEmail, $messages, $headers);
////            header('location:welcome.php');
////        } else {
////            echo "Query Failed";
////            echo $mysqli->error;
////        }
//
//}
//?>
<!---->
<!--<html>-->
<!--<head>-->
<!--    <link>-->
<!--</head>-->
<!---->
<!--<body>-->
<!--<form method="POST" action="">-->
<!--    <table border="0" align="center" cellpadding="5">-->
<!--        <tr>-->
<!--            <td align="right">Full Name:</td>-->
<!--            <td><input type="text" name="fn" required></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td align="right">Username:</td>-->
<!--            <td><input type="text" name="u" required></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td align="right">Password:</td>-->
<!--            <td><input type="password" name="p" required></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td align="right">Repeat Password:</td>-->
<!--            <td><input type="password" name="rp" required></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td align="right">Email Address:</td>-->
<!--            <td><input type="email" name="ea" required></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td colspan="5" align="center"><input type="submit" name="submit" value="Register"></td>-->
<!--        </tr>-->
<!--    </table>-->
<!--</form>-->
<!---->
<?php
//echo $error;
//?>
<!---->
<!---->
<!--</body>-->
<!---->
<!---->
<!---->
<!--</html>-->
