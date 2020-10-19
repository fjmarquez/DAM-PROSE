
    var cont = 2;
    
    $("#agregar").click(function(){
        if(cont<8){
            //contador de campos +1
            cont = cont+1;

            var oid = "#n"+cont;
            //alert(oid);
            //hacemos visible el campo añadido
            $(oid).removeClass("invisible");


            //desactiva el boton agregar cuando el numero de campos es 8
            if(cont==8){
                $("#agregar").prop("disabled", true);
            }
            //activa el boton eliminar si hay mas de 2 campos
            if(cont>2){
                $("#eliminar").prop("disabled", false);
            }
        }
        //alert(cont);
    });

    $("#eliminar").click(function(){
        if(cont>2){
            //contador de campos -1
            cont=cont-1;

            var oid = "#n"+(cont+1);
            //alert(oid);
            //hacemos invisible el campo eliminado
            $(oid).addClass("invisible");


            
            //desactiva el boton eliminar cuando el numero de campos es 2
            if(cont==2){
                $("#eliminar").prop("disabled", true);
            }

            //activa el boton agregar si hay menos de 8 campos
            if(cont<8){
                $("#agregar").prop("disabled", false);
            }
        }
        //alert(cont);
    });
