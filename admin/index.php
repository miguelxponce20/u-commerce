<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>U-commerce</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bg-dark">
<div class="login-box">
  <div class="login-logo ">
    <h1 class="text-white"><b>U-</b>commerce</h1>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h4 class="login-box-msg text-primary">Inicia sesion</h4>

<?php
    if(isset($_REQUEST['login'])){
      // Iniciar sesion
      session_start();
      $email=$_REQUEST['email']??'';
      $passwor=$_REQUEST['pass']??'';

      // Encriptando el password
      $passwor=md5($passwor);

      // Sanitizacion basica y conexion
      include_once "conexion.php";
      $con=mysqli_connect($host,$user,$pass,$db);

      // Escapar los valores para prevenir inyección de SQL
      $email = mysqli_real_escape_string($con, $email);
      $passwor = mysqli_real_escape_string($con, $passwor);

      // Construccion y ejecucion de la consulta
      $query="SELECT id,email,nombre from usuarios where email='".$email."' and pass='".$passwor."'";
      $result=mysqli_query($con,$query);
      $row=mysqli_fetch_assoc($result);

      if($row){
        $_SESSION['id']=$row['id'];
        $_SESSION['email']=$row['email'];
        $_SESSION['nombre']=$row['nombre'];
        header("location:panel.php");
      }
      // En caso de que el email y pass no coincidan
      else{
        ?>
          <div class="alert alert-danger" role="alert">
            Error de login
          </div>
        <?php
      }
    }
?>

      <form method="post" >
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
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
