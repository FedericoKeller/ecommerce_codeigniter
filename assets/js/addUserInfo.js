
$(document).ready(function(){

	var addUserForm = $("#addUserInfo");

	var validator = addUserForm.validate({

		rules:{
			dni : { required : true, digits : true },
			nombre : { required : true },
			apellido : { required : true },
     		tel: { required : true, digits : true }
		},
		messages:{
			 dni : { required : "Se requiere este campo.", digits : "Ingrese únicamente números." },
			nombre :{ required : "Se requiere este campo." },
			apellido :{ required : "Se requiere este campo." },
			 tel : { required : "Se requiere este campo.", digits : "Ingrese únicamente números." }
		}
	});
});
