<?php
require_once 'conn.php';
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO registration (full_name,email,password) VALUES ('$fullname','$email','$hash')";
  if (mysqli_query($conn, $sql)) {
    $mail = new PHPMailer(true);

    try {

      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'rangadiyaamit7603@gmail.com';                     //SMTP username
      $mail->Password   = 'yzrtqukgpylczhel';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('rangadiyaamit7603@gmail.com', 'welcome');
      $mail->addAddress('chvdamanoj123@gmail.com', '..');     //Add a recipient

      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Welcome User';
      $mail->Body    = 'thank you, for visit our website ';
      $mail->send();


      $mail = new PHPMailer(true);

      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'rangadiyaamit7603@gmail.com';                     //SMTP username
      $mail->Password   = 'yzrtqukgpylczhel';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('rangadiyaamit7603@gmail.com', '21');
      $mail->addAddress('rangadiyaamit7603@gmail.com', '2');     //Add a recipient
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'admin';
      $mail->Body    = '
      <table>
        <tr style="border:1px solid red;">
         <th style="border:1px solid red;">fullname</th>
         <td style="border:1px solid red;">' . $fullname . '</td>
        </tr>
        <tr>
         <th style="border:1px solid red;">email</th>
         <td style="border:1px solid red;">' . $email . '</td>
        </tr>

      </table>';
      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header('location:login.php');
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="index2.html"><b>Admin</b>LTE</a>
    </div>
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="fullname" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <p class="fullname-error"></p>
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <p class="email-error"></p>

          <div class="input-group mb-3">
            <input type="password" class="form-control password" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="password-error"></p>

          <div class="input-group mb-3">
            <input type="password" class="form-control" name="co_password" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="co_password-error"></p>


          <div class="social-auth-links text-center">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <a href="login.php" class="btn btn-danger btn-block">login</a>
            <!-- <button class="btn btn-danger btn-block">login</button> -->
        </form>


      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function() {
    $("form").validate({
      rules: {
        fullname: {
          required: true,
        },
        email: {
          required: true,
        },
        password: {
          required: true,
        },
        co_password: {
          equalTo: '.password',
          required: true,
        },
      },
      errorPlacement: function(er, el) {
        if (el.attr('name') == "fullname") {
          er.appendTo(".fullname-error");
        } else if (el.attr('name') == "email") {
          er.appendTo(".email-error");

        } else if (el.attr('name') == "password") {
          er.appendTo(".password-error");

        } else if (el.attr('name') == "co_password") {
          er.appendTo(".co_password-error");

        }
      }
    });
  });
</script>