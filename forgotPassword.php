<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cs490";



	$ucid = "";
	$email = "";
	$pwd1 = "";
	$pwd2 = "";

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
	    $posts[0] = $_POST['ucid'];
	    $posts[1] = $_POST['email'];
	    $posts[2] = $_POST['pwd1'];
	    $posts[3] = $_POST['pwd2'];
	    return $posts;
	}


	// Insert
	if(isset($_POST['insert']))
	{
	    $data = getPosts();
	    $data[2]= password_hash('$pwd1', PASSWORD_DEFAULT);
	    $data[3]= password_hash('$pwd2', PASSWORD_DEFAULT);
	    $insert_Query = "INSERT INTO `forgotpassword`(`ucid`, `email`, `pwd1`, `pwd2`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
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
		<form class="form-contact br"  action="forgotPassword.php" method="post">
	  	 <h1>Create New Password</h1>



		  <label for="name">UCID:</label>
		  <input type="text" name="ucid" id="ucid">

     	<label for="email">Email:</label>
     	<input type="email" name="email" id="email" placeholder="email@njit.edu">

      <label for="name" >New password:</label>
		  <input type="password" name="pwd1" id="name" placeholder="Password">

      <label for="name">Confirm new password:</label>
		  <input type="password" name="pwd2" id="name" placeholder="Password">

		  <input class="btn inln default" type="submit" name="insert" value="Submit">
 		  <input  class="btn  inln error" type="reset" value="Reset">
		</form>
		</form>
	</div>
</body>
</html>
