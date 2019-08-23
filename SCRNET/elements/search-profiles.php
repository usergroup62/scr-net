<?php
include( 'conf.php' );
$name = $_POST[ 'name' ];
$my_id = base64_decode( $_COOKIE[ 'PHP7SESSION' ] );
$sqlquery = "SELECT * FROM profile WHERE name LIKE '%" . $name . "%'";
$comp = "SELECT * FROM friendship WHERE id_friend1='{$my_id}' OR id_friend2='{$my_id}';";

$r = mysqli_query( getDB(), $sqlquery );

while ( $arr = mysqli_fetch_array( $r ) ) {
    $id_prof = $arr[ 'id_profile' ];
    $name_s = $arr[ 'name' ];
    $lastname = $arr[ 'lastname' ];
    $photo = $arr[ 'photo' ];
    $r1 = mysqli_query( getDB(), $comp );
    $cont = 0;
    $is_my_friend = false;
    $its_me = false;
    if ( strcmp( $my_id, $id_prof ) == 0 ) {
        $its_me = true;
    }
    while ( $ar = mysqli_fetch_array( $r1 ) ) {

        if ( strcmp( $id_prof, $ar[ 'id_friend1' ] ) == 0 || strcmp( $id_prof, $ar[ 'id_friend2' ] ) == 0 ) {
            $is_my_friend = true;
        }
    }
    if ( !$its_me ) {
        if ( $is_my_friend ) {
            echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="'.$photo.'" alt="people" width="40" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="profile.php?id='.$id_prof.'">' . $name_s, " ", $lastname . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Ya es tu amigo</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="delfriendship(' . $my_id . ',' . $id_prof . ')" class="btn btn-default btn-sm"> Eliminar de mis amigos <i class="fa fa-close"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
        } else {
            echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src="'.$photo.'" alt="people" width="40" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="profile.php?id='.$id_prof.'">' . $name_s, " ", $lastname . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Agregar amigo</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="sendrequest(' . $my_id . ',' . $id_prof . ')" class="btn btn-default btn-sm"> Enviar Solicitud <i class="fa fa-send"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
        }
    }
    $is_my_friend = false;
    $its_me = false;
}

?>