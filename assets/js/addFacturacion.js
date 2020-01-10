
$(document).ready(function(){

	var addUserForm = $("#addFacturacion");

	var validator = addUserForm.validate({

		rules:{
			pais :{ required : true, selected : true},
			dni : { required : true, digits : true },
			nombre : { required : true },
			apellido : { required : true },
     		ciudad : { required : true },
     		direccion: { required : true },
     		region: { required : true },
     		postal: { digits : true },
     		tel: { required : true, digits : true }
		},
		messages:{
			 pais : { required : "Se requiere este campo.", selected : "Por favor, seleccione una opción." },
			 dni : { required : "Se requiere este campo.", digits : "Ingrese únicamente números." },
			nombre :{ required : "Se requiere este campo." },
			apellido :{ required : "Se requiere este campo." },
			ciudad :{ required : "Se requiere este campo." },
			direccion :{ required : "Se requiere este campo." },
			region :{ required : "Se requiere este campo." },
			postal : { digits : "Ingrese únicamente números." },
			 tel : { required : "Se requiere este campo.", digits : "Ingrese únicamente números." }
		}
	});
});