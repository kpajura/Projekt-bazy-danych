<?php

    session_start();
    if (isset($_POST['datazam']))
    {
        $wszystko=true;
        
        $idk=$_POST['kodkl'];
        $idp=$_POST['kodpr'];
        $datazam=$_POST['datazam'];
        $ilosc=$_POST['ilosc'];
        
//        if(!is_int($idk))
// {
// $wszystko=false;
// $_SESSION['e_idk']="Zły ID klienta.";
//
// }
//
// if(!is_integer($idp))
// {
// $wszystko=false;
// $_SESSION['e_idp']="Zły ID produktu.";
//
// }
//
// if(!is_integer($ilosc))
// {
// $wszystko=false;
// $_SESSION['e_ilosc']="Wprowadzono błędna ilość.";
//
// }
        
        if (!preg_match('/^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/',$datazam))
        {
            $wszystko=false;
            $_SESSION['e_datazam']="Niepoprawny format daty.";
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
                     
                    if ($polaczenie->query("INSERT INTO zamowienia (DATA_ZAMOW, ID_KLIENT, ID_PRODUKT, ILOSC) VALUES ('$datazam', '$idk', '$idp', '$ilosc')"))
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
    <title>Dodaj zamówienie</title>
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
        <p>Kod klienta: <br /><input type="text" name="kodkl" /><br /></p>
        <?php
            if(isset($_SESSION['e_idk']))
            {
                echo'<div class="error">'.$_SESSION['e_idk'].'</div>';
                unset($_SESSION['e_idk']);
            }
        ?>
        <p> Kod produktu: <br /><input type="text" name="kodpr" /><br /></p>
        <?php
            if(isset($_SESSION['e_idp']))
            {
                echo'<div class="error">'.$_SESSION['e_idp'].'</div>';
                unset($_SESSION['e_idp']);
            }
        ?>
        <p>Data zamówienia: <br /><input type="text" name="datazam" /><br /></p>
        <?php
            if(isset($_SESSION['e_datazam']))
            {
                echo'<div class="error">'.$_SESSION['e_datazam'].'</div>';
                unset($_SESSION['e_datazam']);
            }
        ?>
        <p>Ilość produków: <br /><input type="text" name="ilosc" /><br /></p>
        <?php
            if(isset($_SESSION['e_ilosc']))
            {
                echo'<div class="error">'.$_SESSION['e_ilosc'].'</div>';
                unset($_SESSION['e_ilosc']);
            }
        ?>
        <br />
        <p><input type="submit" value="Dodaj" /></p>


    </form>
    <a href="index.php">
        <h2>Powróć do strony głównej<h2></h2>
    </a>
    <a href="bazak.php">
        <h2>Pokaż baze klientów</h2>
    </a>
    <a href="bazap.php">
        <h2>Pokaż baze produktów</h2>
    </a>
    <a href="bazaz.php">
        <h2>Pokaż baze zamówień</h2>
    </a>
</body>

</html>
