<?php
$target_dir = "uploads/";
$target_file = $target_dir .date("Y-m-d_H-i")."-". basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$csvFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo $check["mime"];
        $uploadOk = 1;
    } else {
        echo "File is not an csv.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($csvFileType != "csv" && $csvFileType != "CSV") {
    echo "Sorry, only CSV files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        try {
            $conn = new PDO("mysql:host=localhost;dbname=autoreg;charset=utf8", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $files = fopen($target_file ,"r");
           
            for($id=1;!feof($files);$id++) {
 			 $file = explode(",",rtrim(fgets($files),"\n"));
 			 $statement = $conn->prepare("INSERT INTO users (username, password, level)
	    	VALUES (:username, :password, :level)");
			   	// variantas 1
			   $statement->bindParam(':username', $file[0]);
			   $hash = password_hash($file[1], PASSWORD_DEFAULT);
			   $statement->bindParam(':password', $hash);
			   $statement->bindParam(':level', $file[2]);
			   $statement->execute();
	   		header('Location: index.php');
 			}
        }   catch(PDOException $e) {
            echo $e->getMessage();
 
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>