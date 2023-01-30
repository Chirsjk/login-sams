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
    <script src="snieg.js" defer></script>
  </head>
  <body>
    <div class="box">
        <div class="container">
            <div class="top">
            <img src="exkr.png" alt="Girl in a jacket" class="img1">
                <span>Masz już konto?</span>
                <header>Login</header>
            </div>
            <?php
        if (isset($_POST["login"])) {
           $fullName = $_POST["fullname"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM user WHERE name = '$fullName'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if(password_verify($_POST['password'], $user['password_hash'])){
                    session_start();
                    $_SESSION["user"] = "$fullName";
                    header("Location: index.php");
                    die();
                }
                }else{
                    echo "<div class='alert alert-danger'>Login lub hasło niepoprawne</div>";
                }
            }
    
        ?>
     <form action="login.php" method="post">
            <div class="input-field ">
                <input type="text" class="input" name="fullname" placeholder="Imie i nazwisko:">
            </div>
            <div class="input-field ">
                <input type="password" class="input" name="password" placeholder="Hasło:">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="submit">
            </div>
        </form>
        <div class="two-col">
                <div class="one">
                   <input type="checkbox" name="" id="check">
                   <label for="check">Zapamiętaj mnie</label>
                </div>
                <div class="two">
                    <label><a href="registration.php">Zarejestru się</a></label>
                </div>
        </div>
    </div>
</div>  
  </body>
</html>