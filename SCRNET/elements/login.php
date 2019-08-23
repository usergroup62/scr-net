<?php
$email = $_POST['email'];
$pass = $_POST['password'];

include('conf.php');
include('session.php');
if(strcmp($email,"")!=0 && strcmp($pass,"")!=0){
    $sqlQuery = "SELECT id_profile FROM profile WHERE email='{$email}' AND password='{$pass}';";
    $r = mysqli_query($c,$sqlQuery);
    while($arr=mysqli_fetch_array($r)){
        SetSession($arr['id_profile']);
        echo 'Bienvenido';
    }
}else{
    echo 'Los datos no pueden quedar vacios!';
}
?>