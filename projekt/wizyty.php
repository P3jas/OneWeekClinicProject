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
    <div class="zap"></div> 
    <div class="zawartosc3">
        <div class="tablea">
        <?php
             echo '
             <div class="szukidod">
             <a href = "dod_wizyte.php">
             <button type="submit" name="mpacjent" class="dodaj">
             +
             </button>
             </a>
                 
             <div style="clear:both;"></div>
             ';
                     $db = new mysqli ("localhost","root","","przychodnia");
                         if ($db)
                         {
                             $zap2 = "SELECT * FROM pacjenci";
                             $query2 = mysqli_query($db,$zap2);
                             while ($row2 = mysqli_fetch_array($query2))
                             {
                                 if ($row2['ID_uzytkownik'] == $_SESSION['ID_U'])
                                 {
                                    $idpac = $row2["ID_pacjent"];
                                 }
                             }
                             $zap = "SELECT * FROM wizyty";
                             $query = mysqli_query($db,$zap);
                             if (mysqli_num_rows($query) > 0)
                             {
                                 echo "<table>";
                                 echo "<thead>";
                                 echo "<tr>";
                                 echo "<td>Lekarz</td>";
                                 echo "<td>Gabinet</td>";
                                 echo "<td>Data</td>";
                                 echo "<td>godzina</td>";
                                 echo "<td style='color:#121212;'>Usun</td>";
                                 echo "</tr>";
                                 echo "</thead>";
                             }
                             echo "<tbody>";
                             while ($row = mysqli_fetch_array($query))
                             {
                                 if ($row['ID_pacjent'] == $idpac)
                                 {

                                    echo "<tr>";
                                    $zap2 = "SELECT * FROM lekarze";
                                    $query2 = mysqli_query($db,$zap2);
                                    while ($row2 = mysqli_fetch_array($query2))
                                    {
                                        if ($row2['ID_lekarz'] == $row['ID_lekarz'])
                                        {
                                            echo "<td>". $row2['Imię'] . " " . $row2['Nazwisko'] . "</td>";
                                        }
                                    }
                                    $zap2 = "SELECT * FROM gabinet";
                                    $query2 = mysqli_query($db,$zap2);
                                    while ($row2 = mysqli_fetch_array($query2))
                                    {
                                        if ($row2['ID_gabinet'] == $row['ID_gabinet'])
                                        {
                                            echo "<td>". $row2['Nr_gabinetu'] . "</td>";
                                        }
                                    }

                                    echo "<td>". $row['Data'] . "</td>";
                                    echo "<td>". $row['Godzina'] . "</td>";
                                    echo "<td>".'<form method="POST">
                                        <button type="submit" name="uwizyty" class="x">
                                        <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                        <img src="bin.png" alt="bin">
                                        </button></form>'. "</td>";
                                    echo "</tr>";
                                }
     
                             }
                             echo "</tbody>";
                             echo "</table>";
                         }
                         else
                         {   
                         echo "Cos poszlo nie tak prosze podac numer karty kredytowej";
                         echo "Blad polaczenia z baza danych ";
                         }
                     $db->close();

                     // ##################################### wyszukiwanie
                 
                     if(isset($_POST['uwizyty']))
                     {
                         $id = $_POST['id'];
 
                         $db = new mysqli("localhost","root","","przychodnia");
                         if($db)
                         {
                             $zap1 = "SELECT * FROM wizyty";
                             $query2 = mysqli_query($db,$zap1);
                             while ($row = mysqli_fetch_array($query2))
                             {
                                 if($row['ID_wizyta'] == $id)
                                 {
                                     $zap = "DELETE FROM wizyty WHERE ID_wizyta ='$id'";
                                     $query = mysqli_query($db,$zap); 
                                     header("Refresh:0");
                                         }
                             } 
                         }   
                         else
                         {
                             echo "<h6>blad polaczenia z baza danych</h6>";
                         }
                         $db -> close();
                     }




        ?>



        
        </div>
    </div>
</body>
</html>