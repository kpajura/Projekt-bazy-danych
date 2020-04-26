<?php

    session_start();
    if (isset($_POST['imie']))
    {
        $wszystko=true;
        
        $imie=$_POST['imie'];
        $sprawdz='/^[A-Z][a-z]+$/';
        if(!preg_match($sprawdz, $imie))
        {
            $wszystko=false;
            $_SESSION['e_imie']="Musi zaczycać się od wielkiej litery.";
        }
        
        $nazwisko=$_POST['nazwisko'];
        if(!preg_match($sprawdz, $nazwisko))
        {
            $wszystko=false;
            $_SESSION['e_nazwisko']="Musi zaczycać się od wielkiej litery.";
        }
        $adres=$_POST['adres'];
        $dataur=$_POST['dataur'];
        if (!preg_match('/^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/',$dataur))
        {
            $wszystko=false;
            $_SESSION['e_dataur']="Niepoprawny format daty.";
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
                     
                    if ($polaczenie->query("INSERT INTO klienci (IMIE, NAZWISKO, ADRES, DATA_UR) VALUES ('$imie', '$nazwisko', '$adres', '$dataur')"))
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
    <title>Dodaj klienta</title>
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
        <p> Imię: <br /><br /><input type="text" name="imie" /><br /></p>
        <?php
            if(isset($_SESSION['e_imie']))
            {
                echo'<div class="error">'.$_SESSION['e_imie'].'</div>';
                unset($_SESSION['e_imie']);
            }
        ?>
        <p> Nazwisko:<br /><br /><input type="text" name="nazwisko" /><br /></p>
        <?php
            if(isset($_SESSION['e_nazwisko']))
            {
                echo'<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
                unset($_SESSION['e_nazwisko']);
            }
        ?>
        <p>Adres: <br /><br /><input type="text" name="adres" /><br /></p>
        <p>Data urodzenia: <br /><br /><input type="text" name="dataur" /><br /></p>
        <br />
        <?php
            if(isset($_SESSION['e_dataur']))
            {
                echo'<div class="error">'.$_SESSION['e_dataur'].'</div>';
                unset($_SESSION['e_dataur']);
            }
        ?>
        </p>
        <p> <input type="submit" value="Dodaj"></p>


    </form>
    <a href="index.php">
        <h2>Powróć do strony głównej<h2></h2>
    </a>
    <a href="bazak.php">
        <h2>Pokaż baze klientów</h2>
    </a>
</body>

</html>
