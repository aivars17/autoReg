<?php
    session_start();
 $error = "";
    if (isset($_POST['username'])){
 
        try {
            $conn = new PDO("mysql:host=localhost;dbname=autoreg;charset=utf8", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");
 
            $statement->bindParam(':username', $_POST['username']);
            $statement->execute();
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
 
        }   catch(PDOException $e) {
            echo $e->getMessage();
 
        }
        print_r($user_data);
        if(password_verify($_POST['password'], $user_data['password'])){
       
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['level'] = $user_data['level'];
                $_SESSION['last_login'] = date("Y-m-d H:m:s");

			setcookie("sausainukas",$user_data['username'], time() + (60 * 2), "/"); // 86400 = 1 day
			setcookie("lastTime",date('Y-m-d h:i:sa'), time() + (60 * 2), "/"); // 86400 = 1 day
            header('Location: index.php');
 
        } else {
            $error = '<div class="alert alert-danger" role="alert">
  <strong>ERROR!</strong> Check your username or password.
</div>';
        }
 
   }

    if (isset($COOKIE['sausainukas'])) {
    	echo "labas, ".$_COOKIE['$sausainukas'];
    }
   

    
    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <h2 class="form-signin-heading">Login</h2>
        <?php
            echo $error;
        ?>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text"  name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password"  name="password" class="form-control" placeholder="Password" required>

        <button  class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <a href="register.php" class="btn btn-lg btn-primary btn-block">Register</a>
      </form>

    </div> <!-- /container -->
</body>
</html>