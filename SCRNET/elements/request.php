<?php
include_once('profile.php');
include_once( 'conf.php' );
$action = $_POST[ 'action' ];
$from = $_POST[ 'id_from' ];
$to = $_POST[ 'id_to' ];
switch ( $action ) {
    case "set":
        SetFriendRequest( $from, $to );
        break;
    case "get":
        GetSendingRequest();
        break;
    case "getp":
        GetPendingRequest();
        break;
    case "del":
        DeleteFriendRequest($from, $to );
        break;
    case "accept":
        AcceptFriendRequest($from, $to );
        break;
    default:
        echo "Operación no definida";
        break;
}

function SetFriendRequest( $from_id, $to_id ) {
    if ( strcmp( $from_id, "" ) != 0 && strcmp( $to_id, "" ) != 0 ) {
        $sqlquery = "INSERT INTO request(id_from,id_to) VALUES ('{$from_id}','{$to_id}');";
        $r = mysqli_query( getDB(), $sqlquery );
        echo '¡Solicitud enviada!';
    } else {
        echo "Faltan datos!";
    }
}

function GetSendingRequest() {
//Solicitudes Enviadas
    $from_id = base64_decode($_COOKIE['PHP7SESSION']);
        $sqlquery = "SELECT * FROM request WHERE id_from='{$from_id}';";
        
        $r = mysqli_query( getDB(), $sqlquery );
        while($arr=mysqli_fetch_array($r)){
            
            $from =$arr['id_from'];
            $to = $arr['id_to'];
            $sqlquery2 = "SELECT * FROM profile WHERE id_profile='{$to}';";
            $r2 = mysqli_query( getDB(), $sqlquery2);
            $profile= GetPublicProfile($to);
            while($arr2=mysqli_fetch_array($r2)){
                $name = $arr2['name'];
                $lastname = $arr2['lastname'];
                $photo = $arr2['photo'];
                echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src='.$profile->photo.' width=50 alt="people" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="#">' . $name, " ", $lastname . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Quieres ser su amigo!</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="cancelrequest(' . $from . ',' . $to . ')" class="btn btn-default btn-sm"> Cancelar Solicitud <i class="fa fa-close"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
            }
        }
    echo "<br>";
}

function GetPendingRequest() {
//Solicitudes Enviadas
        $to_id = base64_decode($_COOKIE['PHP7SESSION']);
        $sqlquery = "SELECT * FROM request WHERE id_to='{$to_id}';";
        
        $r = mysqli_query( getDB(), $sqlquery );
        
        while($arr=mysqli_fetch_array($r)){
            $from =$arr['id_from'];
            $to = $arr['id_to'];
            $sqlquery2 = "SELECT * FROM profile WHERE id_profile='{$from}';";
            $r2 = mysqli_query( getDB(), $sqlquery2);
            $profile= GetPublicProfile($from);
            while($arr2=mysqli_fetch_array($r2)){
                $name = $arr2['name'];
                $lastname = $arr2['lastname'];
                $photo = $arr2['photo'];
                echo '<div class="col-md-6 col-lg-4 item">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="media">
                      <div class="pull-left">
                        <img src='.$profile->photo.' width=50 alt="people" class="media-object img-circle" />
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading margin-v-5"><a href="#">' . $name, " ", $lastname . '</a></h4>
                        <div class="profile-icons">
                          <span><i class="fa fa-users"></i> Quiere ser tu amigo!</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <a href="#" onClick="cancelrequest(' . $from . ',' . $to . ')" class="btn btn-default btn-sm"> Cancelar Solicitud <i class="fa fa-close"></i></a>
                    <a href="#" onClick="acceptrequest(' . $from . ',' . $to . ')" class="btn btn-default btn-sm"> Aceptar Solicitud <i class="fa fa-check-circle-o"></i></a>
                  </div>
                </div>
              </div>
                <!-- Mi comentario -->';
            }
        }
}

function DeleteFriendRequest( $from_id, $to_id ) {
    if ( strcmp( $from_id, "" ) != 0 && strcmp( $to_id, "" ) != 0 ) {
        $instruccion = "delete from request where id_from='{$from_id}' AND id_to='{$to_id}';";
        $r2 = mysqli_query( getDB(), $instruccion );
        echo '¡Solicitud Cancelada!';
    } else {
        echo "Faltan datos!";
    }
}

function AcceptFriendRequest( $from_id, $to_id ) {
    if ( strcmp( $from_id, "" ) != 0 && strcmp( $to_id, "" ) != 0 ) {
        $sqlquery = "INSERT INTO friendship(id_friend1,id_friend2) VALUES ('{$from_id}','{$to_id}');";
        $instruccion = "delete from request where id_from='{$from_id}' AND id_to='{$to_id}';";
        $r = mysqli_query( getDB(), $sqlquery );
        $r2 = mysqli_query( getDB(), $instruccion );
        echo '¡Ahora ya son amigos!';
    } else {
        echo "Faltan datos!";
    }
}

?>