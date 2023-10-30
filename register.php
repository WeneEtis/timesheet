<?php
@include 'dbconn.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = test_input($_POST['uname']);
        $user_id = test_input($_POST['eid']);
        $password = test_input($_POST['pwd']);

       // $sql = "select *from users where login_id = '$username' and password = '$password'";
        $hash = md5($password);
        $sql = "INSERT INTO `users` (`user_id`, `login_id`, `password`, `created`, `modified`) 
        VALUES ('$user_id ', '$username', '$hash', current_timestamp(), current_timestamp())";

        $result = mysqli_query($conn, $sql);
        session_start();
        $_SESSION['login_id'] = $username;
        $_SESSION['user_id'] = $user_id;
        // Welcome message
        $_SESSION['success'] = "You have logged in";
        header("Location: emp_signin.php");
        
    }
    function test_input($data) {  
        $data = trim($data);  
        $data = stripslashes($data);  
        $data = htmlspecialchars($data);  
        return $data;  
    }  
  /*  if ($_SERVER["REQUEST_METHOD"] == "POST") { 

      $username = test_input($_POST["uname"]);
      $pwd = test_input($_POST["pwd"]);


      $sql = "INSERT INTO `users` (`login_id`, `password`) 
      VALUES ($username, MD5($pwd))";
      //$sql = "select *from users where login_id = '$username' and password = '$password'";
      $result = mysqli_query($conn, $sql);
     // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      if($count == 1){
          header("Location: home.php");
      }
      else{
          header("Location: index.php?error=Incorrect Username or Password");
          exit();
         // echo "<h1> Login failed. Invalid username or password.</h1>";
      }
    }*/
//printf('Connected successfully.<br />');
//$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        
    </style>
</head>
<body>
   <div class="wrapper">
        <form action="" method="post">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>

            <hr>
            <div class="input-box">
                <input type="text" placeholder="Enter username" name="uname"  required>
                <i class='bx bxs-user' style="color: blueviolet;"></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Enter emp ID" name="eid"  required>
                <i class='bx bxs-user' style="color: blueviolet;"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Enter Password" name="pwd" required>
                <i class='bx bxs-lock' style="color:blueviolet"></i>
            </div>

            <button type="submit" class="btn">Register</button>

        </div>
        <br>
        <div class="container signin">
            <p>Already have an account? <a href="index.php" style="color: white;">Sign in</a>.</p>
        </div>
        </form>
   </div>
   
   
</body>
</html>

