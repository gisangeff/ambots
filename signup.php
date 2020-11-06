<?php
include_once 'database.php';
session_start();

if(isset($_SESSION['is_logged_in'])){ 
    header('location:staff.php'); 
}

if(isset($_POST['signup']))
{	 
    $message = "";
	$name = $_POST['name'];
	$phone_number = $_POST['phone-number'];
	$username = $_POST['username'];
	$password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        echo    '<script>
                    alert("Username already taken.");
                </script>';
    }
    else {
        $sql ="INSERT INTO users (name, phone_number, username, password, type) VALUES ('$name', '$phone_number', '$username', '$password', 0)";
     
        if (mysqli_query($conn, $sql)) {
            echo    '<script>
                        alert("Congratulations, your account has been successfully created.");
                    </script>';
        } else {
            echo "Error: " . $sql . " " . mysqli_error($conn);
         }
         mysqli_close($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="phone-number"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="phone-number" id="phone-number" placeholder="Phone Number" required/>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" value="1" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                    statements in <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" disabled />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="index.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                You are signed in now!
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        $('#agree-term').click(function () {
            //If the checkbox is checked.
            if ($(this).is(':checked')) {
                //Enable the submit button.
                $('#signup').attr("disabled", false);
            } else {
                //If it is not checked, disable the button.
                $('#signup').attr("disabled", true);
            }
        });
    </script>
</body>

</html>