<?php
ob_start();
session_start();
include("../config/config.php");
$error_message = '';

if (isset($_POST['form1'])) {

    if (empty($_POST['email']) or empty($_POST['password'])) {
        $error_message = 'Email and/or Password cannot be empty<br>';
    } else {

        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? AND status=?");
        $statement->execute(array($email, 'Active'));
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($total == 0) {
            $error_message .= 'Email Address does not match<br>';
        } else {
            foreach ($result as $row) {
                $row_password = $row['password'];
            }

            if ($row_password != md5($password)) {
                $error_message .= 'Password does not match<br>';
            } else {

                $_SESSION['user'] = $row;
                header("location: index.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
		font-family: 'Roboto', sans-serif;
	   background-color: #4158D0;
       background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
	}
    .login-container {
            background-color: white;
            border-radius: 90px;
            padding: 60px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Add box shadow here */
        }
        .login-button {
            margin-top: 40px;
            padding: 5px 10px; /* Adjust the padding to decrease the button width */
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card login-container">
                <div class="card-header text-center">
                    <h3>Login To Deal</h3>
                </div>
                <div class="card-body">
                    <?php
                    if ((isset($error_message)) && ($error_message != '')):
                        echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    endif;
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email address" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block login-button" name="form1">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
