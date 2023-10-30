<?php
session_start();
@include 'dbconn.php';
$errors = array();
if (isset($_POST['login'])) {
//$username = $_POST['uname'];
// $password = $_POST['pwd'];
$username = mysqli_real_escape_string($conn, $_POST['uname']);
$password = mysqli_real_escape_string($conn, $_POST['pwd']);
/* if (empty($username) || empty($password)) {
    echo "field is empty";
} else {
    echo $username;
}*/
    
//to prevent from mysqli injection
// $username = stripcslashes($username);
// $password = stripcslashes($password);

// $username = mysqli_real_escape_string($conn, $username);
// $password = mysqli_real_escape_string($conn, $password);


if (empty($username)) {
    array_push($errors, "Username is required");
}
if (empty($password)) {
    array_push($errors, "Password is required");
}

// Checking for the errors
if (count($errors) == 0) {
    
    // Password matching
    $password = md5($password);
    
    $query = "SELECT * FROM users 
    WHERE login_id = '$username' AND password='$password'";
    $results = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($results);
// $row = $result->fetch_assoc();

    // $results = 1 means that one user with the
    // entered username exists
    if (mysqli_num_rows($results) == 1) {
        //session_start();
        
        $_SESSION['login_id'] = $username; 
        $_SESSION['user_id'] = $userid; 
        if($username == "weneadmin"){
            header('location: admin_home.php');
        }else {
            if($userid == $row['user_id']){
                header('location: ts_yours.php');
            }else{
                echo " <script>alert('Incorrect Login');</script>  ";

            }
        }
    
    }
    else {
        
        // If the username and password doesn't match
        echo " <script>alert('Password {$password} or username {$username} is incorrect');</script>  ";
    }
}
/*if (mysqli_num_rows($result_set) === 1) {
    $row = mysqli_fetch_assoc($result_set);
    if (hash('md5', $_POST['pwd'])) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: home.php");
    }else{
        echo " <script>alert('Password {$password} is incorrect');</script>  ";
    }
}else{
    echo " <script>alert('No username found: {$username}');</script>  ";
}*/
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Timesheet</title>
<link rel="stylesheet" href="style.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <form action="#" method="post">
        <h1>Admin Login</h1>
        <?php if (isset($_GET['error'])) {?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php }?>
        <div class="input-box">
            <input type="text" name="uname" required>
            <i class='bx bxs-user' style="color:blueviolet"></i>
        </div>
        <div class="input-box">
            <input type="Password" name="pwd" required>
            <i class='bx bxs-lock' style="color:blueviolet"></i>
        </div>

        <button type="submit" class="btn" name="login">Login</button><br><br>

        <!--div class="container signin">
        <p>Need an account? <a href="register.php" style="color: white;">Sign Up</a></p-->
    </div>
    </form>
</div>


</body>
</html>

