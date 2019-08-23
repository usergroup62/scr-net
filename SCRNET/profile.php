<?php
/*if(!isset($_COOKIE['PHP7SESSION'])){
    header('Location: login.php');
}*/
$id_prof = $_GET['id'];
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
    <?php
    include 'elements/UI-profile.php';
    echo '<title>Perfil: '.GetPublicProfile($id_prof)->name.'</title>';
    ?>
  

  <link href="css/vendor/all.css" rel="stylesheet">
  <link href="css/app/app.css" rel="stylesheet">


</head>

<body>

  <!-- Wrapper required for sidebar transitions -->
  <div class="st-container">

    <!-- Fixed navbar -->
    <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">


        <!-- Collect the nav links, forms, and other content for toggling -->
          <!-- NavBar-->
        <?php
          GetNavBar();
          ?>
        <!-- /NavBar-->
        <!-- /.navbar-collapse -->


    </div>

    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <!-- My NavBar -->
      <?php 
      GetPublicLeftBar($id_prof);
      ?>

    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->

    <!-- sidebar effects OUTSIDE of st-pusher: -->
    <!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->

    <!-- content push wrapper -->
    <div class="st-pusher" id="content">

      <!-- sidebar effects INSIDE of st-pusher: -->
      <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">
<?php
            if(!itsMyFriend($id_prof)){
                    echo "<center><h4>Este perfil es privado</h4><br>Enviale una solicitud a ".GetPublicProfile($id_prof)->name.", si ya la enviaste, espera a que la acepte,</center>";
                }else{
              echo '<nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="fa fa-ellipsis-h"></span>
                </button>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="subnav">
                <ul class="nav navbar-nav ">
                    
                  <li><a href=profile.php?id='.$id_prof.'><i class="fa fa-fw icon-ship-wheel"></i> Muro</a></li>
                    
                  <li><a href=about-profile.php?id='.$id_prof.'><i class="fa fa-fw icon-user-1"></i> Información</a></li>

                  <li><a href=profile-friends.php?id='.$id_prof.'><i class="fa fa-fw fa-users"></i> Amigos</a></li>
                      
                </ul>
              </div>
                
              <!-- /.navbar-collapse -->
            </div>

          </nav>';}
            
?>

          <div class="container-fluid" id="postd"><br>
              <?php
               if(itsMyFriend($id_prof)){
              include_once("elements/post.php");
              GetMural($id_prof);
               }
              ?>
</script>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <!-- Footer -->
    <footer class="footer">
      <strong>social.scrapywar.com</strong> v1.0
    </footer>
    <!-- // Footer -->

  </div>
  <!-- /st-container -->

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
  <script src="js/social/public-profile.js"></script>

</body>

</html>