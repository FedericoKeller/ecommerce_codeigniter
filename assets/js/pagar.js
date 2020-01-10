
$(document).ready(function(){

	var pagarForm = $("#pagar");

	var validator = pagarForm.validate({

		rules:{
			 tnum : { required : true, minlength: 19},
       exp_date : { required : true, minlength: 5},
       sec_code: { required : true, digits : true, maxlength: 3, minlength: 3}
		},
		messages:{
			 tnum : { required : "Se requiere este campo.", minlength: "Por favor, ingrese 16 caracteres."},
       exp_date : { required : "Se requiere este campo.", minlength: "Por favor, ingrese 4 caracteres."},
        sec_code : { required : "Se requiere este campo.", digits : "Ingrese únicamente números.", minlength: "Por favor, ingrese 3 caracteres.", maxlength: "Por favor, ingrese 3 caracteres."}
		}
	});
});
