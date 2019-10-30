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
					$('#tbody').append("<tr><td>"+datos[i]['Nombre']+" "+datos[i]['ApellidoP']+" "+datos[i]['ApellidoM']+"</td><td>"+datos[i]['Correo']+"</td><td>"+datos[i]['Sexo']+"</td><td><button class='btn btn-danger' onclick='eliminar(this);' data-id='"+datos[i]['Correo']+"'>Eliminar</button></td></tr>");
					i++;
				},'json');
			}
		});
	});
});
function eliminar(e){
	var token = document.getElementById("token").value;
	$.ajax({
		type: 'POST',
		url: '/usuarios/'+e.dataset.id,
		data:{
			"_token":token,
			"_method":'DELETE',
			"id":e.dataset.id
		},
		success:function(result){
			$('#btnVerTodo').click();
		}
	});
}
