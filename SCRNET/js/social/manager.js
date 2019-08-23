// JavaScript Document

function register() {
    $.ajax({
        type: "POST",
        url: 'elements/register.php',
        data: {
            name: document.getElementById("name").value,
            lastname: document.getElementById("lastname").value,
            birthdate: document.getElementById("birthdate").value,
            gender: document.getElementById("gender").value,
            age: document.getElementById("age").value,
            password: document.getElementById("password").value,
            email: document.getElementById("email").value,
        },
        success: function (html) {
            if (html.length != 2) {
                alert(html);
            } else {
                alert(html);
                window.location.href = "index.php";
            }
        }
    });
}

function login() {
    $.ajax({
        type: "POST",
        url: 'elements/login.php',
        data: {
            email: document.getElementById("email").value,
            password: document.getElementById("password").value
        },
        success: function (html) {
            switch (html) {
                case "":
                    alert("Oops\nAlgun dato es incorrecto\nVerifique sus datos");
                    break;
                case "Bienvenido":
                    alert(html);
                    window.location.href = "index.php";
                    break;
                default:
                    alert(html);
                    break;
            }
        }
    });
}
window.onload = load;

function load() {
    var url = new URL(window.location.href);
    var c = url.searchParams.get("request");
    if (c == "true") {
        loadsendrequest();
        loadpendingrequest();
        console.log(c);
    }

}
function loadpendingrequest(){
    $.ajax({
        type: "POST",
        url: 'elements/request.php',
        data: {
            action:"getp",
            id_from:"",
            id_to:""
        },
        success: function (html) {
            document.getElementById("pendingresquests").innerHTML = html;
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
function delfriendship(from,to){
   $.ajax({
        type: "POST",
        url: 'elements/friendship.php',
        data: {
            operation:"remove",
            from:from,
            to:to
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
function post(from){
   $.ajax({
        type: "POST",
        url: 'elements/post.php',
        data: {
            action:"post",
            post_text:document.getElementById("post").value
        },
        success: function (html) {
            alert(html);
        }
    }); 
}
function acceptrequest(from,to){
    $.ajax({
        type: "POST",
        url: 'elements/request.php',
        data: {
            action:"accept",
            id_from:from,
            id_to:to
        },
        success: function (html) {
            alert(html);
        }
    });
}
function cancelrequest(from,to){
    $.ajax({
        type: "POST",
        url: 'elements/request.php',
        data: {
            action:"del",
            id_from:from,
            id_to:to
        },
        success: function (html) {
            alert(html);
        }
    });
}
function sendrequest(from,to){
    $.ajax({
        type: "POST",
        url: 'elements/request.php',
        data: {
            action:"set",
            id_from:from,
            id_to:to
        },
        success: function (html) {
            alert(html);
        }
    });
}
function loadsendrequest(){
    $.ajax({
        type: "POST",
        url: 'elements/request.php',
        data: {
            action:"get",
            id_from:"",
            id_to:""
        },
        success: function (html) {
            document.getElementById("sendingresquests").innerHTML = html;
        }
    });
}

function search_friend() {
    $.ajax({
        type: "POST",
        url: 'elements/search-profiles.php',
        data: {
            name: document.getElementById("namesearch").value
        },
        success: function (html) {
            document.getElementById("searchcontainer").innerHTML = html;
        }
    });
}
