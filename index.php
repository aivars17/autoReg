<?php

session_start();

$admin = '';
$usercsv = '';
if (isset($_SESSION['username']) && $_SESSION['level'] > 0) {
	$alert = "Labas, ". $_SESSION['username'];
} else {
	header('Location: login.php');
}

if (isset($_SESSION['username']) && $_SESSION['level'] > 2) {
	$admin =  '<form style="padding: 20px; background-color: yellow;" action="upload.php" method="post" enctype="multipart/form-data">

	<input class="file" type="file" name="fileToUpload" id="fileToUpload" data-show-preview="false">	

	</form>';
}

if (isset($_SESSION['username']) && $_SESSION['level'] >= 2) {

	$usercsv =  '<form style="padding: 20px; background-color: lightgrey;" action="uploads.php" method="post" enctype="multipart/form-data">

	<input class="file" type="file" name="fileToUpload" id="fileToUpload" data-show-preview="false">	

	</form>';
	if (isset($_GET['delete'])) {
	$conn = new PDO("mysql:host=localhost;dbname=autoreg;charset=utf8", "root", "");
		    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare("DELETE FROM allreg WHERE id = :del");
    $sql->bindParam(':del', $_GET['delete']);
    $sql->execute();
  }

}




function model(){
	$conn = new PDO("mysql:host=localhost;dbname=autoreg;charset=utf8", "root", "");
		    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$statement = $conn->prepare("SELECT model as models FROM allreg group by model");
	$statement->execute();
	$user_data = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($user_data as $data) {
		foreach ($data as $datas) {
			$option = "<option>".$datas."</option>";
		}

	}
}

model();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Automobilių registraciją</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<style>
	#up{
		background-color: blue;
		padding: 10px;
	}
</style>
<!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- piexif.min.js is only needed for restoring exif data in resized images and when you 
	wish to resize images before upload. This must be loaded before fileinput.min.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
	This must be loaded before fileinput.min.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
	HTML files. This must be loaded before fileinput.min.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
	3.3.x versions without popper.min.js. -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
	dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- the main fileinput plugin file -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
	<!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/themes/fa/theme.js"></script>
	<!-- optionally if you need translation for your language then include  locale file as mentioned below -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/(lang).js"></script>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col" id="up">
				<div class="row">
					<div class="col" id="alert" style="padding: 10px; color: white; font-weight: bold;"><?php echo $alert ?></div>
					<a href="logout.php"  class="col-md-2 btn btn-danger">Logout</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="input-group">
					<input id="form_owner" class="form-control" type="text" name="owner" placeholder="Owner">
					<input id="form_license" class="form-control" type="text" name="license" placeholder="License">
					<input id="form_model" class="form-control" type="text" name="model" placeholder="Model">
					<input  id="form_make" class="form-control" type="text" name="Make" placeholder="Make">
				</div><br/>
				<div class="input-group">
					<input id="ajax_post" class="btn btn-danger" type="button" value="Add reg">
					<input id="order" class="btn btn-danger" type="button" value="Last 2">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
			<h4>Users csv</h4>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div id="upload">
					<?php 
					echo $admin;
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h4>Cars csv</h4>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div >
					<?php 
					echo $usercsv;
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<input placeholder="Search" class="form-control col-2" type="text" id="search" name="">
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h2>List</h2>
				<input class="form-control" type="number" id="filter" name="">
				<select class="selectpicker" id="carmodels">

				</select>

				<table class="table table-responsive table-sm">
					<thead>
						<th>#</th>
						<th>Owner</th>
						<th>License</th>
						<th>Model</th>
						<th>Make</th>
						<th>Data</th>
					</thead>
					<tbody id="auto_table_body">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="js/script.js"></script>
</body>
</html>