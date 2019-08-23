<?php
include_once('conf.php');

$id_profile = base64_decode( $_COOKIE[ 'PHP7SESSION' ] );
$name = $_POST[ 'name' ];
$lastname = $_POST[ 'lastname' ];
$age = $_POST[ 'age' ];
$gender = $_POST[ 'gender' ];
$birthdate = $_POST[ 'birthdate' ];
$photo = $_POST[ 'photo' ];
$biography = $_POST[ 'biography' ];
$email = $_POST[ 'email' ];
$password = $_POST[ 'password' ];
$phone = $_POST[ 'phone' ];

$sql_str = "UPDATE profile SET name='{$name}',lastname='{$lastname}',age='{$age}',gender='{$gender}',birthdate='{$birthdate}',photo='{$photo}',biography='{$biography}',email='{$email}',password='{$password}',phone='{$phone}' WHERE id_profile='{$id_profile}';";
mysqli_query( getDB(), $sql_str );
if ( strcmp( $id_profile, "" ) != 0 ) {
    echo "Los cambios se realizaron exitosamente";
} else {
    echo "Error al aplicar los cambios";
}


?>