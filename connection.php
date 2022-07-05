<?php 
 $servername="localhost";
 $username="root";
 $password="";
 $dbname="fisheddatabase";
 $conn=mysqli_connect($servername,$username,$password);
 if(!$conn)
 {
	 die("Connection Failed".mysql_error());
 }
 $DB=mysqli_select_db($conn,$dbname);
 if(!$DB)
 {
	 echo('Unable to connect with database');
	 die();
 }
	$new_link = $_POST['link']; 
	$sql = "INSERT INTO fisheddata (link)
	SELECT * FROM (SELECT '$new_link') AS tmp
	WHERE NOT EXISTS (
		SELECT link FROM fisheddata WHERE link = '$new_link'
	) LIMIT 1;";
mysqli_query($conn, $sql);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./main.css">
</head>
<body>
    
    <div class="fixed-header">
        <div class="container">
            <nav>
                <img src="images/FishThePhish.jpg" width="75" height="75" >
                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="reg.php">Login/Register</a>
                <a href="#">Services</a>
                <a href="#">Contact Us</a>
            </nav>
        </div>
    </div> 
    
	<p align="center" style="margin-top:250px ;"><b>Please wait... Your search is in progress..</b></p>
<div class="fixed-footer">
    
    <div class="container">Copyright &copy; 2022 FishThePhish</div>        
</div>
    
</body>
</html> 