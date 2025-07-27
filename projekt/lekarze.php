<?php
    session_start();
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
                <a href="#">
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
                <a href="moje_dane.php">
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
    <div class="zawartosc2">
        <?php

            $db = new mysqli ("localhost","root","","Przychodnia");
            if($db)
            {
                $zap = "SELECT * FROM lekarze";
                $query = mysqli_query($db,$zap);
                if (mysqli_num_rows($query) > 0)
                {
                    echo "<h2>";
                    echo "Chirurdzy";
                    echo "</h2>";
                }   
                while ($row = mysqli_fetch_array($query))
                {
                    if ($row['Tytul'] == "Chirurg")
                    {
                        echo "<p>";
                        echo $row['Imię'];
                        echo $row['Nazwisko'];
                        echo $row['Telefon'];
                        echo "</p>";
                                    }
                }
                $query = mysqli_query($db,$zap);
                if (mysqli_num_rows($query) > 0)
                {
                    echo "<h2>";
                    echo "Okulisci";
                    echo "</h2>";
                }   
                while ($row = mysqli_fetch_array($query))
                {
                    if ($row['Tytul'] == "Okulista")
                    {
                        echo "<p>";
                        echo $row['Imię'];
                        echo $row['Nazwisko'];
                        echo $row['Telefon'];
                        echo "</p>";
                                    }
                }
                $query = mysqli_query($db,$zap);
                if (mysqli_num_rows($query) > 0)
                {
                    echo "<h2>";
                    echo "Neurolodzy";
                    echo "</h2>";
                }   
                while ($row = mysqli_fetch_array($query))
                {
                    if ($row['Tytul'] == "Neurolog")
                    {
                        echo "<p>";
                        echo $row['Imię'];
                        echo $row['Nazwisko'];
                        echo $row['Telefon'];
                        echo "</p>";
                                    }
                }
                $query = mysqli_query($db,$zap);
                if (mysqli_num_rows($query) > 0)
                {
                    echo "<h2>";
                    echo "Ginekolodzy";
                    echo "</h2>";
                }   
                while ($row = mysqli_fetch_array($query))
                {
                    if ($row['Tytul'] == "Ginekolog")
                    {
                        echo "<p>";
                        echo $row['Imię'];
                        echo $row['Nazwisko'];
                        echo $row['Telefon'];
                        echo "</p>";
                                    }
                }
                            
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