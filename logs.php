<?php

include_once 'database.php';
session_start();
if(!isset($_SESSION['is_logged_in'])){ header('location:index.php'); }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="staff.php">Public Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signout.php">Sign Out</a>
                </li>
            </ul>

        </div>
    </nav>

    <main role="main" class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-12" style="background-color: #e9ecef;">
                    <div class="table-responsive">
                        <h3>Logs</h3>
                        <table class="table ">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th scope="col">Message</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $username = $_GET['username'];
                                    $sql = "SELECT * FROM logs WHERE username='$username' ORDER BY date_sent DESC";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['message']; ?></td>
                                    <td class="text-center">Delivered</td>
                                    <td class="text-center"><?php echo $row['date_sent']; ?></td>
                                </tr>
                                <?php 
                                        }    
                                    } 
                                ?>
                            </tbody>
                        </table>
                        <a href="staff.php" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JS -->
    <script src="vendor/jquery/jquery-3.2.1.slim.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery/popper.min.js"></script>
    <script src="vendor/jquery/bootstrap.min.js"></script>

    <script>
        window.jQuery || document.write('<script src="/vendor/jquery-3.2.1.slim.min.js"><\/script>')
    </script>
</body>

</html>