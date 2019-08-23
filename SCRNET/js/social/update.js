// JavaScript Document
function updateprofile(){
    $.ajax({
        type: "POST",
        url: 'elements/edit-profile.php',
        data: {
            name:document.getElementById("name").value,
            lastname:document.getElementById("lastname").value,
            age:document.getElementById("age").value,
            gender:document.getElementById("gender").value,
            birthdate:document.getElementById("datepicker").value,
            photo:document.getElementById("defphoto").value,
            biography:document.getElementById("bio").value,
            email:document.getElementById("email").value,
            password:document.getElementById("pass").value,
            phone:document.getElementById("phone").value
        },
        success: function (html) {
            alert(html);
        }
    });
}

$('#upload').on('click', function() {
    var file_data = $('#fileToUpload').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('fileToUpload', file_data);
    //alert(file_data.);                             
    $.ajax({
        url: 'elements/upload.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            //document.getElementById("img").value = php_script_response;
            //alert(php_script_response); // display response from the PHP script, if any
            switch(php_script_response){
                case "errorerrorerror":
                    alert("La imagen no pudo subirse\nLa operación continua con la imagen\por defecto");
                    updateprofile();
                    break;
                    case "error":
                    alert("La imagen no pudo subirse\nLa operación continua con la imagen\por defecto");
                    updateprofile();
                    break;
                default:
                    document.getElementById("defphoto").value = "uploads/"+php_script_response;
                    updateprofile();
                    break;
                   }
        }
     });
});


