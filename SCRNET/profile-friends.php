<?php
include_once( 'elements/UI-profile.php' );
include_once( 'elements/profile.php' );
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
        echo '<title>Amigos de:'.GetPublicProfile($id_prof)->name.'</title>';
    ?>


    <link href="css/vendor/all.css" rel="stylesheet">
    <link href="css/app/app.css" rel="stylesheet">


</head>

<body>

    <!-- Wrapper required for sidebar transitions -->
    <div class="st-container">

        <!-- Fixed navbar -->
        <div class="navbar navbar-main navbar-primary navbar-fixed-top" role="navigation">
            <?php GetNavBar(); ?>
        </div>

        <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
        <?php GetPublicLeftBar($id_prof)?>

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

                    <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
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
                                    <li><a href="profile.php?id=<?php echo($id_prof); ?>"><i class="fa fa-fw icon-ship-wheel"></i>Muro</a></li>
                  <li><a href="about-profile.php?id=<?php echo($id_prof); ?>"><i class="fa fa-fw icon-user-1"></i> Información</a></li>
                  <li><a href="profile-friends.php?id=<?php echo($id_prof); ?>"><i class="fa fa-fw fa-users"></i> Amigos</a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>

                    </nav>

                    <div class="container-fluid"><br>

                        <?php
                        if ( isset( $_GET[ 'search' ] ) ) {
                            echo '<div id="filter">
              <form class="form-inline">
                <label>Filter:</label>
                
                  <div class="search-name">
                    <input type="text" class="form-control" placeholder="First Last Name" id="namesearch">
                    <a href="#" onClick="search_friend()" class="btn btn-default" id="user-search-name"><i class="fa fa-search"></i> Buscar</a>
                  </div>

                
              </form>
            </div>';
                            echo '<div class="row" data-toggle="isotope" id=searchcontainer>';
                            echo '</div>';
                        }
                        if(isset($_GET['request'])){
                            echo '<h4>Solicitudes Enviadas</h4><hr />';
                            echo '<div class="row" data-toggle="isotope" id=sendingresquests>';
                            echo '</div><br>';
                            echo '<br><h4>Solicitudes Recibidas Pendientes</h4><hr />';
                            echo '<div class="row" data-toggle="isotope" id=pendingresquests>';
                            echo '</div>';
                        } if(!isset($_GET['request']) && !isset($_GET['search']) ) {
                            
                            echo '<div class="row" data-toggle="isotope">';

                            include_once( 'elements/friendship.php' );

                            getPublicfriends($id_prof);
                            echo '</div>';
                        }
                        ?>
                    

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

    <!-- Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
    <script src="js/vendor/all.js"></script>
    <script src="js/app/app.js"></script>
    <script src="js/social/manager.js"></script>


</body>

</html>