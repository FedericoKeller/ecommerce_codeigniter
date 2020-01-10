$(document).ready(function(){
	
	var RegistrationForm = $("#addRegister");


	var validator = RegistrationForm.validate({
	
		rules:{
			lname :{ required : true },
			fname :{ required : true },
			email : { required : true, email : true },
			username :{ required : true },
			password :{ required : true },
		

		},
		messages:{
			lname :{ required : "This field is required" },
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address" },
			username :{ required : "This field is required" },
			password : { required : "This field is required" }
		
						
		}
	});
});
