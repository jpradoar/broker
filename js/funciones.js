function confirmarBaja(url){ // esta es una funcion exactamente igual que la anterior pero con tres casos distintos
	switch(url){
		case 'presu':
			var mensaje = 'Si pulsa el botón "OK" se eliminará el producto seleccionado'; // creo la variable con var
			var url = 'nuevopresu.php';
			break;
	}
	
	if (confirm (mensaje)){ // si da ok al contenido de la varible mensaje genera un true
		return true; // continuo con la tarea
	}
	
	window.location= url; // si el if no se cumple redirecciona a panel productos
	return false; // corta el envio
}