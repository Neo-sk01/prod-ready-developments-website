<?php
if($_POST) {

    // Updated email address for the recipient
    $to = "info@gomze.co.za"; // New email here
    $subject = 'Message from my website'; // Subject message here
}

//Send mail function
function send_mail($to, $subject, $message, $headers) {
    if(@mail($to, $subject, $message, $headers)) {
        echo json_encode(array('info' => 'success', 'msg' => "Your message has been sent. Thank you!"));
    } else {
        echo json_encode(array('info' => 'error', 'msg' => "Error, your message hasn't been sent"));
    }
}

// Sanitize input data, remove all illegal characters
$name    = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$website = filter_var($_POST['website'], FILTER_SANITIZE_STRING);
$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

// Validation
if($name == '') {
    echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
    exit();
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
    exit();
}
if($comment == ''){
    echo json_encode(array('info' => 'error', 'msg' => "Please enter your message."));
    exit();
}

// Prepare headers
$headers = 'From: ' . $email . "\r\n" .
           'Reply-To: ' . $email . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Send Mail
$messageBody = $comment . "\r\n\n" . 'Name: ' . $name . "\r\n" . 'Email: ' . $email;
send_mail($to, $subject, $messageBody, $headers);
?>
