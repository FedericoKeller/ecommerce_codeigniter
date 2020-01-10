$(document).ready(function(){

	var PiezaForm = $("#addPieza");


	var validator = PiezaForm.validate({
 wrapper: 'span',
    errorPlacement: function(label, element) {
         label.addClass('newError');
         label.insertAfter(element);
     },


		rules:{
			nombre :{ required : true },
			precio :{ required : true, number : true },
			cantidad :{ required : true, digits : true },
			descripcion: { required : true },



		},
		messages:{
			nombre :{ required : "Este campo es requerido. Por favor, ingrese los datos correspondientes." },
			cantidad :{ required : "Este campo es requerido. Por favor, ingrese los datos correspondientes.", digits : "Por favor, solo ingrese números para cumplir con lo pedido."  },
			precio :{ required : "Este campo es requerido. Por favor, ingrese los datos correspondientes.", digits : "Por favor, solo ingrese números. Pueden ser tanto enteros como reales."  },
			descripcion :{ required : "Este campo es requerido. Por favor, ingrese los datos correspondientes." },


		}
	});
});
