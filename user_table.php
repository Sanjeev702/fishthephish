<?php
$connect = mysqli_connect('localhost', 'root', '', 'fisheddatabase');
$createUser = "CREATE TABLE User
(
    UserID int Auto_Increment not null primary key,
    UserName Varchar(50),
    Email Varchar(60),
    PhoneNumber Varchar(30),
    Password Varchar(60)
)";

$run = mysqli_query($connect, $createUser);
if ($run) {
    echo "User Table Created <br>";
} else {
    mysqli_error($connect);
}
?>