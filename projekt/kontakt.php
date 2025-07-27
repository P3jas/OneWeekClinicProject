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
    <div class="tlot"></div>
    <div class="tlot2"></div>
    <div class="tlo"></div>
    <div class="zawartosc2">
        <h1>kontakt</h1>
        <p>tel: +48 000 000 000</p>
        <p>lub</p>
        <p>tel: +48 111 222 333</p>
        <p>Email: medic_center@gmail.com</p>
        <h3>Otwarte:</h3>
        <p>pn-pt: 9:00-21:00</p>
        <p>sb: 10:00-19:00</p>
        <p>nd: nieczynne</p>
        
    </div>
    
</body>
</html>