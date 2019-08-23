<?php



function GetMyProfile() {
    //$id_profile = $_
}
function GetLeftBar(){
    $prof = GetProfileData();
    echo '<div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu">
      <div data-scrollable>
        <div class="sidebar-block">
          <div class="profile">
            <img src='.$prof->photo.' alt="people" class="img-circle" height="80" width="80"/>
            <h4>'.$prof ->name," ",$prof->lastname.'</h4>
          </div>
        </div>
        <h4 class="category">Cuenta</h4>
        <ul class="sidebar-menu">
          <li><a href="index.php"><i class="icon-user-1"></i> <span>Editar Perfil</span></a></li>
          <li><a href="friends.php"><i class="fa fa-group"></i> <span>Mis Amigos</span></a></li>
          <li><a href="friends.php?request=true"><i class="fa fa-inbox"></i> <span>Solicitudes</span></a></li>
          <li><a href="friends.php?search=true"><i class="fa fa-plus-circle"></i> <span>Agregar Amigos</span></a></li>
          <li><a href="login.php"><i class="icon-unlock-fill"></i> <span>Logout</span></a></li>
        </ul>
      </div>
    </div>';
}
function GetPublicLeftBar($id_profile){
    $profile = GetPublicProfile($id_profile);
    echo '<div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu">
      <div data-scrollable>
        <div class="sidebar-block">
          <div class="profile">
            <img src="'.$profile->photo.'" alt="people" height="80" width="80" class="img-circle" />
            <h4>'.$profile->name," ",$profile->lastname.'</h4>
          </div>
        </div>
        <div class="category">Información</div>
        <div class="sidebar-block">
          <ul class="list-about">
            <li><i class="fa fa-calendar"></i>'.$profile->age.' años</li>
            <li><i class="fa fa-group"></i><a href="friends.php?id='.$profile->id.'">Amigos</a></li>
            <li><i class="fa fa-info-circle"></i> <a href="about.php?id='.$profile->id.'">Información</a></li>
          </ul>
        </div>

      </div>
    </div>';
}

function GetNavBar() {
    $prof = GetProfileData();
    echo '<div class="container-fluid">
        <div class="navbar-header">
          <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
          <a class="navbar-brand" href="index.php">Social</a>
        </div>
    <div class="collapse navbar-collapse" id="main-nav">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Mi perfil</a></li>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- User -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                <img src='.$prof->photo.' alt="Yo" class="img-circle" width="40" /> '.$prof->name.' <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="index.php">Perfil</a></li>
                <li><a href="login.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        </div>
        </div>
        ';
}
include 'elements/profile.php';
function GetPrivateProfile() {

}

?>