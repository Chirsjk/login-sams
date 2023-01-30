<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="stylee.css"/>
    <title>User Dashboard</title>
</head>
<body>
<div class="nazwalogo">
     <?php
 if (empty($_SESSION['user'])) : ?>
    <form action="login.php" method="post">
<?php //Next, after the form, close the if and write an else clause: ?>
</form>
    <?php else : ?>
        <p>Witaj! <?=$_SESSION['user']?><box-icon name='user' class="icon"></box-icon></p>
    <?php endif; 
    ?>
</div>
    <header><h2>Formularz SAMS</h2></header>
    <div class="container">
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
    <main>
    <div class="godzinypracy">

                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold" style="width: 253.328px;">Godziny pracy</p></div>
                                                                <div class="card-body" >
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="city"><strong>Data</strong></label>
                                                <input type="date" class="form-control" value="" name="data">
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="city"><strong>Imie nazwisko IC</strong></label>
                                                <input type="text" class="form-control" name="imie">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="country"><strong>Rozpączęcie służby(godziny:minuty:sekundy) np: 1godzina(01):21minut(21):4sekundy(04)</strong></label>
                                            <input value="00:00:00" class="form-control html-duration-picker" name="rs">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="country"><strong>Koniec służby(godziny:minuty:sekundy)</strong></label>
                                            <input value="00:00:00" class="form-control html-duration-picker" name="zs">
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="country"><strong>Ilość godzin na służbie(godziny:minuty:sekundy)</strong></label>
                                            <input value="00:00:00" class="form-control html-duration-picker" name="godz">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm" name="wystaw" type="submit">Wystaw</button></div>
                                <?php
        if (isset($_POST["wystaw"])) {
           $nazwisko = $_POST["imie"];
           $date = $_POST["data"];
           $godzina = $_POST["godz"];
           $rs = $_POST["rs"];
           $zs = $_POST["zs"];

           if (empty($nazwisko)OR empty($date)OR empty($godzina)OR empty($rs)OR empty($zs)) {
            echo "
            <tr>
                    <td>Imie nazwisko IC</td><br>
                    <td>Data:</td><br>
                    <td>Rozpączęcie służby: </td><br>
                    <td>Koniec służby: </td><br>
                    <td>Ilość godzin na służbie:</td><br>
                </tr>";

        } else {
            require_once "database.php";
            $sql = "INSERT INTO `hw` (`imie-nazwisko`,`date`,`rozpaczecie-sluzby`,`zakonczenie-sluzby`,`godziny`) VALUES ('$nazwisko','$date','$rs','$zs','$godzina');";
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                echo "Wpis godziny " . $last_id; 
            $q = "SELECT * FROM hw ORDER BY date ASC;";
            if (mysqli_query($conn, $q)) {
            $row = array("$nazwisko", "$date", "$rs", "$zs", "$godzina"); 
             echo "
             <tr><br>
                     <td>Imie nazwisko IC $row[0]</td><br>
                     <td>Data: $row[1]</td><br>
                     <td>Rozpączęcie służby: $row[2]</td><br>
                     <td>Koniec służby: $row[3]</td><br>
                     <td>Ilość godzin na służbie: $row[4]</td><br>
                 </tr>";
            }
         }
            }
        }
        require_once "database.php";
        $sql = "DELETE FROM hw WHERE id =;";
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql = "DELETE FROM hw WHERE id = $last_id;";
            echo "id" . $sql;

        }
            
        ?>
                            </form>
                        </div>
                    </div>
                        </div>
<div class="informacje">
    <div class="m1"><h3>kody radiowe</h3><br>
<p><b>I. Statusy służbowe.</b><br>

<b>Status 1</b> - Rozpoczęcie służby<br>

<b>Status 2</b> - Przerwa podczas służby (do 20 min)<br>

<b>Status 3</b> - Zakończenie służby<br>

<b>Status 4</b> - Powrót po przerwie<br>

<b>Status 5</b> - Rozpoczęcie patrolu<br>

<b>Status 6</b> - Czynności służbowe na wezwaniu<br>

<b>Status 7</b> - Czynności służbowe na szpitalu.<br>


<b>II. Kody radiowe.</b><br>

10-0 > Pytanie o wasz status<br>
10-1 > Do wszystkich jednostek<br>
10-3 > Odmawiam<br>
10-4 > Zrozumiałem/ przyjąłem<br>
10-5 > W drodze (na dane miejsce/wezwanie)<br>
10-6 > Cisza na radiu<br>
10-7 > Wezwanie<br>
10-9 > Powtórz komunikat<br>
10-12 > Czysto na miejscu <br>
10-13 > Ranny Funkcjonariusz<br>
10-20 > Lokalizacja<br>
10-22 > Potrzebny pojazd <br>
10-23 > Dojechałem na miejsce<br>
10-40 > PWC dla<br>
10-41 > APWC dla<br>
10-50 > Wypadek/ kolizja<br>
10-61 > Prośba o autoryzacje <br>
10-75 > Interwencja własna<br>
10-71 > Wezwanie od obywatela<br>
10-78 > Potrzebne wsparcie <br>

Code 0 - Zagrożenie życia funkcjonariusza SAMS<br>
Code 5 - Zakończenie czynności<br>
Code 6 - Spotkanie wszystkich jednostek<br>
Code 7 - Czynności na szpitalu <br>
ㅤ
Częstotliwość #7 - Główne radio SAMS.<br>

Częstotliwość #8 - Przeznaczona do akcji dynamicznych bądź rożnego rodzaju szkoleń.<br>

Wszelkie zakłócanie podawanych ważnych i priorytetowych informacji będzie karane.</p>
</div>

       

</body>
</html>