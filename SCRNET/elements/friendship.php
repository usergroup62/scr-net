<?php
include_once( 'conf.php' );
include_once( 'elements/profile.php' );
if ( isset( $_POST[ 'operation' ] ) ) {
    $op = $_POST[ 'operation' ];
    switch($op) {
        case 'remove':
            removefriend($_POST['from'],$_POST['to']);
            break;
        case 'get':
            if ( isset( $_POST[ 'from' ] ) ) {
                getfriends( $_POST[ 'from' ] );
            }
            break;
        default:
            echo "Error";
        break;
    }
}else{
     //getfriends( base64_decode( $_COOKIE[ 'PHP7SESSION' ] ) );
}


function removefriend( $from, $to ) {
    if ( strcmp( $from, "" ) != 0 && strcmp( $to, "" ) != 0 ) {
        $instruccion = "delete from friendship where id_friend1='{$from}' AND id_friend2='{$to}' OR id_friend1='{$to}' AND id_friend2='{$from}';";
        $r2 = mysqli_query(getDB(), $instruccion );
        echo '¡Amigo eliminado!';
    } else {
        echo "Faltan datos!"; 
    }
}

function getfriends( $id_profile ) {
    $sql1 = "SELECT profile.id_profile,profile.name,profile.lastname,profile.photo FROM scrnet.profile INNER JOIN friendship ON profile.id_profile=id_friend1 or profile.id_profile=id_friend2 WHERE id_friend1='{$id_profile}' OR id_friend2='{$id_profile}';";
    $r1 = mysqli_query( getDB(), $sql1 );
    $cont = 0;
    while ( $arr1 = mysqli_fetch_array( $r1 ) ) {
        $cont++;
        $id_prof = $arr1[ 'id_profile' ];
        $namef = $arr1[ 'name' ];
        $lastnamef = $arr1[ 'lastname' ];
        $photo = $arr1[ 'photo' ];
        if ( strcmp( $id_profile, $id_prof ) ) {
            echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="'.$photo.'" alt="people" width="40" height="40" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="profile.php?id='.$id_prof.'">' . $namef, " ", $lastnamef . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Amigo</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="delfriendship(' . $id_profile . ',' . $id_prof . ')" class="btn btn-default btn-sm">Eliminar <i class="fa fa-close"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
        }
    }
    if ( $cont == 0 ) {
        echo 'No tiene amigos agregue  <a href="friends.php?search=true">algunos</a> o vea el estado de sus <a href="friends.php?request=true">solicitudes</a> ';
    }
}

function getPublicfriends( $id_profile ) {
    $me = base64_decode($_COOKIE['PHP7SESSION']);
    $sql1 = "SELECT profile.id_profile,profile.name,profile.lastname,profile.photo FROM scrnet.profile INNER JOIN friendship ON profile.id_profile=id_friend1 or profile.id_profile=id_friend2 WHERE id_friend1='{$id_profile}' OR id_friend2='{$id_profile}';";
    $r1 = mysqli_query( getDB(), $sql1 );
    $cont = 0;
    while ( $arr1 = mysqli_fetch_array( $r1 ) ) {
        $id_prof = $arr1[ 'id_profile' ];
        $namef = $arr1[ 'name' ];
        $lastnamef = $arr1[ 'lastname' ];
        $photo = $arr1[ 'photo' ];
        $sql2 = "SELECT * FROM friendship WHERE id_friend1=".$id_prof." AND id_friend2=".$me." OR id_friend2=".$id_prof." AND id_friend1=".$me.";";
        $r2 = mysqli_query( getDB(), $sql2);
        while($arr2 = mysqli_fetch_array( $r2 )){
        $cont++;
        if (strcmp($id_prof,$id_profile) && itsMyFriend($id_prof)) {
            echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="'.$photo.'" alt="people" width="40" height="40" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="profile.php?id='.$id_prof.'">' . $namef, " ", $lastnamef . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Amigo en Común</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="delfriendship(' . $me . ',' . $id_prof . ')" class="btn btn-default btn-sm">Eliminar <i class="fa fa-close"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
            $cont=0;
        }
    }
        if ( $cont == 0 && strcmp($me,$id_prof) && !itsMyFriend($id_prof)) {
        echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="'.$photo.'" alt="people" width="40" height="40" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="profile.php?id='.$id_prof.'">' . $namef, " ", $lastnamef . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Amigo de uno de tus amigos</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="sendrequest(' . $me . ',' . $id_prof . ')" class="btn btn-default btn-sm">Enviar solicitud <i class="fa fa-send"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
    }
        $cont =0;
    }
    
}

?>