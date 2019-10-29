$(document).ready(function(){
	$.ajaxSetup({
	headers:{
		'X-CSRF-Token': $('meta[name=_token]').attr('content')
	}
	});
	$('#btnVerTodo').click(function(){
		document.getElementById("subcuerpo").style.display = 'block';
		$.ajax({
			type:'GET',
			url:'/Empleados',
			success: function(data){
				var datos = JSON.parse(data);
				$('#tbody').empty();
				var i = 0;
				$.each(datos,function(index,element){
					$('#tbody').append("<tr><td>"+datos[i]['Nombre']+" "+datos[i]['ApellidoP']+" "+datos[i]['ApellidoM']+"</td><td>"+datos[i]['Correo']+"</td><td>"+datos[i]['Sexo']+"</td><td><a href='#' class='btn btn-danger'>Eliminar</a></td></tr>");
					i++;
				},'json');
			}
		});
	});
});
