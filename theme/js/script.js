$('#submit').on('click', function(event) {
    var izena=$( "#izena" ).val();
    var abizena=$( "#abizena" ).val();
    var email=$( "#email" ).val();
    var id=$( "#ekintza_id" ).val();
    var data={}
    data["izena"]=izena;
    data["abizena"]=abizena;
    data["email"]=email;
    data["zenbat"]=zenbat;
    data["id"]=id;
    console.log(data);
    $.ajax({
        // la URL para la petición
        url :$SCRIPT_ROOT+'/form',
    
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
            alert('Dena ondo joan da');
        },
    
        // código a ejecutar si la petición falla;-
        // son pasados como argumentos a la función
        // el objeto de la petición en crudo y código de estatus de la petición
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    }); 

});