$(document).ready(function(){
	$.ajaxSetup({
	headers:{
		'X-CSRF-Token': $('meta[name=_token]').attr('content')
	}
	});
	$('#btnVerTodo').click(function(){
		$('#subcuerpoComments').css('display','none');
		$.ajax({
			type:'GET',
			url:'/Empleados',
			success: function(data){
				var datos = JSON.parse(data);
				$('#tbody').empty();
				var i = 0;
				$.each(datos,function(index,element){
					$('#tbody').append("<tr style='cursor:default;' data-id='"+datos[i]['Correo']+"'><td class='rowEmp'>"+
						datos[i]['Nombre']+" "+datos[i]['ApellidoP']+" "+datos[i]['ApellidoM']+
						"</td><td class='rowEmp'>"+datos[i]['Correo']+"</td><td class='rowEmp'>"
						+datos[i]['Sexo']+"</td><td><button class='btn btn-danger btnEliminar' title='Eliminar empleado' data-id='"+datos[i]['Correo']+"'>Eliminar</button></td></tr>");
					i++;
				},'json');
				document.getElementById("subcuerpo").style.display = 'block';
				$('.rowEmp').dblclick(function(){
					var id = this.parentElement.dataset.id;
					var token = document.getElementById("token").value;
					$.ajax({
						type:'POST',
						url:'/datosEmp',
						data:{
							'id':id,
							'_token':token
						},
						success:function(data){
							var datos = JSON.parse(data);
							$('#_calle').html(datos[0]['Calle']);
							$('#_colonia').html(datos[0]['Colonia']);
							$('#_cp').html(datos[0]['CP']);
							$('#_tel').html(datos[1]['Telefono']);
							$("#ModalDatosEmp").modal('show');		
						}
					});
				});
				$('.btnEliminar').click(function(){
					var token = document.getElementById("token").value;
					$.ajax({
						type: 'POST',
						url: '/usuarios/'+this.dataset.id,
						data:{
							"_token":token,
							"_method":'DELETE',
							"id":this.dataset.id
						},
						success:function(result){
							$('#btnVerTodo').click();
						}
					});
				});
			}
		});
	});
	$('#btnVerComentarios').click(function(){
		$('#subcuerpo').css('display','none');
		$.ajax({
			type:'POST',
			url:'/comentarios',
			data:{
				'token':$('#token').val()
			},
			success:function(data){
				var datos = JSON.parse(data);
				$('.listaUsers').html("");
				var i = 0;
				var Fhoy = new Date().format("d/mm/yyyy");
				$.each(datos,function(index,element){
					var FechaMsj = new Date(datos[i]["updated_at"]);
					if(Fhoy === FechaMsj.format("d/mm/yyyy")){
						$('.listaUsers').append("<li data-id='"+datos[i]["usuario"]["Correo"]+
							"'><span class='icoInfo' title='Ver datos del cliente'><i class='fa fa-info-circle' aria-hidden='true'></i></span>"
							+datos[i]["usuario"]["Nombre"]+" "+datos[i]["usuario"]["ApellidoP"]+" "+
							datos[i]["usuario"]["ApellidoM"]+"<span class='fechaComment'>Hoy a las "+FechaMsj.format("h:MM")+"</span>"+"</li>");
					}else{
					$('.listaUsers').append("<li data-id='"+datos[i]["usuario"]["Correo"]+
							"'><span class='icoInfo' title='Ver datos del cliente'><i class='fa fa-info-circle' aria-hidden='true'></i></span>"
							+datos[i]["usuario"]["Nombre"]+" "+datos[i]["usuario"]["ApellidoP"]+" "+
							datos[i]["usuario"]["ApellidoM"]+"<span class='fechaComment'>"+FechaMsj.format("m/dd/yyyy h:MM")+"</span>"+"</li>");
					}
					i++;
				},'json');
				$('#mensajes').html("");
				var clickhijo = false;
				$('.listaUsers').on('click','li',function(){
					if(clickhijo){
						clickhijo = false;
						return;
					}
					$.ajax({
						type:'POST',
						url:'/getMsjs',
						data:{
							'token':$('#token').val(),
							'id':$(this).data('id')
						},
						success:function(data){
							$('#mensajes').html("");
							var datos = JSON.parse(data);
							var i = 0;
							$.each(datos,function(index,element){
								$('#mensajes').append("<div class='msjDer'><span>"+datos[i]+"</span></div>");
								i++;
							},'json');
							document.getElementById("mensajes").scrollTop = document.getElementById("mensajes").scrollHeight;
						}
					});
				});
				$('.icoInfo').on('click',function(){
					clickhijo = true;
					//$(this).parent("li").data('id');
					$.ajax({
						type:'POST',
						url:'/datosCliente',
						data:{
							'token':$('#token').val(),
							'id':$(this).parent("li").data('id')
						},
						success:function(data){
							var datos = JSON.parse(data);
							console.log(datos);
							$('#_correo').html(datos['Correo']);
							$('#_telefono').html(datos['telefonos'][0]['Telefono']);
							$("#ModalDatosCli").modal('show');
						}
					});
				});
				$('#subcuerpoComments').css('display','block');
			}
		});
	});

	$('.btnComentarios').click(function(){
		var comentario = $('.coment').val();
		if(comentario === "")
			alert("Necesita rellenar el campo comentario");
		else{
			$.ajax({
				type: 'POST',
				url: '/comentario',
				data: {comentario: comentario},
				success:function(mensaje)
				{	
					$('.coment').val('');
					$('.comentarioModal').html('<center><label>'+ mensaje +'</label></center>');
					$('#ModalComent').modal('show');
				}
			});
		}
	});

	$('#frmcuenta').on('submit',function(event){
		if($('#btnDesb').length){
			event.preventDefault();
			$('#frmcuenta').find("input").css('pointer-events','auto');
			$('#frmcuenta').find("select").css('pointer-events','auto');
			$("input[name='Nombre']").focus();
			$('input[type="text"]').css('cursor','text');
			$('#btnCancelar').css('display','block');
			$('#btnDesb').attr("id","btnMod");
			$('#btnMod').css('min-width','155px');
			$('#btnMod').html("Guardar cambios <i class='fa fa-pencil'></i>");
			document.getElementById("btnMod").classList.remove("btn-primary");
			document.getElementById("btnMod").classList.add("btn-success");
			$('#btnMod').on('click',function(){
				//event.preventDefault();
			});
		}
	});
	$('#btnCancelar').on('click',function(){
		event.preventDefault();
		location.reload(true);
	});
	$('.listImgs').on('mouseover','li',function(e){
		$src = $(this).children('img').attr('src');
		$('#imgCurrent').attr('src',$src);
		$(this).parent('ul').find('li').children('img').attr('class','img-fluid');
		$(this).children('img').addClass('imgselected');
	});
	var Dhoy = new Date();
	var tomorrow = new Date(Dhoy);
	tomorrow.setDate(tomorrow.getDate() + 1);
	$('#calendar').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Do', 'Lu', 'Ma', 'MI', 'Ju', 'Vi', 'Sá'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		dateFormat: 'yy-mm-dd',
		onSelect: function (date) {
			$('#showCalendar').html(date);
			$('#calendar').css('display','none');
			calendarioMostrado = false;
			//ACTUALIZAR HORAS DISPONIBLES
			ActualizaHorasDisponibles(date);
			VerificaListaHoras();
		},
		minDate: tomorrow,
		maxDate: "+1w +1d"
    });
    function ActualizaHorasDisponibles(date){
    	$("#listaHrsIni").html("");
    	$('.HrInicio').html("");
    	$('.listHrs').html("");
    	var CHR = $("#LHR").val();
    	if (typeof arrFechas === 'undefined') {
    		var tamF = 0;
    	}else{
    		var tamF = arrFechas.length;	
    	}
    	var pos = [];
    	for (var i = 0; i < tamF; i++) {
			if(date === arrFechas[i]){
				pos.push(i);
			}
		}
		var tamP = pos.length;
		if(tamP === 0){
    		for (var i = 9; i < 18 - CHR; i++) {
    			$('#listaHrsIni').append("<option value='"+i+"'>"+i+":00</option>");
    		}
    	}else{
    		for (var i = 9; i < 18 - CHR; i++) {
    			var band = false;
    			var Inc = 0;
    			for (var j = 0; j < tamP; j++) {
    				if(arrHrs[j] === i){ //9|2 14|2
    					band = true;
    					Inc = arrCant[j];//11 12 13 14 15 16 17
    					j = tamP;
    				}
    			}
    			if(band)
    				i += Inc - 1;
    			else{
    				var desocupado = true,HrOcupada = 0;
    				for (var h = parseInt(i)+1; h < (parseInt(i)+parseInt(CHR)); h++) {
    					for (var j = 0,p = 1; j < tamP; j++,p++) {
    						if(arrHrs[j] === h){
    							HrOcupada = h;
    							h = (parseInt(i)+parseInt(CHR));
    							j = tamP;
    							desocupado = false;
    							break;
    						}
    					}
    				}
    				if(desocupado){
    					$('#listaHrsIni').append("<option value='"+i+"'>"+i+":00</option>");
    				}else{
    					i =  parseInt(HrOcupada) - 1;
    				}
    			}
    		}
    	}
	    crear_select();
    }
    function VerificaListaHoras(){
    	var Activo = $('.HrInicio').find('.active').html();
		if(typeof Activo === 'undefined'){
			$('#ListaHrsD').css('display','none');
			$('#lblHrsD').css('display','none');
			$('#spanMsj').html("No hay horas disponibles, intenta otra fecha u menos horas.");
		}else{
			$('#lblHrsD').css('display','block');
			$('#spanMsj').html("Selecciona la hora de inicio de apartado");
			$('#ListaHrsD').css('display','block');
		}
    }
    var calendarioMostrado = false;
    $('#showCalendar').on('click',function(){
    	if(!calendarioMostrado){
    		calendarioMostrado = true;
    		$('#calendar').css('display','block');
    	}else{
    		calendarioMostrado = false;
    		$('#calendar').css('display','none');
    	}
    });
    $('.listHrs').on('click','li',function(){
    	ActualizaHorasDisponibles($('.btnSC').html());
		VerificaListaHoras();
    });
    var timerErr;
    $('#btnRenta').on('click',function(){
    	var Activo = $('.HrInicio').find('.active').html();
    	if($('.btnSC').html()==="--/--/----"){
    		clearInterval(timerErr);
    		$("#errRenta").css('display','block');
    		$(".btnSC").focus();
    		$(".btnSC").click();
    		timerErr = setInterval(hideErr,2000);
    	}else if(typeof Activo === 'undefined'){
    		clearInterval(timerErr);
    		$("#errRenta").html("No hay horas disponibles");
    		$("#errRenta").css('display','block');
    		timerErr = setInterval(hideErr,2000);
    	}
    	else{
    		var FechaIni = $('.btnSC').html()+" "+$('.HrInicio').find('.active').html();
    		var hrsRenta = $('.listHrs').find('.active').html();
			var idv = $(this).data('id');
			$.ajax({
				type:'POST',
				url:'/rentas',
				data:{
					'token':$('#token').val(),
					'idv':idv,
					'FI':FechaIni,
					'HR':hrsRenta
				},
				beforeSend:function(){
					$('#btnRenta').css('pointer-events','none');
					$('#body').css('cursor','progress');
					clearInterval(timerErr);
					if($('#btnRenta').hasClass("btn-warning")){
		    			$("#errRenta").html("ESPERE MIENTRAS SE EFECTUA LA RENTA");
			    		document.getElementById("errRenta").classList.remove("alert-danger");
			    		document.getElementById("errRenta").classList.add("alert-success");
			    		$("#errRenta").css('display','block');
			    		timerErr = setInterval(hideErr,3500);
		    		}else{
		    			$("#errRenta").html("ESPERE MIENTRAS SE CANCELA LA RENTA");
			    		document.getElementById("errRenta").classList.remove("alert-danger");
			    		document.getElementById("errRenta").classList.add("alert-warning");
			    		$("#errRenta").css('display','block');
			    		timerErr = setInterval(hideErr,2000);
		    		}
				},
				success:function(data){
					if($('#btnRenta').hasClass("btn-warning"))
						document.getElementById("errRenta").classList.remove("alert-success");
					else
						document.getElementById("errRenta").classList.remove("alert-warning");
					if(data === 'E'){
						$('.comentarioModal').html('<center><label>La renta se ha realizado correctamente.<br>En breve uno de nuestros empleados se pondrá en contacto con usted para corroborar la renta.</label></center>');
						$('#ModalComent').modal('show');
						document.getElementById("btnRenta").classList.remove("btn-warning");
						document.getElementById("btnRenta").classList.add("btn-danger");
						$('.select_mate').css('pointer-events','none');
						$('#showCalendar').css('pointer-events','none');
						$('#btnRenta').html("CANCELAR RENTA");
					}else if(data === 'C'){
						$('.comentarioModal').html('<center><label>La renta ha sido cancelada con exito.</label></center>');
						$('#ModalComent').modal('show');
						$('.select_mate').css('pointer-events','auto');
						$('#showCalendar').css('pointer-events','auto');
						document.getElementById("btnRenta").classList.remove("btn-danger");
						document.getElementById("btnRenta").classList.add("btn-warning");
						$('#btnRenta').html("¡RENTAR AHORA!");
					}
					else{
						$("#login").modal('show');
					}
					$('#btnRenta').css('pointer-events','auto');
					$('#body').css('cursor','default');
					$("#errRenta").css('display','none');
		    		document.getElementById("errRenta").classList.add("alert-danger");
				}
			});
    	}
    });
    function hideErr(){
    	$("#errRenta").css('display','none');
    	$("#errRenta").html("Debes seleccionar una fecha.");
    	clearInterval(timerErr);
    }
    $('#btnRentaCon').on('click',function(){
    	var idr = $(this).data('id');
    	$.ajax({
    		type: 'get',
    		url:'/rentas/'+idr,
    		data:{
    			'id':idr
    		},
    		success:function(data){
    			var datos = JSON.parse(data);
    			$('.tituloTerm').html("DATOS DE LA RENTA");
    			$('.comentarioModal').html("<center>"+
    				"<label>Usted ha rentado el vehículo en la fecha: <strong>"+datos['fechaIni'].substring(0,10)+"</strong></label>"+
    				"<br><label>La renta inicia a las <strong>"+datos['fechaIni'].substring(10,16)+
					"</strong> y termina a las <strong>"+(parseInt(datos['fechaIni'].substring(10,13))+parseInt(datos['hrsRenta']))+":00</strong>"+
    				"</label>"+
    				"<label>el precio de renta por hora es de <strong style='font-size:19px;'>$"+datos['precioDescuento']+"</strong></label>"+
    				"<br><label><strong style='font-size:20px;'>Total: </strong><strong style='color:green;font-size:20px;'>$"+(parseInt(datos['precioDescuento'])*parseInt(datos['hrsRenta']))+"</strong></label>"+
    				"</center>");
				$('#ModalComent').modal('show');
    			console.log(datos);
    		}
    	});
    });
});
