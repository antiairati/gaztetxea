
function checkFormIzena(){
    if( !$("#izena").val() ) {
        return false;
    }else{
        return true;
    }
}

function checkFormAbizena(){
    if( !$("#abizena").val() ) {
        return false;
    }else{
        return true;
    }
}

function isEmail() {
    var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return EmailRegex.test($( "#email" ).val());
}

$('#submit').on('click', function(event) {
    if(checkFormIzena() && checkFormAbizena() && isEmail()){
        $( "#errorea" ).hide();
        $( "#submit" ).prop( "disabled", true );
        $( "#submit" ).val('ITXOIN');
        var izena=$( "#izena" ).val();
        var abizena=$( "#abizena" ).val();
        var email=$( "#email" ).val();
        var id=$( "#ekintza_id" ).val();
        var zenbat=$( "#zenbat" ).val();
        var data={}
        data["izena"]=izena;
        data["abizena"]=abizena;
        data["email"]=email;
        data["zenbat"]=zenbat;
        data["id"]=id;
        console.log(data);
        $.ajax({
            // la URL para la petición
            url :'/insertErreserba.php',
        
            // la información a enviar
            // (también es posible utilizar una cadena de datos)
            data : JSON.stringify(data),
        
            // especifica si será una petición POST o GET
            type : 'POST',
        
            // el tipo de información que se espera de respuesta
            dataType : 'json',
            contentType: 'application/json; charset=utf-8',
            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success : function(json) {
                if (json["posts"]["result"]=="OK"){
                    $( "#submit" ).prop('disabled', true);
                    $( "#form" ).hide();
                    $( "#erreserbatuta" ).show();
                }else{
                    $( "#submit" ).prop('disabled', true);
                    $( "#form" ).hide();
                    $( "#errorErreserba" ).show();
                } 
            },
        
            // código a ejecutar si la petición falla;-
            // son pasados como argumentos a la función
            // el objeto de la petición en crudo y código de estatus de la petición
            error : function(xhr, status) {
                $( "#submit" ).prop('disabled', true);
                $( "#form" ).hide();
                $( "#errorErreserba" ).show();
            }
        });
    }else{
        $( "#errorea" ).show();
    }
});  