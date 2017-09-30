function eliminar(id){

    $.get("../model/borrarCritica.php?id="+id, function(data) {

    	$('#fila_'+id).remove();        
        
    });
}