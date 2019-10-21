$(document).ready(function(){

	//SETUP PARA UTILIZAR AJAX
	$.ajaxSetup({
			headers:{
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});

	var contfotos = 0;
	$('.nvo_vehiculo').click(function()
	{
			$("#ModalAgregar").modal('show');
	});

	$('.ag_foto').click(function()
	{	contfotos++;
		$('#cont').attr('value',contfotos);
		$('#fila').after('<tr><td> <label name="NoFoto'+contfotos+'"> Fotografia '+contfotos+': </label></td><td><input type="file" name="foto'+contfotos+'" class="form form-control"></td> </tr>');
	});

	$('.rm_foto').click(function()
	{
	if(contfotos>0)
	{
		$('input[name=foto'+contfotos+']').remove();
		$('label[name=NoFoto'+contfotos+']').remove();
		contfotos--;
	}
	});

	$('.registro').dblclick(function()
	{
		var id = $(this).data('id');

		$.ajax({
				type: 'POST',
				url: '/datos/vehiculo',
				data: {id: id},
				success:function(data)
				{
					$("#fot").empty();
					var datos = JSON.parse(data);
					$('.nombre').attr('value',datos[0]['nombre']);	
					$('.descr').attr('value',datos[0]['descripcion']);
					$('.renta').attr('value',datos[0]['renta']);
					$('.cant').attr('value',datos[0]['cantidad']);
					var i = 0;
					 $.each(datos[1], function(index, element){
 					
				$("#fot").append("<td><img width='90' height='90' src='fotos/"+datos[1][i]+"'></td>"); i++;},'json');
			
					 	
					$('#ModalModificar').modal('show');
				}
		});
	
	});


	
});