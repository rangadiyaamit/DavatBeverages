<?php
session_start();
require_once "conn.php";
if (isset($_SESSION['fullname']) && $_SESSION['fullname']) {
    $id = $_GET['id'] ?? '';
    $sql = "SELECT * FROM home_slider WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // print_r($data);
        // exit;
    }
} else {
    header("location:login.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $img = $_POST['old_img'];
    $img1 = $_POST['old_img1'];
    if (isset($_FILES['file']) && $_FILES['file']['name']) {
        $img = $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_tmp, 'image/' . $file_name);
    }
    if (isset($_FILES['file1']) && $_FILES['file1']['name']) {
        $img1 = $file_name1 = $_FILES['file1']['name'];
        $file_tmp1 = $_FILES['file1']['tmp_name'];
        move_uploaded_file($file_tmp1, 'image/' . $file_name1);
    }
    $text = $_POST['text'];
    $status = 0;
    $id = $_POST['id'];

    if (isset($_POST['my-checkbox'])) {
        $status = 1;
    }
    if ($id) {
        $sql = "UPDATE home_slider SET text='$text',main_image='$img',image='$img1',status='$status' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO home_slider (text,main_image,image,status) VALUES ('$text','$img','$img1','$status')";
    }
    if (mysqli_query($conn, $sql)) {
        header('location:home_slider.php');
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .error {
            color: red;
        }

        td,
        th {
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
            </ul>

            <!-- SEARCH FORM -->


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <a href="log-out.php" class="btn btn-primary ">Log-out</a>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="user_profile.php?id=<?php echo $_SESSION['id'] ?>" class="d-block"><?php echo $_SESSION['fullname'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview ">
                            <a href="index.php" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="user_list.php" class="nav-link  ">
                                <!-- <i class="nav-icon fas fa-tachometer-alt"></i>  -->
                                <!-- <i class="fa fa-users" aria-hidden="true"></i> -->

                                <p>
                                    All User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <p>
                                    Home
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">

                                    <a href="home_slider.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Slider</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="home_ourstory.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Our Story</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="home_ourmedia.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Our Media</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="about_core_values.php" class="nav-link  ">
                                <p>
                                    About as
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="about_core_values.php" class="nav-link     ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Values</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="#" class="nav-link  ">
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="product_category.php" class="nav-link     ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="product.php" class="nav-link     ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">SLIDER</h1>
                        </div>
                        <div class="col-md-6 text-right"><a href="home_slider.php" class="btn btn-primary">Back</a></div>
                        <!-- /.col -->
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?php if ($id) {
                                                        echo "EDIT FIELD";
                                                        $img_show = $data['main_image'];
                                                        $img_show1 = $data['image'];
                                                    } else {
                                                        echo "ADD FIELD";
                                                        $img_show = 'bl.png';
                                                        $img_show1 = 'bl.png';
                                                    }
                                                    ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id" value="<?php echo $id ?? '' ?>">
                            <input type="hidden" name="old_img" id="old_img" value="<?php echo $data['main_image'] ?? '' ?>">
                            <input type="hidden" name="old_img1" id="old_img1" value="<?php echo $data['image'] ?? '' ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="image/<?php echo $img_show ?>" class="mx-auto d-block img rounded-circle" style="height: 200px; width:200px;" alt="">
                                        <label class="text-center d-block">Background-image</label>
                                        <input type="file" name="file" class="file" style="visibility:hidden;">
                                        <p class="file-error text-center d-block"></p>
                                        <div class="form-group">
                                            <label>Text:</label>
                                            <input type="text" class="form-control" name="text" value="<?php echo  $data['text'] ?? '' ?>" placeholder="Enter text">
                                        </div>
                                        <p class="text-error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="image/<?php echo $img_show1 ?>" class="mx-auto d-block img1 rounded-circle" style="height: 200px; width:200px;" alt="">
                                        <label class="text-center d-block">Animation-image</label>
                                        <input type="file" name="file1" class="file1" style="visibility:hidden;">
                                        <p class="file1-error text-center d-block"></p>
                                        <div class="form-group text-center">
                                            <label>Status:</label><br>
                                            <input type="checkbox" name="my-checkbox" <?php if (($data['status'] ?? '') != 0) echo 'checked' ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-right">
                                <button type="reset" class="btn btn-danger">reset</button>
                                <button type="submit" class="btn btn-success">submit</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
<script>
    $(document).ready(function() {
        $("form").validate({
            rules: {
                file: {
                    required: function() {
                        if ($("#old_img").val()) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                },
                file1: {
                    required: function() {
                        if ($("#old_img1").val()) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                },
                text: {
                    required: true,
                },

            },
            errorPlacement: function(er, el) {
                if (el.attr("name") == "file") {
                    er.appendTo(".file-error");
                } else if (el.attr("name") == "file1") {
                    er.appendTo(".file1-error");
                } else if (el.attr("name") == "text") {
                    er.appendTo(".text-error");
                }
            }
        });
        $(".img").click(function() {
            $(".file").trigger('click');
        });
        $(".file").change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
        $(".img1").click(function() {
            $(".file1").trigger('click');
        });
        $(".file1").change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img1").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

    });
</script>
<script>
    $(function() {
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    });
</script>