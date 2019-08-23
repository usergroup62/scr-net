<?php 
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$birthdate = $_POST['birthdate'];

include('conf.php');
if (strcmp($name,"")!=0){
    $sqlquery= "INSERT INTO profile(name,lastname,age,gender,email,password,birthdate) VALUES ('{$name}','{$lastname}','{$age}','{$gender}','{$email}','{$password}','{$birthdate}');";
    $r = mysqli_query($c,$sqlquery);
    echo '¡Registro Exitoso!';
}else{
    echo "El nombre no puede quedar vacio";
}

?>