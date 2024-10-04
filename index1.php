<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
     <div class="container"></div>
      <div class="box form-box">
        <?php 
          
          include("config.php");
          if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($conn,$_POST['password']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);

            $result = mysqli_query($conn,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
            $row = mysqli_fetch_assoc($result);

            if(is_array($row) && !empty($row)){
              $_SESSION['valid'] = $row ['Email'];
              $_SESSION['username'] = $row ['Username'];
              $_SESSION['age'] = $row ['Age'];
              $_SESSION['id'] = $row ['Id'];
            }else{
              echo "<div class='message'>
                    <p>Wrong Username or Password</p>
                    </div> <br>";
              echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
            }
            if(isset($_SESSION['valid'])){
              header("Location: index.php");
            }
          }else{

        ?>  
        <header>Login</header>
        <form action="" method="post">
          <div class="field input">
            <label for="email">email</label>
            <input type="text" name="email" id="email" required>
          </div>

          <div class="field input">
            <label for="password">password</label>
            <input type="password" name="password" id="password" required>
          </div>

          <div class="field">
            <input type="submit" class="btn" name="submit" value="Login" required>
          </div>

          <div class="links">
            Don't have acount? <a href="register.php">Sign Up Now</a>
            </div>

        </form>
        <?php } ?>
      </div>
</body>
</html>