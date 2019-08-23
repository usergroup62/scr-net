<?php
include 'elements/session.php';
if(isset($_COOKIE['PHP7SESSION'])){
    RemoveSession();
}
?>
<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Incia sesión en SCR-NET</title>
    
    <link rel="SCR-NET by Gatosan Software" type="image/x-icon" href="favicon.ico"/>

  <link href="css/vendor/all.css" rel="stylesheet">
  <link href="css/app/app.css" rel="stylesheet">

</head>

<body class="login">

  <div id="content">
    <div class="container-fluid">

      <div class="lock-container">
        <h1>Inicio de sesión</h1>
        <div class="panel panel-default text-center">
          <img src="uploads/default.jpg" width="80" class="img-circle">
          <div class="panel-body">
            <input class="form-control" type="text" placeholder="Correo electronico" id="email">
            <input class="form-control" type="password" placeholder="Contraseña" id="password">

            <a href="#" onClick="login()" class="btn btn-primary">Login <i class="fa fa-fw fa-unlock-alt"></i></a>
            <a href="register.php" class="forgot-password">¿No tienes cuenta? Registrate</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <strong>social.scrapywar.com</strong> v1.0
  </footer>
  <!-- // Footer -->
  <!-- Inline Script for colors and config objects; used by various external scripts; -->
  <script>
    var colors = {
      "danger-color": "#e74c3c",
      "success-color": "#81b53e",
      "warning-color": "#f0ad4e",
      "inverse-color": "#2c3e50",
      "info-color": "#2d7cb5",
      "default-color": "#6e7882",
      "default-light-color": "#cfd9db",
      "purple-color": "#9D8AC7",
      "mustard-color": "#d4d171",
      "lightred-color": "#e15258",
      "body-bg": "#f6f6f6"
    };
    var config = {
      theme: "social-2",
      skins: {
        "default": {
          "primary-color": "#16ae9f"
        },
        "orange": {
          "primary-color": "#e74c3c"
        },
        "blue": {
          "primary-color": "#4687ce"
        },
        "purple": {
          "primary-color": "#af86b9"
        },
        "brown": {
          "primary-color": "#c3a961"
        },
        "default-nav-inverse": {
          "color-block": "#242424"
        }
      }
    };
  </script>

  <script src="js/vendor/all.js"></script>
  <script src="js/app/app.js"></script>
    <script src="js/social/manager.js"></script>

</body>

</html>