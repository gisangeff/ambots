<?php
    session_start();
    include_once 'database.php';
    // Require the bundled autoload file - the path may need to change
    // based on where you downloaded and unzipped the SDK
    require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php';

    // Use the REST API Client to make requests to the Twilio REST API

use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

    // Your Account SID and Auth Token from twilio.com/console
    // $sid = 'your_twilio_sid';
    // $token = 'your_twilio_token';
    // $twilio_number = 'your_twilio_number';
    $sid = 'AC783a1452b1c03c359c80ca4714ab9cda';
    $token = '4b49acf0da563fa3f00b3755e45d1441';
    $twilio_number = '+19472106572';
    $client = new Client($sid, $token);

    // Use the client to do fun stuff like send text messages!
    $checked_list = $_POST['checked-list'];
    $message = $_POST["message"];
    $success = true;

    try {
        $list = explode(", ", $checked_list);
    
        foreach ($list as $phone_number) {
            $client->messages->create(
                // the number you'd like to send the message to
                $phone_number,
                [
                    // A free Twilio phone number
                    'from' => $twilio_number,
                    // the body of the text message you'd like to send
                    'body' => $message
                ]
            );

            $sql = "SELECT username FROM users WHERE phone_number = '$phone_number'";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_assoc();
            $username = $row['username'];
            
            $sql ="INSERT INTO logs VALUES ('$username','$message', now())";
            mysqli_query($conn,$sql);
        }
    } catch (Exception $e) {
        $success = false;
        if($e->getMessage() == "[HTTP 400] Unable to create record: A 'To' phone number is required.") {
            $success = true;
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SMS App With PHP and Twilio</title>
    <style>
        .jumbotron {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 60%;
            padding-top: 20px;
            transform: translate(-50%, -50%);
            background-color: transparent;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <?php
                if($success){
                    echo '
                        <a href="staff.php">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" />
                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z" />
                        </svg>
                        Create Message
                        <div class="alert alert-success mt-4" role="alert">Message has been sent.</div>
                        ';
                }else{
                    echo '
                        <a href="staff.php">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
                        <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        Back
                        </a>
                        <div class="alert alert-danger mt-4" role="alert">Sending Failed.</div>';
                }
            ?>
        </div>
    </div>
</body>

</html>