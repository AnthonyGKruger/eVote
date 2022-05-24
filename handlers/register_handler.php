<?php

include "../header.php";

if (isset($_POST['first-name'])) {
    $connection = get_connection();

    $first_name = stripslashes($_POST['first-name']);
    $first_name = mysqli_real_escape_string($connection, $first_name);

    $last_name = stripslashes($_POST['last-name']);
    $last_name = mysqli_real_escape_string($connection, $last_name);

    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($connection, $email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($connection, $password);

    $contact_number = stripslashes($_POST['contact-number']);
    $contact_number = mysqli_real_escape_string($connection, $contact_number);

    $address = stripslashes($_POST['address']);
    $address = mysqli_real_escape_string($connection, $address);

    $id = stripslashes($_POST['id-number']);
    $id = mysqli_real_escape_string($connection, $id);

    $create_datetime = date("Y-m-d", strtotime(date("Y-m-d")));

    $query = "SELECT * FROM `users` WHERE `user_identity`='$id';";
    $results = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($results);

    $query = "SELECT * FROM `users` WHERE `user_email`='$email';";
    $results = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($results);

    $rows = 0;
    if ($rows >= 1){
        header("Location: ../login.php");
    } else {
        if (($_FILES['upload-id']['name']!="")){

            $current_directory = getcwd();
            $target_dir = "/../assets/images/id_documents/";
            $file_name = $_FILES['upload-id']['name'];
            $temp_name = $_FILES['upload-id']['tmp_name'];
            $array = explode('.', $file_name);
            $file_extension = strtolower(end($array));
            $temp = explode(".", $_FILES["upload-id"]["name"]);
            $new_file_name = round(microtime(true));
            $upload_path = $current_directory . $target_dir . $new_file_name . basename($file_name);

           // echo $upload_path;
        }

        $query = "INSERT into `users` (`user_first_name`, `user_last_name`, `user_identity`, `user_address`, `user_email`, 
                     `user_contact_number`, `last_vote`, `user_type`, `date_last_used`, `user_password`, `id_upload_location`)
                     VALUES ('$first_name', '$last_name', '$id', '$address', '$email', '$contact_number', 
                        ' ', 'un-activated', '" . $create_datetime . "', '" .  md5($password) . "', '"
                        . "/assets/images/id_documents/" . $new_file_name . basename($file_name) . "');";

        if($connection->query($query) == true){
            //echo "New record created successfully";
            if (move_uploaded_file($temp_name, $upload_path)) {
                //echo "The file " . $new_file_name . basename($file_name) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Error: " . $query . "<br>" . $connection->error;
        }

        $connection->close();
    }
        $_SESSION['just-registered'] = 'true';
        //print_r($_SESSION);

        $connection = get_connection();
        $email = $_POST['email'];

        $subject = "Welcome eVote digital elections platform";
        $body ='<p>Hi user!</p>';
        $body .='<p>You have successfully registered on<a href="https://dev.ezdev.solutions/"> The eVote platform</a>.</p>
            <p>Please wait patiently for an email confirming that your registration has been verified.</p>
            <p>Please click <a href="https://dev.ezdev.solutions">here</a> to go back to the site.</p>';

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

    $connection = get_connection();

    $subject = "eVote task notification";
    $body ='<p>Hi Admin!</p>';
    $body .='<p>Someone has successfully registered on<a href="https://dev.ezdev.solutions/"> The eVote platform</a>.</p>
            <p>Please click <a href="https://dev.ezdev.solutions/user_verification.php">here</a> to verify their identity.</p>';

    $emails = [];

    $query = "SELECT `user_email` FROM `users` WHERE `user_type`='admin';";
    $results = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($results)){
        array_push($emails, $row['user_email']);
    }
//    print_r($emails);
    for ($i = 0; $i < sizeof($emails); $i++){
        $email_from = 'rgit@ezdev.solutions';
        $sender_name = "eVote support team";
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
        $mail->AddAddress($emails[$i]);
        if (!$mail->Send()){
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
//            echo "<div style='color:#FF0000; font-size:20px; font-weight:bold;'>
//    An email has been sent to your email address.</div>";
        }
    }
//        header("Location: ../index.php");
    }