<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'fisheddatabase');
if (isset($_SESSION['UserID'])) {
    $user = $_SESSION['UserID'];
    $select = "Select * from user where UserID= '$user'";
    $run = mysqli_query($conn, $select);
    $data = mysqli_fetch_array($run);
    $UserName = $data['1'];
    $Email = $data['2'];
    $Phone = $data['3'];
}

if (isset($_POST['btnUpdate'])) {
    $name = $_POST['txtName'];
    $email = $_POST['txtMail'];
    $tel = $_POST['txtTel'];
    if (!empty($_POST['txtCurrentPass'])) {
        $currentPass = $_POST['txtCurrentPass'];
        $currentHash = md5($currentPass);

        $newPass = $_POST['txtNewPass'];
        $newHash = md5($newPass);

        $select = "SELECT * FROM user where Password='$currentHash'";
        $run = mysqli_query($conn, $select);
        $count = mysqli_num_rows($run);

        if ($count > 0) {
            if (trim($newPass) == "") {
                echo "<script>
                alert('Please Add New Password');
                </script>";
            } else {
                $update = "UPDATE `user` SET `UserName`='$name',`Email`='$email',`PhoneNumber`='$tel',`Password`='$newHash' 
                WHERE UserID= '$user'";
                $run = mysqli_query($conn, $update);
                echo "<script>
                    alert('Update Successful');
                    window.location.assign('profile.php');
                </script>";
            }
        } else {
            echo "<script>
		alert('Current Password Does Not Match');
		window.location.assign('profile.php');
		</script>";
        }
    } else {

        $update = "UPDATE `user` SET `UserName`='$name',`Email`='$email',`PhoneNumber`='$tel' 
            WHERE UserID= '$user'";
        $run = mysqli_query($conn, $update);
        echo "<script>
                 alert('Update Successful');
                 window.location.assign('profile.php');
             </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./regcs.css">
<link rel="stylesheet" href="./main.css">
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
    <title>Profile</title>
</head>

<body>
    <div class="container">

        <div class="profile-container">
            <div class="p-head-wrap">
                <h2 class="profile-header">User Profile</h2>
                <button onclick="logConfirm()" class="logout-btn">Logout</button>
            </div>

            <form method="POST" class="edit-profile" id="form">
                <div class="inputs">
                    <label for="txtName">User Name</label> <br>
                    <input type="text" id="txtName" name="txtName" value="<?php echo $UserName; ?>" required>
                </div>

                <div class="inputs">
                    <label for="txtMail">Email</label> <br>
                    <input type="email" id="txtMail" name="txtMail" value="<?php echo $Email; ?>" required>
                </div>

                <div class="inputs">
                    <label for="txtTel">Phone Number</label> <br>
                    <input type="tel" id="txtTel" name="txtTel" value="<?php echo $Phone; ?>" required>
                </div>

                <div class="inputs">
                    <label for="txtPass">Current Password</label> <br>
                    <input type="password" name="txtCurrentPass" id="txtPass">
                </div>

                <div class="inputs">
                    <label for="txtCon">New Password</label> <br>
                    <input type="password" name="txtNewPass" id="newPass">
                    <p>Ignore password fields if you don't want to change.</p>
                </div>

                <button name="btnUpdate" type="submit" id="updateBtn">Update</button>
            </form>
        </div>
    </div>

    <script>
        logConfirm = () => {
            if (confirm("Are you sure you want to logout?")) {
                window.location.assign("logout.php");
            } else {
                return;
            }
        };
    </script>
</body>

</html>