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
    <div class="zap"></div> 
    <div class="zawartosc3">

        <div class="tablea">

        <?php
                
                                 

            echo'                                            <div class="form">
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
            <input type="submit" value="+" name="dp">
            </form>
            </div>
            ';
            if (isset($_POST['x']))
            {
                header("Location: wizyty.php");
            }

            if (isset($_POST['dp']))
                                {
                $data = $_POST['data'];
                $godzina = $_POST['czas'];
                $lekarz = $_POST['id_l'];    
                $gabinet = $_POST['id_g'];
                
     
                    $db = new mysqli("localhost","root","","przychodnia");
                    $zap2 = "SELECT ID_pacjent, ID_uzytkownik FROM pacjenci";     
                    $query2 = mysqli_query($db,$zap2);
                    while ($row2 = mysqli_fetch_array($query2))
                    {
                        if ($row2['ID_uzytkownik'] == $_SESSION['ID_U'])
                        {
                           $pac = $row2["ID_pacjent"];
                        }
                    }
                    if($db)
                    {
                        $zap = "INSERT INTO wizyty VALUE(null,'$lekarz','$pac','$gabinet','$data','$godzina')";
                        $query = mysqli_query($db,$zap);
                        header("Location: wizyty.php");
        
                        }
                                    else
                                    {
                                        echo"blad polaczenia z baza danych";
                                    }
                                    $db->close();
                                }
                 

        ?>



        
        </div>
    </div>
</body>
</html>