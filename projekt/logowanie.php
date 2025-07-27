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
    <title>Logowanie</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="icon" href="logo.png" type="image/icon type">
</head>
<body>
    <nav class="menu">
        <a href="glowna.php">
            <h3 id="logo">{medic center +}</h3>
        </a>
    </nav>

    <div class="zawartosc_log">
        <form method="POST">
            <h1>Logowanie</h1>
            <input placeholder="Login" type="text" name="login" required><br>
            <input placeholder="Haslo" type="password" name="haslo" required><br>
            <input class="pzaloguj" type="submit" value="zaloguj" name="zaloguj">
            
        </form>
        <p>nie masz jeszcze konta?</p>
        <a href="zarejestruj.php">zarejestruj sie</a>
    </div>    
    <div class="tlot"></div>
    <div class="tlot2"></div>
    <?php
        if(isset($_POST['zaloguj']))
        {   
            $db = new mysqli("localhost","root","","Przychodnia");

            if ($db)
            {

                $login = $_POST['login'];
                $haslo = $_POST['haslo'];
                $haslo = sha1($haslo);
                $zap = "SELECT * FROM uzytkownik WHERE login='".$login."' AND haslo='".$haslo."'";
 
                $wynik = mysqli_query($db,$zap);

                if (empty($login) || empty($haslo))
                {
                    echo "Uzupelnij pola";
                }
                else
                {
                    if( mysqli_num_rows($wynik)>=1)
                        {   
                            while($row = mysqli_fetch_array($wynik))
                            {
                                $_SESSION['ID_U'] = $row['ID_uzytkownik'];




                                if ($row['Rodzaj'] == 'admin')
                                {
                                    $_SESSION['zalogowany'] = 1;
                                    header("Location: zarzadzaj.php");
                                }
                                else
                                {
                                    $_SESSION['zalogowany'] = 2;
                                    header("Location: moje_dane.php");

                                }
                            }
                            

                            
                        }
                }
            }

            $db ->close();
        }
    ?>
</body>
</html>