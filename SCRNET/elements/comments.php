<?php
include_once('conf.php');


if(isset($_POST['action'])){
    switch($_POST['action']){
        case "add":
            $id_post = $_POST['id_post'];
            addcomment($id_post);
            break;
        case "delete":
            $id_c = $_POST['id_com'];
            delcomment($id_c);
                break;
        case "edit":
            $id_c = $_POST['id_com'];
            $com = $_POST['comm'];
            editcomment($id_c,$com);
            break;
    }
    
}
function commentedbyme($id_c,$idcom){
    $sqlquery = "SELECT * FROM comment WHERE id_comment='{$idcom}' AND id_commenter='{$id_c}';";
    $rs = mysqli_query(getDB(),$sqlquery);
    while($ard = mysqli_fetch_array($rs)){
        return true;
    }
    return false;
}
function editcomment($id_com,$new_com){
    if ( strcmp( $id_com, "" ) != 0) {
        $instruccion="Update comment set comment='".$new_com."' where 
id_comment=".$id_com.";";
        $r2 = mysqli_query(getDB(), $instruccion );
        echo '¡Comentario Editado!';
    } else {
        echo "Faltan datos!"; 
    }
}
function delcomment($id_com){
    if ( strcmp( $id_com, "" ) != 0) {
        $instruccion = "delete from comment where id_comment='{$id_com}';";
        $r = mysqli_query(getDB(), $instruccion );
        echo '¡Comentario Eliminado!';
    } else {
        echo "Faltan datos!"; 
    }

}
function addcomment($id_post_com){
    $my_id = base64_decode($_COOKIE['PHP7SESSION']);
    $comment = $_POST['comment'];
    if (strcmp($my_id,"")!=0){
    $sqlquery= "INSERT INTO comment(id_commenter,id_post_com,comment,date) SELECT '{$my_id}','{$id_post_com}','{$comment}',DATE_FORMAT(NOW(),'%d/%m/%Y') as datetoday;";
    $r = mysqli_query(getDB(),$sqlquery);
    echo '¡Comentario publicado!';
}else{
    echo "El nombre no puede quedar vacio";
}

}


?>