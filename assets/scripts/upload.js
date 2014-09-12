var name_of_upload_file;

function getName (str){
               
    if (str.lastIndexOf('\\')){

        var i = str.lastIndexOf('\\')+1;
    } else {

        var i = str.lastIndexOf('/')+1;
    }                       
    var filename = str.slice(i);            
    var uploaded = document.getElementById("fileformlabel");
    name_of_upload_file=filename;
    uploaded.innerHTML = filename;
}

$('.download').click(function(event){

    event.preventDefault();
    var data = new FormData($('#mainForm')[0]);
    
    $.ajax({
        type: "POST",
        url : 'assets/model/upload.php',
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function() {

            $('#loader').show();
        }
    }).done(function (html) {
        
        $("#results").append(html);
        $('#loader').hide();
        $('#mainForm')[0].reset();
    });
});