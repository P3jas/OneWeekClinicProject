<?php
    session_start();
    if ($_SESSION['zalogowany'] != 1)
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
    <div class="lewy">
        <div class="bloczek"></div>    
            <form id="lewy"method="POST">
                <h5>Wybierz tabele ktora chcesz zarzadzac</h5>
                <input type="submit" name="lekarze" value="lekarze"><br>
                <input type="submit" name="wizyty" value="wizyty"><br>
                <input type="submit" name="pacjenci" value="pacjenci"><br>
                <input type="submit" name="gabinety" value="gabinety"><br>
            </form>
        
    </div>
    <div class="zawartosc3">
        <div class="tablea">

                <?php

                // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!LEKARZE

                    if(isset($_POST['lekarze']))
                    {
                        echo '
                <div class="szukidod">
                <form method="POST">
                    <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajL"></div>
                    <input class="dodaj" name="dodajL" type="submit" value="+">
                </form>
                <div style="clear:both;"></div>
                ';
                        $db = new mysqli ("localhost","root","","przychodnia");
                            if ($db)
                            {
                                $zap = "SELECT * FROM lekarze";
                                $query = mysqli_query($db,$zap);
                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Lekarza</td>";
                                    echo "<td>Imie</td>";
                                    echo "<td>Nazwisko</td>";
                                    echo "<td>PESEL</td>";
                                    echo "<td>Telefon</td>";
                                    echo "<td>Tytul</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($query))
                                {
    
                                    echo "<tr>";
                                    echo "<td>". $row['ID_lekarz'] . "</td>";
                                    echo "<td>". $row['Imię'] . "</td>";
                                    echo "<td>". $row['Nazwisko'] . "</td>";
                                    echo "<td>". $row['PESEL'] . "</td>";
                                    echo "<td>". $row['Telefon'] . "</td>";
                                    echo "<td>". $row['Tytul'] . "</td>";
                                    echo "<td>".'<form method="POST">
                                        <button type="submit" name="mlekarz" class="modifyb">
                                            <input type="hidden" name="id" value='. $row['ID_lekarz'] .'>
                                            <img src="pen.png" alt="pen">
                                        </button>
                                        <button type="submit" name="ulekarz" class="x">
                                        <input type="hidden" name="id" value='. $row['ID_lekarz'] .'>
                                        <img src="bin.png" alt="bin">
                                        </button></form>'. "</td>";
                                    echo "</tr>";
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
                    }

                    // ############################################################SZUKANIE LEKARZE
                    if(isset($_POST['szukajL']))
                    {
                        echo '
                        <div class="szukidod">
                        <form method="POST">
                            <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajL"></div>
                            <input class="dodaj" name="dodajL" type="submit" value="+">
                        </form>
                        <div style="clear:both;"></div>
                        ';
                        $szukane = $_POST['szukaj'];
                        $i = 0;
                        $db = new mysqli ("localhost","root","","przychodnia");
                        if($db)
                        {
                            $zap = "SELECT * FROM lekarze";
                                $query = mysqli_query($db,$zap);
                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Lekarza</td>";
                                    echo "<td>Imie</td>";
                                    echo "<td>Nazwisko</td>";
                                    echo "<td>PESEL</td>";
                                    echo "<td>Telefon</td>";
                                    echo "<td>Tytul</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                    while ($row = mysqli_fetch_array($query))
                                    {
                                        if ($row['ID_lekarz'] == $szukane or $row['Imię'] == $szukane or $row['Nazwisko'] == $szukane)
                                        {
                                        $i+=1;
                                        echo "<tr>";
                                        echo "<td>". $row['ID_lekarz'] . "</td>";
                                        echo "<td>". $row['Imię'] . "</td>";
                                        echo "<td>". $row['Nazwisko'] . "</td>";
                                        echo "<td>". $row['PESEL'] . "</td>";
                                        echo "<td>". $row['Telefon'] . "</td>";
                                        echo "<td>". $row['Tytul'] . "</td>";
                                        echo "<td>".'<button class="modifyb"><img src="pen.png"alt="pen"></button><button class="x"><img src="bin.png" alt="bin"></button>'. "</td>";
                                        echo "</tr>";
                                        }
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    if ($i==0)
                                    {
                                        echo "BRAK WYNIKOW";
                                    }
                                
    
                        }
                        else
                        {
                            echo"Blad polczenia z baza danych";
                        }
                        $db->close();
                    }
                    // ############################################################DODAWANIELEKARZE
                    if(isset($_POST['dodajL']))
                    {
                        echo '
                        <div class="form">
                        <form method="POST">
        
                        <input placeholder="Imie" type="text" style="text-transform: capitalize;" name="imie" maxlength="50" required><br>
                        <input placeholder="Nazwisko" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50" required><br>
                        <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
                        <input placeholder="Telefon" type="number" name="tel"><br>
                        <input type="text" placeholder="Tytul" required name="tytul"><br>
                        <input type="submit" value="+" name="dl">
                        </form>
                        </div>
                        ';
                    }
                    if (isset($_POST['dl']))
                    {
                        $imie = ucfirst($_POST['imie']);
                        $nazwisko = ucfirst($_POST['nazwisko']);
                        $pesel = $_POST['pesel'];    
                        $tel = $_POST['tel'];
                        $tytul = $_POST['tytul'];


                        $db = new mysqli("localhost","root","","przychodnia");
                        
                        if($db)
                        {
                            $zap = "INSERT INTO lekarze VALUE(null,'$imie','$nazwisko','$pesel','$tel','$tytul')";
                            $query = mysqli_query($db,$zap);
                            

                            if($query)
                            {
                                echo '
                                <div class="form">
                                <form method="POST">
                
                                <input placeholder="Imie" type="text" style="text-transform: capitalize;" name="imie" maxlength="50" required><br>
                                <input placeholder="Nazwisko" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50" required><br>
                                <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
                                <input placeholder="Telefon" type="number" name="tel"><br>
                                <input type="text" placeholder="Tytul" required name="tytul"><br>
                                <input type="submit" value="+" name="dl">
                                </form>
                                </div>
                                ';
                                echo "<h6>dodales pracownika</h6>";
                            }
                            else
                            {
                                echo '
                                <div class="form">
                                <form method="POST">
                
                                <input placeholder="Imie" type="text" style="text-transform: capitalize;" name="imie" maxlength="50" required><br>
                                <input placeholder="Nazwisko" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50" required><br>
                                <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
                                <input placeholder="Telefon" type="number" name="tel"><br>
                                <input type="text" placeholder="Tytul" required name="tytul"><br>
                                <input type="submit" value="+" name="dl">
                                </form>
                                </div>
                                ';
                                echo "<h6>wystapil blad podczas dodawania</h6> ";
                            }
                        }
                        else
                        {
                            echo"blad polaczenia z baza danych";
                        }
                        $db->close();
                    }
                    // ############################################################MODYFIKACJA LEKARZE
                    if(isset($_POST['mlekarz']))
                    {
                        $id = $_POST['id'];
                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {   
                            $zap1 = "SELECT * FROM lekarze";
                            $query2 = mysqli_query($db,$zap1);
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_lekarz'] == $id)
                                {
                                    echo '
                                    <div class="form">
                                    <form method="POST">
                                    <input type="hidden" name = "id" value = "'. $row['ID_lekarz'].'">
                                    <input placeholder="'. $row['Imię'] . '" type="text" style="text-transform: capitalize;" name="imie" maxlength="50"><br>
                                    <input placeholder="'. $row['Nazwisko'] . '" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50"><br>
                                    <input placeholder="'. $row['PESEL'] . '" type="text" name="pesel" maxlength="11" pattern="[0-9]+"><br>
                                    <input placeholder="'. $row['Telefon'] . '" type="number" name="tel"><br>
                                    <input type="text" placeholder="'. $row['Tytul'] . '" name="tytul"><br>
                                    <input type="submit" value="modyfikuj" name="ml">
                                    </form>
                                    </div>
                                    ';
                                }
                            }
                        }
                    }
                    if(isset($_POST['ml']))
                    {
                        $idm = $_POST['id'];
                        $i = 0;
            
                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {  
                            $zap1 = "SELECT * FROM lekarze";
                            $query2 = mysqli_query($db,$zap1);
            
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_lekarz'] == $idm)
                                {
                                    if (!empty($_POST['imie']))
                                    {
                                        $nazwam = $_POST['imie'];  
                                    }
                                    else
                                    {
                                        $nazwam = $row['Imię'];
                                    }
                                    if (!empty($_POST['nazwisko']))
                                    {
                                        $nazwisko = $_POST['nazwisko'];
                                    }
                                    else
                                    {
                                        $nazwisko = $row['Nazwisko'];
            
                                    }
                                    if(!empty($_POST['pesel']))
                                    {
                                        $pesel = $_POST['pesel'];
                                    }
                                    else
                                    {
                                        $pesel = $row['PESEL'];
                                    }
                                    if(!empty($_POST['tel']))
                                    {
                                        $tel= $_POST['tel'];
                                    }
                                    else
                                    {
                                        $tel = $row['Telefon'];
                                    }
                                    if(!empty($_POST['tytul']))
                                    {
                                        $tytul = $_POST['tytul'];
                                    }
                                    else
                                    {
                                        $tytul = $row['Tytul'];
                                    }

                                    $zap = "Update lekarze Set Imię = '$nazwam',Nazwisko = '$nazwisko',PESEL = '$pesel',Telefon = '$tel',Tytul = '$tytul' WHERE ID_lekarz='$idm'";
                                    $query = mysqli_query($db,$zap);

                                    $zap = "SELECT * FROM lekarze";
                                        $query = mysqli_query($db,$zap);
                                        echo '
                                        <div class="szukidod">
                                        <form method="POST">
                                            <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajL"></div>
                                            <input class="dodaj" name="dodajL" type="submit" value="+">
                                        </form>
                                        <div style="clear:both;"></div>
                                        ';
                                        if (mysqli_num_rows($query) > 0)
                                        {
                                            echo "<table>";
                                            echo "<thead>";
                                            echo "<tr>";
                                            echo "<td>ID<br>Lekarza</td>";
                                            echo "<td>Imie</td>";
                                            echo "<td>Nazwisko</td>";
                                            echo "<td>PESEL</td>";
                                            echo "<td>Telefon</td>";
                                            echo "<td>Tytul</td>";
                                            echo "<td style='color:#121212;'>Usun</td>";
                                            echo "</tr>";
                                            echo "</thead>";
                                        }
                                        echo "<tbody>";
                                        while ($row = mysqli_fetch_array($query))
                                        {
            
                                            echo "<tr>";
                                            echo "<td>". $row['ID_lekarz'] . "</td>";
                                            echo "<td>". $row['Imię'] . "</td>";
                                            echo "<td>". $row['Nazwisko'] . "</td>";
                                            echo "<td>". $row['PESEL'] . "</td>";
                                            echo "<td>". $row['Telefon'] . "</td>";
                                            echo "<td>". $row['Tytul'] . "</td>";
                                            echo "<td>".'<form method="POST">
                                                <button type="submit" name="mlekarz" class="modifyb">
                                                    <input type="hidden" name="id" value='. $row['ID_lekarz'] .'>
                                                    <img src="pen.png" alt="pen">
                                                </button>
                                                <button type="submit" name="ulekarz" class="x">
                                                <input type="hidden" name="id" value='. $row['ID_lekarz'] .'>
                                                <img src="bin.png" alt="bin">
                                                </button></form>'. "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                }
                            }
   
                        }
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db->close();
            
                    }
                    // ############################################################USUWANIE LEKARZE
                    if(isset($_POST['ulekarz']))
                    {
                        $id = $_POST['id'];

                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {
                            $zap1 = "SELECT * FROM lekarze";
                            $query2 = mysqli_query($db,$zap1);
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_lekarz'] == $id)
                                {
                                    $zap = "DELETE FROM lekarze WHERE ID_lekarz ='$id'";
                                    $query = mysqli_query($db,$zap); 
                                    
                                    $zap = "SELECT * FROM lekarze";
                                        $query = mysqli_query($db,$zap);
                                        echo '
                                        <div class="szukidod">
                                        <form method="POST">
                                            <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajL"></div>
                                            <input class="dodaj" name="dodajL" type="submit" value="+">
                                        </form>
                                        <div style="clear:both;"></div>
                                        ';
                                        if (mysqli_num_rows($query) > 0)
                                        {
                                            echo "<table>";
                                            echo "<thead>";
                                            echo "<tr>";
                                            echo "<td>ID<br>Lekarza</td>";
                                            echo "<td>Imie</td>";
                                            echo "<td>Nazwisko</td>";
                                            echo "<td>PESEL</td>";
                                            echo "<td>Telefon</td>";
                                            echo "<td>Tytul</td>";
                                            echo "<td style='color:#121212;'>Usun</td>";
                                            echo "</tr>";
                                            echo "</thead>";
                                        }
                                        echo "<tbody>";
                                        while ($row = mysqli_fetch_array($query))
                                        {
            
                                            echo "<tr>";
                                            echo "<td>". $row['ID_lekarz'] . "</td>";
                                            echo "<td>". $row['Imię'] . "</td>";
                                            echo "<td>". $row['Nazwisko'] . "</td>";
                                            echo "<td>". $row['PESEL'] . "</td>";
                                            echo "<td>". $row['Telefon'] . "</td>";
                                            echo "<td>". $row['Tytul'] . "</td>";
                                            echo "<td>".'<form method="POST">
                                                <button type="submit" name="mlekarz" class="modifyb">
                                                    <input type="hidden" name="id" value='. $row['ID_lekarz'] .'>
                                                    <img src="pen.png" alt="pen">
                                                </button>
                                                <button type="submit" name="ulekarz" class="x">
                                                <input type="hidden" name="id" value='. $row['ID_lekarz'] .'>
                                                <img src="bin.png" alt="bin">
                                                </button></form>'. "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                        }
                            } 
                        }   
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db -> close();
                    }


                    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! PACJENCI
                    if(isset($_POST['pacjenci']))
                    {
                        echo '
                <div class="szukidod">
                <form method="POST">
                    <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajP"></div>
                    <input class="dodaj" name="dodajP" type="submit" value="+">
                </form>
                <div style="clear:both;"></div>
                ';
                        $db = new mysqli ("localhost","root","","przychodnia");
                            if ($db)
                            {
                                $zap = "SELECT * FROM pacjenci";
                                $query = mysqli_query($db,$zap);
                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Pacjenta</td>";
                                    echo "<td>Imie</td>";
                                    echo "<td>Nazwisko</td>";
                                    echo "<td>PESEL</td>";
                                    echo "<td>Telefon</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($query))
                                {
    
                                    echo "<tr>";
                                    echo "<td>". $row['ID_pacjent'] . "</td>";
                                    echo "<td>". $row['Imię'] . "</td>";
                                    echo "<td>". $row['Nazwisko'] . "</td>";
                                    echo "<td>". $row['PESEL'] . "</td>";
                                    echo "<td>". $row['Telefon'] . "</td>";
                                    echo "<td>".'<form method="POST">
                                        <button type="submit" name="mpacjent" class="modifyb">
                                            <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                            <img src="pen.png" alt="pen">
                                        </button>
                                        <button type="submit" name="upacjent" class="x">
                                        <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                        <img src="bin.png" alt="bin">
                                        </button></form>'. "</td>";
                                    echo "</tr>";
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
                    }

                    // ##################################################### DODAWANIE PACJENT
                    if(isset($_POST['dodajP']))
                    {
                        echo '
                        <div class="form">
                        <form method="POST">
        
                        <input placeholder="Imie" type="text" style="text-transform: capitalize;" name="imie" maxlength="50" required><br>
                        <input placeholder="Nazwisko" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50" required><br>
                        <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
                        <input placeholder="Telefon" type="number" name="tel"><br>
                        <input type="submit" value="+" name="dp">
                        </form>
                        </div>
                        ';
                    }
                    if (isset($_POST['dp']))
                    {
                        $imie = ucfirst($_POST['imie']);
                        $nazwisko = ucfirst($_POST['nazwisko']);
                        $pesel = $_POST['pesel'];    
                        $tel = $_POST['tel'];


                        $db = new mysqli("localhost","root","","przychodnia");
                        
                        if($db)
                        {
                            $zap = "INSERT INTO pacjenci VALUE(null,'$imie','$nazwisko','$pesel','$tel',null)";
                            $query = mysqli_query($db,$zap);
                            

                            if($query)
                            {
                                echo '
                                <div class="form">
                                <form method="POST">
                
                                <input placeholder="Imie" type="text" style="text-transform: capitalize;" name="imie" maxlength="50" required><br>
                                <input placeholder="Nazwisko" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50" required><br>
                                <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
                                <input placeholder="Telefon" type="number" name="tel"><br>
                                <input type="submit" value="+" name="dp">
                                </form>
                                </div>
                                ';
                                echo "<h6>dodales pracownika</h6>";
                            }
                            else
                            {
                                echo '
                                <div class="form">
                                <form method="POST">
                
                                <input placeholder="Imie" type="text" style="text-transform: capitalize;" name="imie" maxlength="50" required><br>
                                <input placeholder="Nazwisko" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50" required><br>
                                <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
                                <input placeholder="Telefon" type="number" name="tel"><br>
                                <input type="submit" value="+" name="dp">
                                </form>
                                </div>
                                ';
                                echo "<h6>wystapil blad podczas dodawania</h6> ";
                            }
                        }
                        else
                        {
                            echo"blad polaczenia z baza danych";
                        }
                        $db->close();
                    }
                    // ############################################################USUWANIE PACJENCI
                    if(isset($_POST['upacjent']))
                    {
                        $id = $_POST['id'];

                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {
                            $zap1 = "SELECT * FROM pacjenci";
                            $query2 = mysqli_query($db,$zap1);
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_pacjent'] == $id)
                                {
                                    $zap = "DELETE FROM pacjenci WHERE ID_pacjent ='$id'";
                                    $query = mysqli_query($db,$zap); 

                                        $zap = "SELECT * FROM pacjenci";
                                    $query = mysqli_query($db,$zap);
                                    echo '
                                    <div class="szukidod">
                                    <form method="POST">
                                        <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajP"></div>
                                        <input class="dodaj" name="dodajP" type="submit" value="+">
                                    </form>
                                    <div style="clear:both;"></div>
                                    ';
                                    if (mysqli_num_rows($query) > 0)
                                    {
                                        echo "<table>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<td>ID<br>Pacjenta</td>";
                                        echo "<td>Imie</td>";
                                        echo "<td>Nazwisko</td>";
                                        echo "<td>PESEL</td>";
                                        echo "<td>Telefon</td>";
                                        echo "<td style='color:#121212;'>Usun</td>";
                                        echo "</tr>";
                                        echo "</thead>";
                                    }
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($query))
                                    {
        
                                        echo "<tr>";
                                        echo "<td>". $row['ID_pacjent'] . "</td>";
                                        echo "<td>". $row['Imię'] . "</td>";
                                        echo "<td>". $row['Nazwisko'] . "</td>";
                                        echo "<td>". $row['PESEL'] . "</td>";
                                        echo "<td>". $row['Telefon'] . "</td>";
                                        echo "<td>".'<form method="POST">
                                            <button type="submit" name="mpacjent" class="modifyb">
                                                <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                                <img src="pen.png" alt="pen">
                                            </button>
                                            <button type="submit" name="upacjent" class="x">
                                            <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                            <img src="bin.png" alt="bin">
                                            </button></form>'. "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";

                                }
                            } 
                        }   
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db -> close();
                    }
                // ############################################################SZUKANIE PACJENCI
                if(isset($_POST['szukajP']))
                    {
                        echo '
                        <div class="szukidod">
                        <form method="POST">
                            <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajP"></div>
                            <input class="dodaj" name="dodajP" type="submit" value="+">
                        </form>
                        <div style="clear:both;"></div>
                        ';
                        $szukane = $_POST['szukaj'];
                        $i = 0;
                        $db = new mysqli ("localhost","root","","przychodnia");
                        if($db)
                        {
                            $zap = "SELECT * FROM pacjenci";
                                $query = mysqli_query($db,$zap);
                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Pacjenta</td>";
                                    echo "<td>Imie</td>";
                                    echo "<td>Nazwisko</td>";
                                    echo "<td>PESEL</td>";
                                    echo "<td>Telefon</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                    while ($row = mysqli_fetch_array($query))
                                    {
                                        if ($row['ID_pacjent'] == $szukane or $row['Imię'] == $szukane or $row['Nazwisko'] == $szukane or $row['PESEL'] == $szukane)
                                        {
                                        $i+=1;
                                        echo "<tr>";
                                        echo "<td>". $row['ID_pacjent'] . "</td>";
                                        echo "<td>". $row['Imię'] . "</td>";
                                        echo "<td>". $row['Nazwisko'] . "</td>";
                                        echo "<td>". $row['PESEL'] . "</td>";
                                        echo "<td>". $row['Telefon'] . "</td>";
                                        echo "<td>".'<form method="POST">
                                            <button type="submit" name="mpacjent" class="modifyb">
                                                <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                                <img src="pen.png" alt="pen">
                                            </button>
                                            <button type="submit" name="upacjent" class="x">
                                            <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                            <img src="bin.png" alt="bin">
                                            </button></form>'. "</td>";
                                        echo "</tr>";
                                        }
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    if ($i==0)
                                    {
                                        echo "BRAK WYNIKOW";
                                    }
                                
    
                        }
                        else
                        {
                            echo"Blad polczenia z baza danych";
                        }
                        $db->close();
                    }
                    // ############################################################MODYFIKACJA PACJENCI
                    if(isset($_POST['mpacjent']))
                    {
                        $id = $_POST['id'];
                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {   
                            $zap1 = "SELECT * FROM pacjenci";
                            $query2 = mysqli_query($db,$zap1);
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_pacjent'] == $id)
                                {
                                    echo '
                                    <div class="form">
                                    <form method="POST">
                                    <input type="hidden" name = "id" value = "'. $row['ID_pacjent'].'">
                                    <input placeholder="'. $row['Imię'] . '" type="text" style="text-transform: capitalize;" name="imie" maxlength="50"><br>
                                    <input placeholder="'. $row['Nazwisko'] . '" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50"><br>
                                    <input placeholder="'. $row['PESEL'] . '" type="text" name="pesel" maxlength="11" pattern="[0-9]+"><br>
                                    <input placeholder="'. $row['Telefon'] . '" type="number" name="tel"><br>
                                    <input type="submit" value="modyfikuj" name="mp">
                                    </form>
                                    </div>
                                    ';
                                }
                            }
                        }
                    }
                    if(isset($_POST['mp']))
                    {
                        $idm = $_POST['id'];
                        $i = 0;
            
                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {  
                            $zap1 = "SELECT * FROM pacjenci";
                            $query2 = mysqli_query($db,$zap1);
            
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_pacjent'] == $idm)
                                {
                                    if (!empty($_POST['imie']))
                                    {
                                        $nazwam = $_POST['imie'];  
                                    }
                                    else
                                    {
                                        $nazwam = $row['Imię'];
                                    }
                                    if (!empty($_POST['nazwisko']))
                                    {
                                        $nazwisko = $_POST['nazwisko'];
                                    }
                                    else
                                    {
                                        $nazwisko = $row['Nazwisko'];
            
                                    }
                                    if(!empty($_POST['pesel']))
                                    {
                                        $pesel = $_POST['pesel'];
                                    }
                                    else
                                    {
                                        $pesel = $row['PESEL'];
                                    }
                                    if(!empty($_POST['tel']))
                                    {
                                        $tel= $_POST['tel'];
                                    }
                                    else
                                    {
                                        $tel = $row['Telefon'];
                                    }
                                    $zap = "Update pacjenci Set Imię = '$nazwam',Nazwisko = '$nazwisko',PESEL = '$pesel',Telefon = '$tel' WHERE ID_pacjent='$idm'";
                                    $query = mysqli_query($db,$zap);


                                        $zap = "SELECT * FROM pacjenci";
                                        $query = mysqli_query($db,$zap);
                                        echo '
                                        <div class="szukidod">
                                        <form method="POST">
                                            <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajP"></div>
                                            <input class="dodaj" name="dodajP" type="submit" value="+">
                                        </form>
                                        <div style="clear:both;"></div>
                                        ';
                                        if (mysqli_num_rows($query) > 0)
                                        {
                                            echo "<table>";
                                            echo "<thead>";
                                            echo "<tr>";
                                            echo "<td>ID<br>Pacjenta</td>";
                                            echo "<td>Imie</td>";
                                            echo "<td>Nazwisko</td>";
                                            echo "<td>PESEL</td>";
                                            echo "<td>Telefon</td>";
                                            echo "<td style='color:#121212;'>Usun</td>";
                                            echo "</tr>";
                                            echo "</thead>";
                                        }
                                        echo "<tbody>";
                                        while ($row = mysqli_fetch_array($query))
                                        {
            
                                            echo "<tr>";
                                            echo "<td>". $row['ID_pacjent'] . "</td>";
                                            echo "<td>". $row['Imię'] . "</td>";
                                            echo "<td>". $row['Nazwisko'] . "</td>";
                                            echo "<td>". $row['PESEL'] . "</td>";
                                            echo "<td>". $row['Telefon'] . "</td>";
                                            echo "<td>".'<form method="POST">
                                                <button type="submit" name="mpacjent" class="modifyb">
                                                    <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                                    <img src="pen.png" alt="pen">
                                                </button>
                                                <button type="submit" name="upacjent" class="x">
                                                <input type="hidden" name="id" value='. $row['ID_pacjent'] .'>
                                                <img src="bin.png" alt="bin">
                                                </button></form>'. "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";

                                    
                                }
                            }
   
                        }
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db->close();
            
                    }
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! GABINECI
                if(isset($_POST['gabinety']))
                    {
                        echo '
                <div class="szukidod">
                <form method="POST">
                    <input class="dodaj" name="dodajG" type="submit" value="+">
                </form>
                <div style="clear:both;"></div>
                ';
                        $db = new mysqli ("localhost","root","","przychodnia");
                            if ($db)
                            {
                                $zap = "SELECT * FROM gabinet";
                                $query = mysqli_query($db,$zap);
                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Gabinet</td>";
                                    echo "<td>NR Gabinetu</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($query))
                                {
    
                                    echo "<tr>";
                                    echo "<td>". $row['ID_gabinet'] . "</td>";
                                    echo "<td>". $row['Nr_gabinetu'] . "</td>";
                                    echo "<td>".'<form method="POST">
                                        <button type="submit" name="ugabinet" class="x">
                                        <input type="hidden" name="id" value='. $row['ID_gabinet'] .'>
                                        <img src="bin.png" alt="bin">
                                        </button></form>'. "</td>";
                                    echo "</tr>";
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
                    }

                    // ####################################################################### DODAWANIE GABINET
                    if(isset($_POST['dodajG']))
                    {
                        echo '
                        <div class="form">
                        <form method="POST">
                        <input placeholder="Numer Gabinetu" type="number" name="gabinet" required><br>
                        <input type="submit" value="+" name="dg">
                        </form>
                        </div>
                        ';
                    }
                    if (isset($_POST['dg']))
                    {
                        $numer = $_POST['gabinet'];


                        $db = new mysqli("localhost","root","","przychodnia");
                        
                        if($db)
                        {
                            $zap = "INSERT INTO gabinet VALUE(null,'$numer')";
                            $query = mysqli_query($db,$zap);
                            

                            if($query)
                            {
                                echo '
                                <div class="form">
                                <form method="POST">
                                <input placeholder="" type="number" name="gabinet" required><br>
                                <input type="submit" value="+" name="dg">
                                </form>
                                </div>
                                ';
                                echo "<h6>dodales pracownika</h6>";
                            }
                            else
                            {
                                echo '
                                <div class="form">
                                <form method="POST">
                                <input placeholder="Numer Gabinetu" type="number" name="gabinet" required><br>
                                <input type="submit" value="+" name="dg">
                                </form>
                                </div>
                                ';
                                echo "<h6>wystapil blad podczas dodawania</h6> ";
                            }
                        }
                        else
                        {
                            echo"blad polaczenia z baza danych";
                        }
                        $db->close();
                    }
                    // ######################################################## USUWANIE GABINETU
                    if(isset($_POST['ugabinet']))
                    {
                        $id = $_POST['id'];

                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {
                            $zap1 = "SELECT * FROM gabinet";
                            $query2 = mysqli_query($db,$zap1);
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_gabinet'] == $id)
                                {
                                    $zap = "DELETE FROM gabinet WHERE ID_gabinet ='$id'";
                                    $query = mysqli_query($db,$zap); 

                                        
                                    $zap = "SELECT * FROM gabinet";
                                    $query = mysqli_query($db,$zap);

                                    echo '
                                    <div class="szukidod">
                                    <form method="POST">
                                        <input class="dodaj" name="dodajG" type="submit" value="+">
                                    </form>
                                    <div style="clear:both;"></div>
                                    ';
                                    if (mysqli_num_rows($query) > 0)
                                    {
                                        echo "<table>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<td>ID<br>Gabinet</td>";
                                        echo "<td>NR Gabinetu</td>";
                                        echo "<td style='color:#121212;'>Usun</td>";
                                        echo "</tr>";
                                        echo "</thead>";
                                    }
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($query))
                                    {
        
                                        echo "<tr>";
                                        echo "<td>". $row['ID_gabinet'] . "</td>";
                                        echo "<td>". $row['Nr_gabinetu'] . "</td>";
                                        echo "<td>".'<form method="POST">
                                            <button type="submit" name="ugabinet" class="x">
                                            <input type="hidden" name="id" value='. $row['ID_gabinet'] .'>
                                            <img src="bin.png" alt="bin">
                                            </button></form>'. "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                }
                            } 
                        }   
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db -> close();
                    }

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! WIZYTY
        if(isset($_POST['wizyty']))
                    {
                        echo '
                <div class="szukidod">
                <form method="POST">
                    <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajW"></div>
                    <input class="dodaj" name="dodajW" type="submit" value="+">
                </form>
                <div style="clear:both;"></div>
                ';
                        $db = new mysqli ("localhost","root","","przychodnia");
                            if ($db)
                            {
                                $zap = "SELECT * FROM wizyty";
                                $query = mysqli_query($db,$zap);
                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Wizyty</td>";
                                    echo "<td>ID<br>Lekarza</td>";
                                    echo "<td>ID<br>Pacjenta</td>";
                                    echo "<td>ID<br>Gabinetu</td>";
                                    echo "<td>Data</td>";
                                    echo "<td>Godzina</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($query))
                                {
    
                                    echo "<tr>";
                                    echo "<td>". $row['ID_wizyta'] . "</td>";
                                    echo "<td>". $row['ID_lekarz'] . "</td>";
                                    echo "<td>". $row['ID_pacjent'] . "</td>";
                                    echo "<td>". $row['ID_gabinet'] . "</td>";
                                    echo "<td>". $row['Data'] . "</td>";
                                    echo "<td>". $row['Godzina'] . "</td>";

                                    echo "<td>".'<form method="POST">
                                        <button type="submit" name="mwizyty" class="modifyb">
                                            <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                            <img src="pen.png" alt="pen">
                                        </button>
                                        <button type="submit" name="uwizyty" class="x">
                                        <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                        <img src="bin.png" alt="bin">
                                        </button></form>'. "</td>";
                                    echo "</tr>";
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
                    }
                     // ############################################################SZUKANIE WIZYTY
                     if(isset($_POST['szukajW']))
                     {
                         echo '
                         <div class="szukidod">
                         <form method="POST">
                             <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajW"></div>
                             <input class="dodaj" name="dodajW" type="submit" value="+">
                         </form>
                         <div style="clear:both;"></div>
                         ';
                         $szukane = $_POST['szukaj'];
                         $i = 0;
                         $db = new mysqli ("localhost","root","","przychodnia");
                         if($db)
                         {
                             $zap = "SELECT * FROM wizyty";
                                 $query = mysqli_query($db,$zap);
                                 if (mysqli_num_rows($query) > 0)
                                 {
                                     echo "<table>";
                                     echo "<thead>";
                                     echo "<tr>";
                                     echo "<td>ID<br>Wizyty</td>";
                                     echo "<td>ID<br>Lekarza</td>";
                                     echo "<td>ID<br>Pacjenta</td>";
                                     echo "<td>ID<br>Gabinetu</td>";
                                     echo "<td>Data</td>";
                                     echo "<td>Godzina</td>";
                                     echo "<td style='color:#121212;'>Usun</td>";
                                     echo "</tr>";
                                     echo "</thead>";
                                 }
                                 echo "<tbody>";
                                     while ($row = mysqli_fetch_array($query))
                                     {
                                         if ($row['Data'] == $szukane or $row['ID_pacjent'] == $szukane)
                                         {
                                         $i+=1;
                                         echo "<tr>";
                                         echo "<td>". $row['ID_wizyta'] . "</td>";
                                         echo "<td>". $row['ID_lekarz'] . "</td>";
                                         echo "<td>". $row['ID_pacjent'] . "</td>";
                                         echo "<td>". $row['ID_gabinet'] . "</td>";
                                         echo "<td>". $row['Data'] . "</td>";
                                         echo "<td>". $row['Godzina'] . "</td>";
     
                                         echo "<td>".'<form method="POST">
                                             <button type="submit" name="mwizyty" class="modifyb">
                                                 <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                                 <img src="pen.png" alt="pen">
                                             </button>
                                             <button type="submit" name="uwizyty" class="x">
                                             <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                             <img src="bin.png" alt="bin">
                                             </button></form>'. "</td>";
                                         echo "</tr>";
                                         }
                                     }
                                     echo "</tbody>";
                                     echo "</table>";
                                     if ($i==0)
                                     {
                                         echo "BRAK WYNIKOW";
                                     }
                                 
     
                         }
                         else
                         {
                             echo"Blad polczenia z baza danych";
                         }
                         $db->close();
                     }

                    // ############################################################DODAWANIE WIZYTY

                     if(isset($_POST['dodajW']))
                    {
                        echo '
                        <div class="form">
                        <form method="POST">
        
                        <input placeholder="Data wizyty" type="date"  name="data" required><br>
                        <input placeholder="Godzina" type="time"  name="czas" required><br>';
                        
                        $db_k = new mysqli("localhost","root","","przychodnia");
                        if($db_k)
                        {       
                        $zap_k= "SELECT ID_lekarz, Imię, Nazwisko FROM lekarze";
                        $query_k= mysqli_query($db_k,$zap_k);
                        echo " <div> <select name='id_l' >";
                while($row = mysqli_fetch_array($query_k))
                {
                    echo "<option value='" . $row['ID_lekarz'] ."'>" . $row['Nazwisko'] . " ". $row['Imię'] . "</option>";
                }
                echo "</select></div>";




                $zap_p= "SELECT ID_pacjent, Imię, Nazwisko FROM pacjenci";
                $query_p= mysqli_query($db_k,$zap_p);
                echo " <div> <select name='id_p' >";
        while($row = mysqli_fetch_array($query_p))
        {
            echo "<option value='" . $row['ID_pacjent'] ."'>" . $row['Nazwisko'] . " ". $row['Imię'] . "</option>";
        }
        echo "</select></div>";




                
                $zap_p= "SELECT * FROM gabinet";
                $query_p= mysqli_query($db_k,$zap_p);
                echo " <div> <select name='id_g'>";

                    
                while($row = mysqli_fetch_array($query_p))
                {
                    echo "<option value='" . $row['ID_gabinet'] ."'>" . $row['Nr_gabinetu'] . "</option>";
                }
                echo "</select></div>";
            }
            else
            {
                echo "blad polaczenia z baza danych";
            }
            echo
            '   
            <input name="x" type="submit" value="X">
            <input type="submit" value="+" name="dw">
            </form>
            </div>
            ';
            if (isset($_POST['x']))
            {
                header("Location: wizyty.php");
            }

                        echo '</form>
                        </div>
                        ';
                    }
                    if (isset($_POST['dw']))
                    {
                        $idl = $_POST['id_l'];
                        $idp = $_POST['id_p'];
                        $idg = $_POST['id_g'];    
                        $data = $_POST['data'];
                        $czas = $_POST['czas'];


                        $db = new mysqli("localhost","root","","przychodnia");
                        
                        if($db)
                        {
                            $zap = "INSERT INTO wizyty VALUE(null,'$idl','$idp','$idg','$data','$czas')";
                            $query = mysqli_query($db,$zap);
                            

                            if($query)
                            {

                                echo "<h6>dodales wizyte</h6>";
                            }
                            else
                            {

                                echo "<h6>wystapil blad podczas dodawania</h6> ";
                            }
                        }
                        else
                        {
                            echo"blad polaczenia z baza danych";
                        }
                        $db->close();
                    }
                    // ############################################################USUWANIE WIZYTY
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


                                    $zap = "SELECT * FROM wizyty";
                                $query = mysqli_query($db,$zap);

                                echo '
                                <div class="szukidod">
                                <form method="POST">
                                    <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajW"></div>
                                    <input class="dodaj" name="dodajW" type="submit" value="+">
                                </form>
                                <div style="clear:both;"></div>
                                ';




                                if (mysqli_num_rows($query) > 0)
                                {
                                    echo "<table>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<td>ID<br>Wizyty</td>";
                                    echo "<td>ID<br>Lekarza</td>";
                                    echo "<td>ID<br>Pacjenta</td>";
                                    echo "<td>ID<br>Gabinetu</td>";
                                    echo "<td>Data</td>";
                                    echo "<td>Godzina</td>";
                                    echo "<td style='color:#121212;'>Usun</td>";
                                    echo "</tr>";
                                    echo "</thead>";
                                }
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($query))
                                {
    
                                    echo "<tr>";
                                    echo "<td>". $row['ID_wizyta'] . "</td>";
                                    echo "<td>". $row['ID_lekarz'] . "</td>";
                                    echo "<td>". $row['ID_pacjent'] . "</td>";
                                    echo "<td>". $row['ID_gabinet'] . "</td>";
                                    echo "<td>". $row['Data'] . "</td>";
                                    echo "<td>". $row['Godzina'] . "</td>";

                                    echo "<td>".'<form method="POST">
                                        <button type="submit" name="mwizyty" class="modifyb">
                                            <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                            <img src="pen.png" alt="pen">
                                        </button>
                                        <button type="submit" name="uwizyty" class="x">
                                        <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                        <img src="bin.png" alt="bin">
                                        </button></form>'. "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                   

                                        }
                            } 
                        }   
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db -> close();
                    }




                    //################################################## MODYFIKACJA WIZYTY

                    if(isset($_POST['mwizyty']))
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

echo '
                                    <div class="form">
                                    <form method="POST">
                                    <input placeholder="'. $row['Data'] . '" type="date"  name="data"><br>
                                    <input placeholder="'. $row['Godzina'] . '" type="time"  name="czas"><br>
                                    ';


                                    $db_k = new mysqli("localhost","root","","przychodnia");
                                    if($db_k)
                                    {       
                                    $zap_k= "SELECT ID_lekarz, Imię, Nazwisko FROM lekarze";
                                    $query_k= mysqli_query($db_k,$zap_k);
                                    echo " <div> <select name='id_l' >";
                                    echo "<option value='nie'>--Nie modyfikuj--</option>";
                            while($row = mysqli_fetch_array($query_k))
                            {
                                echo "<option value='" . $row['ID_lekarz'] ."'>" . $row['Nazwisko'] . " ". $row['Imię'] . "</option>";
                            }
                            echo "</select></div>";
            
            
            
            
                            $zap_p= "SELECT ID_pacjent, Imię, Nazwisko FROM pacjenci";
                            $query_p= mysqli_query($db_k,$zap_p);
                            echo " <div> <select name='id_p' >";
                            echo "<option value='nie'>--Nie modyfikuj--</option>";
                    while($row = mysqli_fetch_array($query_p))
                    {
                        echo "<option value='" . $row['ID_pacjent'] ."'>" . $row['Nazwisko'] . " ". $row['Imię'] . "</option>";
                    }
                    echo "</select></div>";
            
            
            
            
                            
                            $zap_p= "SELECT * FROM gabinet";
                            $query_p= mysqli_query($db_k,$zap_p);
                            echo " <div> <select name='id_g'>";
                            echo "<option value='nie'>--Nie modyfikuj--</option>";
                                
                            while($row = mysqli_fetch_array($query_p))
                            {
                                echo "<option value='" . $row['ID_gabinet'] ."'>" . $row['Nr_gabinetu'] . "</option>";
                            }
                            echo "</select></div>";
                        }


echo '
                                    <input value="'. $id . '" type="hidden"  name="id">
                                    <input type="submit" value="modyfikuj" name="mw">
                                    </form>
                                    </div>
                                    ';
                                }
                            }
                        }
                    }
                    if(isset($_POST['mw']))
                    {
                        $idm = $_POST['id'];
                        $i = 0;
            
                        $db = new mysqli("localhost","root","","przychodnia");
                        if($db)
                        {  
                            $zap1 = "SELECT * FROM wizyty";
                            $query2 = mysqli_query($db,$zap1);
            
                            while ($row = mysqli_fetch_array($query2))
                            {
                                if($row['ID_wizyta'] == $idm)
                                {
                                    if (!empty($_POST['data']))
                                    {
                                        $data = $_POST['data'];  
                                    }
                                    else
                                    {
                                        $data = $row['Data'];
                                    }
                                    if (!empty($_POST['czas']))
                                    {
                                        $czas = $_POST['czas'];
                                    }
                                    else
                                    {
                                        $czas = $row['Godzina'];
            
                                    }
                                    if($_POST['id_l'] == 'nie')
                                    {
                                        $id_l = $row['ID_lekarz'];
                                    }
                                    else
                                    {
                                        $id_l = $_POST['id_l'];
                                    }
                                    if($_POST['id_p'] == 'nie')
                                    {
                                        $id_p = $row['ID_pacjent'];
                                    }
                                    else
                                    {
                                        $id_p = $_POST['id_p'];
                                    }
                                    if($_POST['id_g'] == 'nie')
                                    {
                                        $id_g = $row['ID_gabinet'];
                                    }
                                    else
                                    {
                                        $id_g = $_POST['id_g'];
                                    }


                                    $zap = "Update wizyty Set ID_lekarz = '$id_l',ID_pacjent = '$id_p',ID_gabinet = '$id_g',Data= '$data',Godzina = '$czas' WHERE ID_wizyta='$idm'";
                                    $query = mysqli_query($db,$zap);

                                   


                                    echo '
                                    <div class="szukidod">
                                    <form method="POST">
                                        <div class="cos"><input type="text" name="szukaj"><input type="submit" value="szukaj" name="szukajW"></div>
                                        <input class="dodaj" name="dodajW" type="submit" value="+">
                                    </form>
                                    <div style="clear:both;"></div>
                                    ';

                                    $zap = "SELECT * FROM wizyty";
                                $query = mysqli_query($db,$zap);
    
                                    if (mysqli_num_rows($query) > 0)
                                    {
                                        echo "<table>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<td>ID<br>Wizyty</td>";
                                        echo "<td>ID<br>Lekarza</td>";
                                        echo "<td>ID<br>Pacjenta</td>";
                                        echo "<td>ID<br>Gabinetu</td>";
                                        echo "<td>Data</td>";
                                        echo "<td>Godzina</td>";
                                        echo "<td style='color:#121212;'>Usun</td>";
                                        echo "</tr>";
                                        echo "</thead>";
                                    }
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($query))
                                    {
        
                                        echo "<tr>";
                                        echo "<td>". $row['ID_wizyta'] . "</td>";
                                        echo "<td>". $row['ID_lekarz'] . "</td>";
                                        echo "<td>". $row['ID_pacjent'] . "</td>";
                                        echo "<td>". $row['ID_gabinet'] . "</td>";
                                        echo "<td>". $row['Data'] . "</td>";
                                        echo "<td>". $row['Godzina'] . "</td>";
    
                                        echo "<td>".'<form method="POST">
                                            <button type="submit" name="mwizyty" class="modifyb">
                                                <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                                <img src="pen.png" alt="pen">
                                            </button>
                                            <button type="submit" name="uwizyty" class="x">
                                            <input type="hidden" name="id" value='. $row['ID_wizyta'] .'>
                                            <img src="bin.png" alt="bin">
                                            </button></form>'. "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";


                                }
                            }
   
                        }
                        else
                        {
                            echo "<h6>blad polaczenia z baza danych</h6>";
                        }
                        $db->close();
            
                    }


                ?>
            </div>
        </div>
        
    </div> 

</body>
</html>