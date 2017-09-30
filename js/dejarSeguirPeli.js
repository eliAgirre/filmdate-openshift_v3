function borrarComentPeli(id){
    $.get("../model/borrarComentPeli.php?id="+id, function(data) {

    	$('#fila_'+id).remove();     
        
    });
}
