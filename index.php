<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$id = "";
$ucid = "";
$password = "";






mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($servername, $username, $password, $dbname);
	}

catch (mysqli_sql_exception $ex) {
    echo 'Error';
	}


// get values from the form
function getPosts()
{
    $posts = array();
    $posts[1] = $_POST['ucid'];
    $posts[2] = $_POST['password'];
    return $posts;
}


// Insert
if(isset($_POST['insert']))
{
    $data = getPosts();
    $data[2]= password_hash('$password', PASSWORD_DEFAULT);
    $insert_Query = "INSERT INTO `users`(`ucid`, `password`) VALUES ('$data[1]','$data[2]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);

        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Signin Succesful';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}


?>




<!DOCTYPE html>
<html>
<head>
	<title>Selectors</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/base-style.css">
  <link rel="stylesheet" href="css/selectors.css">
</head>
<body>



	<div id="container">
		<form class="form-contact br" >

		<hr>
 		<img class="avatar rounded"src="img/logo.png" alt="Mountains">

		<form class="form-login">
			<label for="username">UCID:</label>
			<input class=".btn"  type="text" id="username" placeholder="UCID">



			<label for="password">Password:</label>
			<input type="password" id="password" placeholder="Password">


			<input class="btn default" type="submit" value="Login">
      <a href="forgotPassword.html" target="_blank">Forgot your password?</a>
		</form>
	</div>
</body>
</html>
