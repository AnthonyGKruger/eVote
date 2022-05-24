<?php
include "../functions.php";
if(isset($_POST['email']) /*&& $_POST['send-link']*/)
{
    $connection = get_connection();
    $email = $_POST['email'];
    $query = "SELECT `user_email`, `user_password` FROM `users` WHERE `user_email`='$email';";
    $results = mysqli_query($connection, $query);

    if (mysqli_num_rows($results) >= 1){
        $row = mysqli_fetch_array($results);
        $email=md5($row['user_email']);
        $pass=$row['user_password'];
        $link="https://dev.ezdev.solutions/change_password_link_clicked.php?key=".$email."&reset=".$pass;
        $subject = "Password reset link from the eVote digital elections platform";
        $body ='<p>Hi user!</p>';
        $body .='<p>You have successfully received a password reset link from<a href="https://dev.ezdev.solutions/"> The eVote platform</a>.</p>
            <p>Please click <a href="' . $link . '">here</a> to reset your password.</p>';

        $email_to = $_POST['email'];
        $email_from = "rgit@ezdev.solutions";
        $sender_name = "eVote support team";
        require("PHPMailer/PHPMailerAutoload.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.hostinger.com";
        $mail->SMTPAuth = true;
        $mail->Username = "rgit@ezdev.solutions";
        $mail->Password = "Rgit2021";

        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->From = $email_from;
        $mail->FromName = $sender_name;
        $mail->Sender = $email_from;
        $mail->AddReplyTo($email_from, "No Reply");
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($email_to);

        if (!$mail->Send()){
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
            echo "<div style='color:#FF0000; font-size:20px; font-weight:bold;'>
    An email has been sent to your email address.</div>";
        }
    }
}