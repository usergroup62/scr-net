// JavaScript Document
function load() {
    var url = new URL(window.location.href);
    var c = url.searchParams.get("id");
    //GetFriendMural(c);
    console.log("Perfil publico: "+c);
}
function GetFriendMural(id){
    $.ajax({
        type: "POST",
        url: 'elements/post.php',
        data: {
            id:id
        },
        success: function (html) {
            document.getElementById("postd").innerHTML = html;
        }
    });
}
function publishfriendprofile(id){
    $.ajax({
        type: "POST",
        url: 'elements/post.php',
        data: {
            action:"post",
            id:id,
            post_text:document.getElementById("post").value
        },
        success: function (html) {
            alert(html);
        }
    }); 
}
function editcomment(idcom) {
      $.ajax({
           type: "POST",
           url: 'elements/comments.php',
           data:{
               action:"edit",
               id_com:idcom,
               comm:prompt("Su nuevo comentario: ","Su nuevo comentario")
           },
           success:function(html) {
                    alert(html);
               window.location.href = "index.php";
           }
      });
 }
function editpost(idcom) {
      $.ajax({
           type: "POST",
           url: 'elements/post.php',
           data:{
               action:"edit",
               id_post:idcom,
               post:prompt("Su nueva publicación: ","Su nuevo comentario")
           },
           success:function(html) {
                    alert(html);
               window.location.href = "index.php";
           }
      });
 }
function delpost(to){
   $.ajax({
        type: "POST",
        url: 'elements/post.php',
        data: {
            action:"del",
            id_post:to
        },
        success: function (html) {
            alert(html);
        }
    }); 
}
function postcomment(pst){
   $.ajax({
        type: "POST",
        url: 'elements/comments.php',
        data: {
            action:"add",
            id_post:pst,
            comment:document.getElementById('post'+pst).value
        },
        success: function (html) {
            alert(html);
        }
    });  
}
function deletecomment(from){
   $.ajax({
        type: "POST",
        url: 'elements/comments.php',
        data: {
            action:"delete",
            id_com:from
        },
        success: function (html) {
            alert(html);
        }
    }); 
}

window.onload = load;