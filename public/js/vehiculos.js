 $(document).ready(function(){

	//SETUP PARA UTILIZAR AJAX
	$.ajaxSetup({
			headers:{
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			}
		});

	var contfotos = 0;
	var contfotosmod = 0;
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
		$('#cont').attr('value',contfotos);
		
	}
	});

	//PARA MODIFICAR
		$('.ag_fotomod').click(function()
	{	contfotosmod++;
		$('#nvafotos').attr('value',contfotosmod);
		$('#fil').after('<tr><td> <label name="NoFoto'+contfotosmod+'"> Fotografia '+contfotosmod+': </label></td><td><input type="file" name="foto'+contfotosmod+'" class="form form-control"></td> </tr>');
	});

	$('.rm_fotomod').click(function()
	{
	if(contfotosmod>0)
	{	
		$('input[name=foto'+contfotosmod+']').remove();
		$('label[name=NoFoto'+contfotosmod+']').remove();
		contfotosmod--;
		$('#nvafotos').attr('value',contfotosmod);
		
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
					$('.horas').attr('value',datos[0]['horas']);
					$('#form_elim').attr('action',datos[0]['urlElim']);
					$('.formod').attr('action',datos[0]['urlMod']);
					$('#idv').attr('value',id);
					$('.desc').attr('value',datos[0]['descuento']);
					var i = 0;
					$.each(datos[2],function(index,element)
					{	
						$('.tipos').prepend('<option value='+datos[2][i]['id']+'>'+datos[2][i]['tipo']+'</option>');
						i++;
					});
					$('.tipos option[value='+datos[0]['tipo']+']').attr("selected",true);
				 i = 0;
					 $.each(datos[1], function(index, element){
 					
				$("#fot").append("<td class='imagen' data-id='"+datos[1][i]['id']+"'><img name='fot"+i+"' width='90' height='90' src='fotos/"+datos[1][i]['nombre']+"'></td></input>"); i++;},'json');
			
					 	
					$('#ModalModificar').modal('show');
				}
		});
	
	});

	$('.descuento').on('change',function()
	{
		let option = $('.descuento option:selected').text();
		if(option == 'Si')
		{
			$('#muestra').show();

		}
		else
		{
			$('#muestra').hide();
			$('.desc').attr('value','0');
		}
	});
var elimFot = [];
	$('#fot').on('click','.imagen',function()
	{	

	if($(this).css('filter')=='grayscale(0)')
		{
			elimFot.push($(this).data('id'));
			$('#idfot').attr('value',elimFot);
			$(this).css('filter','grayscale(1)');
			
		}
	else 
		{
			$(this).css('filter','grayscale(0)');
			var encuentraIndice = elimFot.indexOf($(this).data('id'));
			elimFot.splice(encuentraIndice,1);
			$('#idfot').attr('value',elimFot);
		}
	});

//OCULTAR CAMPO DE DESCUENTO AL CARGAR EL DOCUMENTO
	$('#desc').hide();
	$('.montodesc').attr('value','0');	

	$('.sltdesc').on('change',function()
	{
		let option = $('.sltdesc option:selected').text();
		if(option == 'Si')
		{
			$('#desc').show();

		}
		else
		{
			$('#desc').hide();
			$('.montodesc').attr('value','0');
		}

	});

// CAMBIO DE DIVISA
	let rdBtns = $('.rdPrecio');
	let rd = new Array();
	var checked;
	console.log(rdBtns);
	for(var i=0; i<rdBtns.length; i++){
		if(rdBtns[i]['checked'] ===true){
			checked = i;
		}
		//alert(rdBtns[i]['checked']);
	}
	let precioRenta = $('.precioDescuento');
	//let valor = $('.precioDescuento')[0].innerText;
	$.ajax({
		url: 'http://www.google.com/finance/converter?a=1&from=RUB&to=USD',
		dataType: 'json',
		success: function(data){
			console.log(data);
		}

	});
	//console.log(valor);

	/*(i === 0){
		for(var i =0; i<precioRenta.legth;i++){
			let valor = $('.precioDescuento')[i].innerText;
		}
	}*/


});
