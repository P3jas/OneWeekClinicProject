<?php
    session_start();
    if (empty($_SESSION['zalogowany']))
    {
        $_SESSION['zalogowany'] = 0;
    }
    if ($_SESSION['zalogowany'] >= 1 && $_SESSION['zalogowany'] <= 2)
    {
         header("Location: moje_dane.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <nav class="menu">
        <a href="glowna.php">
            <h3 id="logo">{medic center +}</h3>
        </a>
    </nav>

    <div class="zawartosc_log">
        <h1>Rejestracja</h1>
        <form method="post">
            <input placeholder="Imie" name="imie" type="text" required><br>
            <input placeholder="Nazwisko" name="Nazwisko" type="text" required><br>
            <input placeholder="Login" name="login" type="text" required><br>
            <input placeholder="Telefon" name="tel" type="number" required><br>
            <input placeholder="Email" name="email" type="text" required><br>
            <input placeholder="PESEL" type="text" name="pesel" maxlength="11" pattern="[0-9]+" required><br>
            <input placeholder="Haslo" name="haslo" type="password" required><br>
            <input placeholder="Haslo" name="haslo2" type="password" required><br>

            <input class="pzaloguj" type="submit" value="Zarejestruj" name="zar">
        </form>
     <p>Masz już konto?</p>
    <a href="logowanie.php">zaloguj sie</a>   
    </div>
    
    <div class="tlot"></div>
    <div class="tlot2"></div>
    <?php
        if(isset($_POST['zar']))
        {   
            $db = new mysqli("localhost","root","","przychodnia");

            if ($db)
            {

                $login = $_POST['login'];
                $haslo = $_POST['haslo'];
                $haslo2 = $_POST['haslo2'];
                $imie = ucfirst($_POST['imie']);
                $nazwisko = ucfirst($_POST['Nazwisko']);
                $pesel = $_POST['pesel'];    
                $tel = $_POST['tel'];
                $email = $_POST['email'];
                if ($haslo == $haslo2)
                {              
                    
                    $haslo = sha1($haslo);
                    $zap1 = "INSERT INTO uzytkownik VALUE(null,'$login','$haslo','$email','user')";
                    $query = mysqli_query($db,$zap1);
                    
                    $zap2 = "SELECT * FROM uzytkownik ORDER BY ID_uzytkownik DESC LIMIT 1";
                    
                    $query3 = mysqli_query($db,$zap2);
                    while($row = mysqli_fetch_array($query3))
                    {
                        $id = $row['ID_uzytkownik'];
                    }
                    $zap = "INSERT INTO pacjenci VALUE(null,'$imie','$nazwisko','$pesel','$tel',$id)";
                    $query2 = mysqli_query($db,$zap);
                    header("Location: logowanie.php");
                    
                    
                }
                else
                {
                    $message = "Hasla nie som takie same";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                

            
            }
            $db ->close();
        }
    ?>
</body>
</html>