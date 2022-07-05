<?php
    
	
	require_once "connection.php";
    global $conn;
	
	$F=$_POST["link"];
	
	$sq="Select * from fisheddata where link=$F";
	if(!empty($sq)){
	$Table=mysqli_query($conn,$sq);
	$Row=mysqli_fetch_array($Table);
	
	echo $Row["link"];
	}
	else{
		$INSERT = "INSERT Into fisheddata (link) values (?)";
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("s",$F);
		$stmt->execute();
		echo "inserted";
	}
 ?>
 