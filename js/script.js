

$("#fileToUpload").ready(function(){

	$.post("autodb.php",
	{
		carmodels: $("#fileToUpload").val(),
		
	},
	function(data, status){
		if ("#fileToUpload" == true) {
	$.getJSON("autodb.php", function(result){
	$.each(result['allreg'], function(i, field){
		$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td><td><a class='btn btn-sm btn-danger' id='delet' href='?delete=" + field.id + "'>Delete</a></td></tr>");
			

	});

});
} else {
	$.getJSON("autodb.php", function(result){
	$.each(result['allreg'], function(i, field){
		$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
			

	});

});
}
		});

});


$("#carmodels").ready(function(){

	$.post("autodb.php",
	{
		carmodels: $("#carmodels").val(),
		
	},
	function(data, status){

		
	   	$.getJSON("autodb.php", function(result){

			$("#carmodels").html('');
			$.each(result['allreg'], function(i, field){
				$("#carmodels").append("<option>" + field.model + "</option>");
			});
		});
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
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
	});

});
});

$("#carmodels").change(function(){

	$.getJSON("autodb.php",
	{
		filters: $("#carmodels").val()
	},
	 function(result){
	 		console.log(result);
			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
	});

});
});

$("#allcars").change(function(){

	$.getJSON("autodb.php",
	{
		
	},
	 function(result){
	 		console.log(result);
			$("#auto_table_body").html('');
			$.each(result['allreg'], function(i, field){
				
				$("#auto_table_body").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model + "</td><td>" + field.make + "</td><td>" + field.data + "</td></tr>");
	});

});
});
