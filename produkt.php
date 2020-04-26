<?php

    session_start();
if (isset($_POST['nazwa']))
    {
        $wszystko=true;
        
        $nazwa=$_POST['nazwa'];
        $cena=$_POST['cena'];
        
        if(strlen(substr(strrchr($cena, "."), 1))!=2)
        {
            $wszystko=false;
            $_SESSION['e_cena']="Nieprawidłowy format ceny.";
                
        }

        require_once "connect.php";
        
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $polaczenie = new mysqli($host, $dbuser, $dbpassword, $dbname);
            if ($polaczenie->connect_errno!=0)
                {
                    throw new Exeption(mysqli_connect_errno());
                }
            else
            {
                if ($wszystko==true)
                {
                    //Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
                     
                    if ($polaczenie->query("INSERT INTO produkty (NAZWA, CENA) VALUES ('$nazwa', '$cena')"))
                    {
                        header('Location: dodaj.php');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                    }
                     
                }

                
                $polaczenie->close();
            }
        }
        
        catch(Exeption $e)
        {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy.</span>';
            echo '<br/>Informacja developerska: '.$e;
        }
        
    }

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge, chrome=1" />
    <title>Dodaj produkt</title>
    <style>
        P{
            color:darkblue;
            font-size: 20px;
            font-family: arial, sans-serif;
            text-align: center;
        }
          .error{
            color: red;
            text-align: center;
              font-family: arial, sans-serif;
        }
        a{
            color: darkcyan;
            font-size: 10px;
            text-decoration: none;
        font-family: arial, sans-serif;
        text-align: center;
            
        }
        a:hover{
            color: darkblue;
        }
    </style>
</head>

<body>
    <form method=POST>
        <p> Nazwa produktu: <br /><input type="text" name="nazwa" /><br /></p>
        <p>Cena: <br /><input type="text" name="cena" /><br /></p>
        <?php
            if(isset($_SESSION['e_cena']))
            {
                echo'<div class="error">'.$_SESSION['e_cena'].'</div>';
                unset($_SESSION['e_cena']);
            }
        ?>

        <br />
        <p> <input type="submit" value="Dodaj"></p>


    </form>
    <a href="index.php">
        <h2>Powróć do strony głównej<h2></h2>
    </a>
    <a href="bazap.php">
        <h2>Pokaż baze produktów</h2>
    </a>
</body>

</html>
