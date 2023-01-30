<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EMS ATOMIC</title>
    <link href="style2.css" rel="stylesheet" />
  </head>
  <body>
    <div class="box">
        <div class="container">
            <div class="top">
            <img src="exkr.png" alt="Girl in a jacket" class="img1">
                <header>Registration</header>
            </div>
            <?php 
          if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            
            
            $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
 
            $errors = array();
            
            if (empty($fullName) OR empty($password) OR empty($passwordRepeat)) {
             array_push($errors,"Puste pola");
            } else 
            if (strlen($password)<5) {
             array_push($errors,"Hasło musi mieć co najemniej 5 znaków");
            }
            if ($password!==$passwordRepeat) {
             array_push($errors,"Hasła się nie zgadzają");
            }
            require_once "database.php";
           $sql = "SELECT * FROM user WHERE name = '$fullName'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Login jest już zajęty.");
           }
            if (count($errors)>0) {
             foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
             }
         }else{
            require_once "database.php";
            $sql="INSERT INTO user (name, password_hash) VALUES(?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt, "ss", $fullName, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>
                Zostałeś pomyślnie zarejestrowany.</div>";
            }else{
                die("coś poszło nie tak kolego");
            }
        }
            
         }
                ?>
     <form action="registration.php" method="post">
            <div class="input-field ">
                <input type="text" class="input" name="fullname" placeholder="Imie i nazwisko:">
            </div>
            <div class="input-field ">
                <input type="password" class="input" name="password" placeholder="Hasło:">
            </div>
            <div class="input-field ">
                <input type="password" class="input" name="repeat_password" placeholder="Powtórz hasło:">
            </div>
            <div class="form-btn">
                <input type="submit" class="submit" value="Register" name="submit">
            </div>
        </form>
        <div class="two-col">
                <div class="one">
                   <input type="checkbox" name="" id="check">
                   <label for="check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="login.php">Cofnij do logowania</a></label>
                </div>
        </div>
    </div>
</div>  
    <script src="snieg.js"></script>
  </body>
</html>