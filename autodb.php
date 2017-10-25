<?php

header("Content-type:application/json");
try {
			$conn = new PDO("mysql:host=localhost;dbname=autoreg;charset=utf8", "root", "");
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(isset($_POST['owner']) && $_POST['owner'] != "") {
	    $statement = $conn->prepare("INSERT INTO allreg (owner, license, model, make)
	    	VALUES (:owner, :license, :model, :make)");
	   	// variantas 1
	   $statement->bindParam(':owner', $_POST['owner']);
	   $statement->bindParam(':license', $_POST['license']);
	   $statement->bindParam(':model', $_POST['model']);
	   $statement->bindParam(':make', $_POST['make']);
	   $statement->execute();

	   // variantas 2
	   // $statement->execute($_POST);


	    $conn = null;
	  	$response['message'] = ['type' => 'success','body' => 'User was added'];

	} else if (isset($_GET['filter'])) {
    	$statement = $conn->prepare("SELECT * FROM allreg WHERE id >= :id");
    	$statement->bindParam(':id', $_GET['filter']);
    	$statement->execute();
    	$response['allreg'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else  if (isset($_GET['filters'])) {
    	$statement = $conn->prepare("SELECT * FROM allreg where model like :model");
    	$statement->bindParam(':model', $_GET['filters']);
    	$statement->execute();
    	$response['allreg'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else  if (isset($_GET['search'])) {
    	$statement = $conn->prepare("SELECT * FROM allreg where UPPER(owner) like :search");
    	$s = "%" . strtoupper($_GET['search']) ."%";
    	$statement->bindParam(':search', $s);
    	$statement->execute();
    	$response['allreg'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    else if (isset($_GET['filterss'])) {
    	$statement = $conn->prepare("SELECT * FROM allreg ORDER by data desc limit 10");
    	$statement->execute();
    	$response['allreg'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    }else if (isset($_GET['carmodels'])) {
    	$statement = $conn->query("SELECT model as models FROM allreg group by model");
    	$statement->execute();
    	$response['allreg'] = $statement->fetch(PDO::FETCH_ASSOC);
   /* } else if (isset($_POST['submit'])) {
	    	$userscheck = $conn->prepare("SELECT username FROM users where username = :username ");
	    	$userscheck->bindParam(':username', $_POST['username']);
	    	$userscheck->execute();
	    	
    	if($userscheck->fetchColumn() > 0)
			{
			echo "Username already exists";
			}
			else {  $statement = $conn->prepare("INSERT INTO users (username, password)
	    	VALUES (:username, :password)");
			   	// variantas 1
			   $statement->bindParam(':username', $_POST['form_username']);
			   $statement->bindParam(':password', $_POST['form_password']);
			   $statement->execute();
	   		//header('Location: register.php');
			}*/
     }else {
    	$statement = $conn->query("SELECT * FROM allreg");
    	$response['allreg'] = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    $conn = null;
  
} catch(PDOException $e) {
    $response['message'] = ['type' => 'danger','body' =>  $e->getMessage()];
}

echo json_encode($response);