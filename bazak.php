<?php

    session_start();
    require_once "connect.php";
    $wszystko=true;
        
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
                     
                    if ($z=$polaczenie->query("SELECT * FROM klienci"))
                    {
                        $i=1;
                        while ($r = $z->fetch_array())
                        {
                            echo "<div><p>".$i.". ID KLIENTA: ".$r[0].", IMIĘ: ".$r[1].", NAZWISKO: ".$r[2].", ADRES: ".$r[3].", DATA URODZENIA: ".$r[4]."</p></div>";
                            $i=$i+1;
                        }
                        $z->free();
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

?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge, chrome=1" />
    <title>Gratulacje!</title>
    <style>
        p {
            font-size: 20px;
            font-family: sans-serif;
        }

        a {
            color: darkcyan;
            font-size: 10px;
            text-decoration: none;
            font-family: sans-serif;
        }

        a:hover {
            color: darkblue;
        }

        div: {
            border: solid 4px blue;
            background-color: azure;
        }

    </style>
</head>

<body>

    <br /> <br />
    <a href="index.php">
        <h2>Powróć do strony głównej<h2></h2>
    </a>
    <a href="klient.php">
        <h2>Powróć do dodania klienta</h2>
    </a>
    <a href="zamowienie.php">
        <h2>Powróć do dodania zamówienia</h2>
    </a>




</body>

</html>
