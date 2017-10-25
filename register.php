<?php 
$conn = new PDO("mysql:host=localhost;dbname=autoreg;charset=utf8", "root", "");
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['form_username']) && $_POST['form_password'] == $_POST['form_password_re']) {
	    	$userscheck = $conn->prepare("SELECT * FROM users where username = :username ");
	    	$userscheck->bindParam(':username', $_POST['form_username']);
	    	$userscheck->execute();
	    	
    	if(!empty($userscheck->fetch(PDO::FETCH_ASSOC))){
			$error[] = "Username already exists";
			}else {  
				$statement = $conn->prepare("INSERT INTO users (username, password)
	    	VALUES (:username, :password)");
			   	// variantas 1
			   $statement->bindParam(':username', $_POST['form_username']);
			   $hash = password_hash($_POST['form_password'], PASSWORD_DEFAULT);
			   $statement->bindParam(':password', $hash);
			   $statement->execute();
	   		header('Location: login.php');
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<style>
		body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

	</style>

</head>
<body>
    <div class="container">
      <form method="POST" class="form-signin">
        <h2 class="form-signin-heading">Register</h2>
 

       
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="form_username" name="form_username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="form_password" name="form_password" class="form-control" placeholder="Password" required>
        <input onkeyup="checkpass()" type="password" id="form_password_re" name="form_password_re" class="form-control" placeholder="Re-password" required>
        <div id="error"></div>
        <button disabled id="reg" class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>

    </div> <!-- /container -->
	<script>
		function checkpass(){
	var pass = document.getElementById('form_password');
	var pass_re = document.getElementById('form_password_re');
	var error = document.getElementById('error');
	var reg = document.getElementById('reg');
	if (pass.value == pass_re.value) {
		error.style.display = "block";
		error.innerHTML = "";
		reg.disabled = false;
	
	} else {
		error.style.display = "block";
		error.innerHTML = "Slaptažodis nesutampa";
		reg.disabled = true;

	}

}
	</script>
</body>
</html>