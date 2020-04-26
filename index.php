<?php

    session_start();

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge, chrome=1" />
    <title>Sklep</title>
    <style>
        section {
            width: 800px;
            margin: 50px auto 0 auto;
        }

        h1 {
            color: crimson;
            text-align: center;
            font-family: sans-serif;
            font-size: 30px;
        }

        h2 {
            color: darksalmon;
            text-align: center;
            text-decoration: none;
            font-size: 30px;
            font-family: arial, sans-serif;
            margin: 10px;
        }

        h2:hover {
            color: darkred;
        }

        a {
            text-decoration: none;
        }

        section {
            background-color: beige;
            border: solid 4px red;

        }

    </style>
</head>

<body>
    <section>
        <h1>Witaj! Co chcesz zrobic?</h1><br />
        <br />
        <a href="klient.php">
            <h2>Dodaj klienta</h2>
        </a>
        <a href="produkt.php">
            <h2>Dodaj produkt</h2>
        </a>
        <a href="zamowienie.php">
            <h2>Wprowadź zamówienie</h2>
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
        <a href="podsumowanie.php">
            <h2>Podsumowanie zamówień</h2>
        </a>
        <a href="rachunki.php">
            <h2>Rachunki</h2>
        </a>
    </section>


</body>

</html>
