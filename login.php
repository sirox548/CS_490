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
	<title>

	</title>
</head>
<body>
	<div >
		<form action="login.php" method="post">
			<input type="varchar" name="ucid" placeholder="Enter your UCID"><br><br>
			<input type="password" name="password" placeholder="Enter your password"><br><br>

			<input type="submit" name="insert" value="submit">

		</form>
	</div>

</body>
</html>