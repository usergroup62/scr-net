<?php

function SetSession( $id_session ) {
    $cookie_name = "PHP7SESSION";
    $cookie_value = base64_encode( $id_session );
    setcookie( $cookie_name, $cookie_value, time() + ( 86400 * 30 ), "/" ); // 86400 = 1 day 
}

function GetSession() {
    return ( base64_decode( $_COOKIE[ 'PHP7SESSION' ] ) );
}

function RemoveSession() {
    $cookie_name = 'PHP7SESSION';
    unset( $_COOKIE[ $cookie_name ] );
    // empty value and expiration one hour before
    //$res = setcookie( $cookie_name, '', time() );
    setcookie($cookie_name, null, -1, '/'); 
}

?>