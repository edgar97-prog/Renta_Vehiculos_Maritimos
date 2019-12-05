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
					$('.num_personas').attr('value',datos[0]['num_personas']);
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
		
	$('.sltdesc').on('change',function()
	{
		let option = $('.sltdesc option:selected').text();
		if(option == 'Si')
		{
			$('#desc').show();

		}
		else
		{
			$('.montodesc').attr('value','0');
		}

	});

// CAMBIO DE DIVISA
	$('.rdPrecio').on('change',function(){
		let rdBtns = $('.rdPrecio');
		let rd = new Array();
		var checked;
		var valorDolar = $('#valorDolar')[0].innerText;
		valorDolar = parseFloat(valorDolar);
		//console.log(valorDolar);
		for(var i=0; i<rdBtns.length; i++){
			if(rdBtns[i]['checked'] ===true){
				checked = i;
			}
			//alert(rdBtns[i]['checked']);
		}
		//alert(checked);
		if(checked === 1){
			let precioRenta = $('.precioDescuento');
			let precioRentaAnterior = $('.precioRenta');
			//console.log(precioRenta);
			for(var i=0; i<precioRenta.length;i++){
				let precio =$('.precioDescuento')[i].innerText;
				$('.precioDescuento')[i].innerHTML= (parseFloat(precio) / valorDolar).toFixed(2) + ' USD';
			}
			for(var i=0; i<precioRentaAnterior.length;i++){
				let precio =$('.precioRenta')[i].innerText;
				$('.precioRenta')[i].innerHTML= (parseFloat(precio) / valorDolar).toFixed(2) + ' USD';
			}
		}
		else{
			let precioRenta = $('.precioDescuento');
			let precioRentaAnterior = $('.precioRenta');
			//console.log(precioRenta);
			for(var i=0; i<precioRenta.length;i++){
				let precio =$('.precioDescuento')[i].innerText;
				$('.precioDescuento')[i].innerHTML= (parseFloat(precio) * valorDolar).toFixed(2) + ' MXN';
			}
			for(var i=0; i<precioRentaAnterior.length;i++){
				let precio =$('.precioRenta')[i].innerText;
				$('.precioRenta')[i].innerHTML= (parseFloat(precio) * valorDolar).toFixed(2) + ' MXN';
			}
		}
	});

	$('.formAction').on('submit',function(event){
		//console.log(event);
		event.preventDefault();
		/*var valor = event.currentTarget[2].value;
		console.log(valor);
		$('#Ocu1').val(3000);
		var tb = $('#Ocu1');
		console.log(tb);*/
		var Vehiculo_id = event.currentTarget.id;
		var mgValor = $('#Ocu'+Vehiculo_id).val();
		if(mgValor == 1) //SI YA ESTÁ EN MG
		{
			$.ajax({
				type:'POST',
				url: '/fav/eliminar',
				data:{
						Vehiculo_id: Vehiculo_id,
						'token':$('#token').val()
					},
				success: function(datos){
					if(datos ==1){
						$('#span'+Vehiculo_id).html('<i class="fa fa-heart-o fa-lg iconoFa" title="Agregar a favoritos"></i>');
						$('.btnAction2').attr("title","Agregar a favoritos");
						$('.btnAction').attr("title","Agregar a favoritos");
						$('#Ocu'+Vehiculo_id).val(0);
					}
				},
				error: function(){
					alert('ERROR AL QUITAR DE FAVORITOS');
				}
			});
		}
		else
		{
			$.ajax({
				type:'POST',
				url: '/fav',
				data:{
						Vehiculo_id: Vehiculo_id,
						'token':$('#token').val()
					},
				success: function(datos){
					if(datos ==1){
						//alert('Agregado');
						$('#span'+Vehiculo_id).html('<i class="fa fa-heart fa-lg iconoFa" title="Quitar de favoritos" aria-hidden="true"></i>');
						$('.btnAction2').attr("title","Quitar de favoritos");
						$('.btnAction').attr("title","Quitar de favoritos");
						$('#Ocu'+Vehiculo_id).val(1);
					}
					else{
						if(datos == 0){
							$("#login").modal('show');
						}
					}
				},
				error: function(){
					alert('ERROR AGREGAR FAVORITOS');
				}
			});
		}
		//alert(event.elements);
		
	});

	$('.terminos').click(function()
	{	
		$('.tituloTerm').empty();
		$('.comentarioModal').empty();
		$('.tituloTerm').append('Términos y Condiciones');
		let texto = '1.- Usted solo puede hacer reservaciones con un mínimo de 24 hrs. de anticipación hasta 1 semana. <br><br> 2.- Usted puede hacer cancelaciones únicamente antes de las 24 hrs. de la hora de renta, de el contrario, la renta se cobrará';
		texto = texto+'<br><br>3.- El precio mostrado es en dolares. Por lo que, si se hará el pago en pesos mexicanos, se calculará con el valor actual del dolar.';
		$('.comentarioModal').append('<center>'+texto+'</center>');
		$('#ModalComent').modal('show');
	})

});
