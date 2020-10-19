var op = "";
var nums = "";
var signo = "";
var url = './action/form.php';

$("#enviar").click(function(){
    leerCampos();
    enviarDatos();
    
});


function leerCampos(){
    //leemos la operacion a realizar
    signo = $('input[name=op]:checked').val();
    //leemos los valores de los campos visibles

    

    for (i=1;i<=cont;i++){

        
        if(i>1){
            nums += signo + document.getElementById("inputN"+i).value;
        }else{
            nums += document.getElementById("inputN"+i).value
        }
        
        
    }
    
    //console.log(nums);
}


function enviarDatos(){

    $.ajax({

        data: {n:nums},
        url: url,
        type: 'get',
        beforeSend: function(){
            $(".respuesta").html("Calculando...");
            
        },
        success: function(response){
            $(".respuesta").html(response);
        }

    });
    nums="";
}


