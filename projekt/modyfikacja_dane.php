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
    <div class="tlot"></div>
    <div class="tlot2"></div>
    <div class="tlo"></div>
    <div class="zawartosc2">
    <?php


        $id = $_SESSION['ID_U'];
        $db = new mysqli("localhost","root","","przychodnia");
        if($db)
        {   
                        
            $zap1 = "SELECT * FROM pacjenci";
            $query2 = mysqli_query($db,$zap1);
            while ($row = mysqli_fetch_array($query2))
            {
                if($row['ID_uzytkownik'] == $id)
                {
                    echo '
                        <div class="form">
                        <form method="POST">
                        <input type="hidden" name = "id" value = "'. $row['ID_pacjent'].'">
                        <input placeholder="'. $row['Imię'] . '" type="text" style="text-transform: capitalize;" name="imie" maxlength="50"><br>
                        <input placeholder="'. $row['Nazwisko'] . '" type="text" style="text-transform: capitalize;" name="nazwisko" maxlength="50"><br>
                        <input placeholder="'. $row['PESEL'] . '" type="text" name="pesel" maxlength="11" pattern="[0-9]+"><br>
                        <input placeholder="'. $row['Telefon'] . '" type="number" name="tel"><br>
                        ';
                        /*$zap = "SELECT * FROM uzytkownik";
                        $query = mysqli_query($db,$zap);
                        while ($row = mysqli_fetch_array($query))
                        {
                            if($row['ID_uzytkownik'] == $id)
                            {
                                echo'
                                <input placeholder="Login" name="login" type="text"><br>
                                <input placeholder="Nowe Haslo" name="haslo" type="password" ><br>
                                <input placeholder="Powtorz Haslo" name="haslo2" type="password" ><br>
                                ';
                            }
                        }*/
                        echo'
                        <input name="x" type="submit" value="X">
                        <input type="submit" value="modyfikuj" name="mp">
                        </form>
                        </div>
                        ';
                }
            }
            $db->close();
        }
        if(isset($_POST['x']))
        {
            header("Location: moje_dane.php");
        }
        if(isset($_POST['mp']))
                    {
                        $idm = $_POST['id'];
            
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
                                    header('Location: moje_dane.php');

                                    
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
</body>
</html>