<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'fisheddatabase');
if (isset($_POST['signbutton'])) {
    $name = $_POST['txtname'];
    $email = $_POST['txtemail'];
    $pass = $_POST['txtpass'];

    $select1 = "SELECT * FROM user WHERE UserName='$name'";
    $select2 = "SELECT * FROM user WHERE Email='$email'";

    $run1 = mysqli_query($conn, $select1);
    $run2 = mysqli_query($conn, $select2);

    if (mysqli_num_rows($run1) > 0) {
        echo "<script> alert ('This Username is already taken');</script>";
    } elseif (mysqli_num_rows($run2) > 0) {
        echo "<script> alert ('This Email is already taken');</script>";
    } else {
        $password_hash = md5($pass);
        $insert = "INSERT INTO `user`(`UserID`, `UserName`, `Email`,`Password`) 
        VALUES (NULL,'$name','$email','$password_hash')";
        $run = mysqli_query($conn, $insert);
        if ($run) {
            $select = "Select * from user where UserName='$name'";
            $run = mysqli_query($conn, $select);

            $count = mysqli_num_rows($run);
            if ($count > 0) {
                $data = mysqli_fetch_array($run);
                $UserID = $data[0];
                $_SESSION['UserID'] = $UserID;

                echo "<script>
                alert('Register Successful');
                window.location.assign('profile.php');
                </script>";
            }
        }
    }
}
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'fisheddatabase');
if (isset($_POST['loginbutton'])) {
    $name = $_POST['txtemail'];
    $pass = $_POST['txtpass'];
    $password_hash = md5($pass);
    $select = "Select * from user where Email='$name' and Password='$password_hash'";
    $run = mysqli_query($conn, $select);

    $count = mysqli_num_rows($run);
    if ($count > 0) {
        $data = mysqli_fetch_array($run);
        $UserID = $data[0];
        $_SESSION['UserID'] = $UserID;

        echo "<script>   
    		alert('Login Successful');
    		window.location.assign('profile.php');
    	</script>";
    } else {
        echo "<script>   
    		alert('Incorrect UserName or Password');
    	</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<br>
<br>
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
<style> 
button{
color: black;
}
</style>
<br>
<br>
<br>
<br>
<br>
<form method="POST" class="register-form1">
    <div class="cont">
        <div class="form sign-in">
            <h2>Welcome</h2>
            <label>
                <span>Email</span>
                <input type="email" name="txtemail" id="txtemail" />
            </label>
            <label>
                <span>Password</span>
                <input type="password" name="txtpass" id="txtpass" />
            </label>
            <p class="forgot-pass">Forgot password?</p>
            <button name="loginbutton" type="submit" class="submit">Sign In</button>
         
        </div>
        </form>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                 
                    <h3>Don't have an account? Please Sign up!<h3>
                </div>
                <div class="img__text m--in">
                
                    <h3>If you already has an account, just sign in.<h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>

            <form method="POST" class="register-form">
            <br>
<br>
                <h2>Create your Account</h2>
                <label>
                    <span>Name</span>
                    <input type="text" name="txtname" id="txtname"/>
                </label>
                <label>
                    <span>Email</span>
                    <input type="email"name="txtemail" id="txtemail"/>
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="txtpass" id="txtpass"/>
                </label>
                <label>
                    <span> Confirm Password</span>
                    <input type="password" name="txtpass" oninput="check(this)" />
                </label>
<label>
                <button name="signbutton" type="submit">Register</button>
</label>
            </div>
                </form>
        </div>
    </div>

    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });

    </script>

<script language='javascript' type='text/javascript'> 
    check = (input) => {
                if (input.value != document.getElementById('txtPass').value) {
                    input.setCustomValidity('Password Must be Matching.');
                } else {
                    input.setCustomValidity('');
                }
            }
            </script>
            <div class="fixed-footer">
    
    <div class="container">Copyright &copy; 2022 FishThePhish</div>        
</div>
</html>

