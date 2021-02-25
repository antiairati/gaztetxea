
// A $( document ).ready() block.
$( document ).ready(function() {
    $( "#izena" ).val('');
    $( "#abizena" ).val('');
    $( "#email" ).val('');
    $( "#zenbat" ).val('1');
    var data={}
    data["check"]=true;
    console.log(data);
    $.ajax({
        // la URL para la petición
        url :'/checkAforoa.php',
    
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
        success : function(response) {
            //var result=JSON.parse(response);
            if (response["libre"]==false){
                $( "#form" ).hide();
                $( "#erreserbatuta" ).hide();
                $( "#errorea" ).hide();
                $( "#errorErreserba" ).hide();
            }
            else{
                $( "#errorErreserba" ).hide();
                $( "#beteta" ).hide();
                $( "#erreserbatuta" ).hide();
                $( "#errorea" ).hide();
                $('#zenbat option').each(function() {
                    if ( $(this).val() > response["kopurua"] ) {
                        $(this).remove();
                    }
                });
            }
        },
        // código a ejecutar si la petición falla;-
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    }); 
});