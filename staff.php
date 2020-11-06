<?php

include_once 'database.php';
session_start();

$sql = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
$row = $result->fetch_assoc();

if($row['type'] != 1) { header('location:user.php'); }

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
                        <h3>Library Users</h3>
                        <table class="table ">
                            <thead class="thead-dark">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"> Select All</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <th scope="col" class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM users WHERE type != 1 ORDER BY name ASC";
                                $result = $conn->query($sql);
                                
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" id="checkItem" name="checklist"
                                            value="<?php echo $row['phone_number']; ?>">
                                    </td>
                                    <th scope="row"><?php echo $row["id"]; ?></th>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["phone_number"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["password"]; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#send" data-whatever="<?php echo $row['phone_number']; ?>">
                                            <i class="zmdi zmdi-mail-send" style="color: #fff;"> SMS</i>
                                        </button>
                                        <a href="logs.php?username=<?php echo $row['username']; ?>"
                                            class="btn btn-secondary">
                                            <i class="zmdi zmdi-assignment"> Logs</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                } 
                            } 
                            ?>

                            </tbody>
                        </table>
                        <button type="button" name="check" id="btnSendToMany" class="btn btn-primary"
                            data-toggle="modal" data-target="#modalSendToMany" disabled>
                            <i class="zmdi zmdi-mail-send" style="color: #fff;"> Send To All Selected Users</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="send" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="send.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" name="phone-number" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" name="message" id="message-text" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="send" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSendToMany" tabindex="-1" role="dialog" aria-labelledby="modalSendToMany"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="sendtomany.php" id="formSendToMany">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">To All Selected Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <textarea class="form-control" name="checked-list" id="checked-users" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" name="message" id="message-text" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="sendToMany" form="formSendToMany" class="btn btn-primary">Send
                            message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery-3.2.1.slim.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery/popper.min.js"></script>
    <script src="vendor/jquery/bootstrap.min.js"></script>

    <script>
        window.jQuery || document.write('<script src="/vendor/jquery-3.2.1.slim.min.js"><\/script>')
    </script>

    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>

    <script>
        $('#send').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-body input').val(recipient)
        })
    </script>

    <script>
        $('#checkAll, #checkItem').click(function () {
            //If the checkbox is checked.
            if ($(this).is(':checked')) {
                //Enable the submit button.
                $('#btnSendToMany').attr("disabled", false);
            } else {
                //If it is not checked, disable the button.
                $('#btnSendToMany').attr("disabled", true);
            }
        });
    </script>

    <script>
        $("#btnSendToMany").click(function () {
            $.each($("input[name='checklist']:checked"), function () {
                $("#checked-users").html($("#checked-users").html() + $(this).val() + ', ');
            });
        });
    </script>

    <script>
        $('#modalSendToMany').on('hide.bs.modal', function (event) {
            window.location.reload();

        })
    </script>

</body>

</html>