<?php
    session_start();
    if (empty($_SESSION['zalogowany']))
    {
        $_SESSION['zalogowany'] = 0;
    }
    if ($_SESSION['zalogowany'] < 1 && $_SESSION['zalogowany'] > 2)
    {
         header("Location: Logowanie.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przychodnia</title>
    <link rel="icon" href="logo.png" type="image/icon type">
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <nav class="menu">
        <a href="glowna.php">
            <h3 id="logo">{medic center +}</h3>
        </a>
        <div class="navbar">
            <div class="inline">
                <a href="lekarze.php">
                    <ul>
                        <li class="przod">Lekarze</li>
                        <li class="tyl">Lekarze</li>
                    </ul>
                </a>
            </div>       
            <div class="inline">
               <a href="kontakt.php">
                    <ul>
                        <li class="przod">kontakt</li>
                        <li class="tyl">kontakt</li>
                    </ul>
                </a>
            </div>
            <?php
            if (empty($_SESSION['zalogowany']))
            {
                $_SESSION['zalogowany'] = 0;
            }
            if ($_SESSION['zalogowany'] ==1)
            {
                echo '   
            <div class="inline">
                <a href="zarzadzaj.php">
                     <ul>
                         <li class="przod">Mod</li>
                         <li class="tyl">MOd</li>
                     </ul>
                 </a>
             </div>  ';
            }
            if ($_SESSION['zalogowany'] >= 1 && $_SESSION['zalogowany'] <= 2)
            {
                echo '   
            <div class="inline">
                <a href="wizyty.php">
                     <ul>
                         <li class="przod">wizyty</li>
                         <li class="tyl">wizyty</li>
                     </ul>
                 </a>
             </div>  
            <div class="inline">
                <a href="#">
                     <ul>
                         <li class="przod">dane</li>
                         <li class="tyl">dane</li>
                     </ul>
                 </a>
             </div>        
            <div class="inline">
                <a href="wyloguj.php">
                     <ul>
                         <li class="przod">wyloguj</li>
                         <li class="tyl">wyloguj</li>
                     </ul>
                 </a>
             </div>';                
            }
            else
            {
                echo '            <div class="inline">
                <a href="logowanie.php">
                     <ul>
                         <li class="przod">zaloguj</li>
                         <li class="tyl">zaloguj</li>
                     </ul>
                 </a>
             </div>';
            }

            ?>
        </div>
    </nav>
    <div class="tlot"></div>
    <div class="tlot2"></div>
    <div class="tlo"></div>
    <div class="zawartosc2">
    <?php

$db = new mysqli ("localhost","root","","Przychodnia");
if($db)
{
    
    $zap = "SELECT * FROM pacjenci";
    $query = mysqli_query($db,$zap);
    while ($row2 = mysqli_fetch_array($query))
    {
        if ($row2['ID_uzytkownik'] == $_SESSION['ID_U'])
        {
            echo "<h4>Imie</h4>";
            echo "<p>";
            echo $row2['Imię'];
            echo "</p>";
            echo "<h4>Nazwisko</h4>";
            echo "<p>";
            echo $row2['Nazwisko'];
            echo "</p>";
            echo "<h4>PESEL</h4>";
            echo "<p>";
            echo $row2['PESEL'];
            echo "</p>";
            echo "<h4>Telefon</h4>";
            echo "<p>";
            echo $row2['Telefon'];
            echo "</p>";
        }
    }
    $zap = "SELECT * FROM uzytkownik";
    $query = mysqli_query($db,$zap);
    while ($row2 = mysqli_fetch_array($query))
    {
        if ($row2['ID_uzytkownik'] == $_SESSION['ID_U'])
        {
            echo "<h4>Login</h4>";
            echo "<p>";
            echo $row2['Login'];
            echo "</p>";
            echo "<h4>Email</h4>";
            echo "<p>";
            echo $row2['Email'];
            echo "</p>";
        }
    }
    echo '
    <a href = "modyfikacja_dane.php">
    <button type="submit" name="mpacjent" class="modifyb">
        <img src="pen.png" alt="pen">
    </button>
    </a>';

}
else
{
    echo"Blad polczenia z baza danych";
}
$db->close();

?>


    </div>
</body>
</html>