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
						$('.listaUsers').append("<li data-id='"+datos[i]["usuario"]["Correo"]+"'>"
						+datos[i]["usuario"]["Nombre"]+" "+datos[i]["usuario"]["ApellidoP"]+" "+
						datos[i]["usuario"]["ApellidoM"]+"<span class='fechaComment'>Hoy a las "+FechaMsj.format("h:MM")+"</span>"+"</li>");
					}else{
					$('.listaUsers').append("<li data-id='"+datos[i]["usuario"]["Correo"]+"'>"
						+datos[i]["usuario"]["Nombre"]+" "+datos[i]["usuario"]["ApellidoP"]+" "+
						datos[i]["usuario"]["ApellidoM"]+"<span class='fechaComment'>"+FechaMsj.format("m/dd/yyyy h:MM")+"</span>"+"</li>");
					}
					i++;
				},'json');
				$('#mensajes').html("");
				$('.listaUsers').on('click','li',function(){
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
				$('#subcuerpoComments').css('display','block');
			}
		});
	});

	$('.btnComentarios').click(function(){

		var comentario = $('.coment').val();
		if(comentario == "")
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
		//$(this).children('img').removeClass('imgselected');
	});
	$('#calendar').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Do', 'Lu', 'Ma', 'MI', 'Ju', 'Vi', 'Sá'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		dateFormat: 'dd/mm/yy',
		onSelect: function (date) {
			//alert(date);
			$('#showCalendar').html(date);
		}
    });
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
});
