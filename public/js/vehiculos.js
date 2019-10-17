$(document).ready(function(){
	var contfotos = 1;
	$('.nvo_vehiculo').click(function()
	{
			$("#ModalAgregar").modal('show');
	});

	$('.ag_foto').click(function()
	{	contfotos++;
		$('.ag_foto').after('<tr><td> <label> Fotografia '+contfotos+': </label></td><td><input type="file"></td> </tr>');
	});
});