function checkpass(){
	var pass = document.getElementById('form_password');
	var pass_re = document.getElementById('form_password_re');
	var error = document.getElementById('error');
	if (pass.value == pass_re.value) {
		error.style.display = "block";
		error.innerHTML = "";
	
	} else {
		error.style.display = "block";
		error.innerHTML = "Slaptažodis nesutampa";
	}

}



$.getJSON("autodb.php", function(result){
	$.each(result['allreg'], function(i, field){
		$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
			

	});

});

/*$.getJSON("autodb.php", function(result){
	$.each(bam['allreg'], function(i, field){
		$("#carmodel").append("<option>" + field.model + "</option>");
	});

});*/

$("#reg").click(function(){

	$.post("autodb.php",
	{
		username: $("#form_username").val(),
		password: $("#form_password").val(),
		level: $("#form_level").val()
		
	},
	function(data, status){
	   
			
		
	});

});

$("#ajax_post").click(function(){

	$.post("autodb.php",
	{
		owner: $("#form_owner").val(),
		license: $("#form_license").val(),
		model: $("#form_model").val(),
		make: $("#form_make").val()
	},
	function(data, status){

		$("#alert").html("<div class='alert alert-"+data.message.type+"'>" + data.message.body + "</div>");
	   	$.getJSON("autodb.php", function(result){

			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
			});
		});
	});

});


$("#order").click(function(){
	console.log($("#order").val());
	$.getJSON("autodb.php",
	{
		filterss: $("#order").val(),
	},
	 function(result){
	 	console.log(this);
			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
	});

});
});


	
	$.getJSON("autodb.php",
	 function(result){
	 	console.log(this);
			$("#carmodel").html('');
			$.each(result['allreg'], function(i, field){
				$("#carmodel").append("<option>" + field.model + "</option>");
	});

});


$("#search").keyup(function(){
	console.log($("#search").val());
	$.getJSON("autodb.php",
	{
		search: $("#search").val(),
	},
	 function(result){
	 	console.log(this);
			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
	});

});
});


$("#filter").keyup(function(){
	console.log($("#filter").val());
	$.getJSON("autodb.php",
	{
		filter: $("#filter").val(),
	},
	 function(result){
	 	console.log(this);
			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td></tr>");
	});

});
});

$("#carmodel").change(function(){
	console.log($("#carmodel").val());
	$.getJSON("autodb.php",
	{
		carmodels: $("#carmodel").val(),
	},
	 function(result){
	 		console.log(result);
			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td></tr>");
	});

});
});


