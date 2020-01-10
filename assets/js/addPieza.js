
$(document).ready(function(){

	var addUserForm = $("#addNewPieza");

	var validator = addUserForm.validate({

		rules:{
			pais : { required : true },
      price : { required : true, number: true},
		  amount : { required : true, digits: true},
      type : { required : true, selected: true}

		},
		messages:{
			name :{ required : "This field is required" },
			price : { required : "This field is required", digits : "Please enter numbers only" },
      amount : { required : "This field is required", digits : "Please enter numbers only" },
			type : { required : "This field is required", selected : "Please select atleast one option" }
		}
	});
});
