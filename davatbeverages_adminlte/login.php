<?php
session_start();


require_once "conn.php";
$data = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM registration WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
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
    .error,
    .incorrect {
      color: red;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="password-error"></p>
          <p class="incorrect">
            <?php
            foreach ($data as $key => $value) {
              if (password_verify($password, $value['password'])) {
                if ($value['status'] == 1) {
                  $_SESSION['fullname'] = $value['full_name'];
                  $_SESSION['id'] = $value['id'];
                  header('location:index.php');
                }
                $error = "this user block pls contact administrator ";
              } else {
                $error = "incorrect password ";
              }
            }
            echo $error ?? "";
            ?>
          </p>



          <div class="social-auth-links text-center mb-3">
            <button type="submit" class="btn btn-primary btn-block sub">Log-in</button>
            <a href="register.php" class="btn btn-block btn-danger">
              Register
            </a>
          </div>
        </form>
        <!-- /.social-auth-links -->


      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

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
    $(".sub").click(function() {
      $(".incorrect").empty();
    });

    $("form").validate({
      rules: {
        email: {
          required: true,
        },
        password: {
          required: true,
        },
      },
      errorPlacement(er, el) {
        if (el.attr("name") == "email") {
          er.appendTo(".email-error");
        } else {
          er.appendTo(".password-error");
        }
      }
    });
  });
</script>