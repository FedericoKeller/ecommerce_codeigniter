
$(document).ready(function(){

	var addUserForm = $("#addUser");

	var validator = addUserForm.validate({

		rules:{
			fname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true},
      civil :{ required : true },
      exp :{ required : true, selected : true},
      dir :{ required : true },
      money :{ required : true, number: true },
      studies :{ required : true },
      hours :{ required : true, digits: true }

		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" },
      civil :{ required : "This field is required" },
      exp : { required : "This field is required", selected : "Please select atleast one option" },
      dir :{ required : "This field is required" },
      money : { required : "This field is required", digits : "Please enter numbers only" },
      studies :{ required : "This field is required" },
      hours :{ required : "This field is required" , digits : "Please enter numbers only" }
		}
	});
});
