<?php
require('konekcija.php');
if (!isset($_POST['id_polise']))
    header('Location: admin_panel');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css'>
    <title>Pregled polise</title>
</head>
<?php include('delovi_stranica/navbar.php'); ?>
<div class='jumbotron text-center'>
    <h2>Admin panel</h2>
</div>
<h3 class="mb-3 ml-3">Izabrana polisa:</h3>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">Datum kreiranja polise</th>
            <th scope="col">Ime nosioca</th>
            <th scope="col">Prezime nosioca</th>
            <th scope="col">Datum rođenja</th>
            <th scope="col">Broj pasoša</th>
            <th scope="col">Telefon</th>
            <th scope="col">E-mail</th>
            <th scope="col">Datum OD</th>
            <th scope="col">Datum DO</th>
            <th scope="col">Trajanje polise</th>
            <th scope="col">Vrsta polise</th>
        </tr>
    </thead>
    <?php

    $id_polise = $_POST['id_polise'];

    $upit = "SELECT * FROM polisa WHERE id='$id_polise'";
    $rezultat = mysqli_query($baza, $upit);
    if (!$rezultat) {
        echo "Greška u pronalaženju polise u bazi.";
        exit();
    } else {
        $red = mysqli_fetch_assoc($rezultat);
        foreach ($red as $kolona => $vrednost) {
            echo "<td>$vrednost</td>";
        }
    }
    ?>
    <tbody>

    </tbody>
</table>
<div class='container'>
    <div class='row'>
        <div class='col-6 offset-3'>
            <h3 class="mt-5 text-center">Dodatni osiguranici:</h3>

            <table class="table rounded">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <th scope="col">Datum rođenja</th>
                        <th scope="col">Broj pasoša</th>

                    </tr>
                </thead>
                <tbody>
                    <?php


                    $upit_dodatni = "SELECT * FROM dodatni_osiguranik WHERE id_polise='$id_polise'";
                    $rezultat_dodatni = mysqli_query($baza, $upit_dodatni);
                    if (!$rezultat_dodatni)
                        echo "Greška u pronalaženju polise u bazi.";
                    else {
                        while ($red = mysqli_fetch_assoc($rezultat_dodatni))
                            echo "<tr>
                            <td>" . $red['id'] . "</td>
                            <td>" . $red['ime'] . "</td>
                            <td>" . $red['prezime'] . "</td>
                            <td>" . $red['datum_rodjenja'] . "</td>
                            <td>" . $red['broj_pasosa'] . "</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php if ($_SESSION['id_sesije'] === 'admin') : ?>
                <a href='admin_panel.php'>Povratak na admin panel</a>
            <?php else : ?>
                <a href='profil.php'>Povratak na pregled svih polisi</a>
            <?php endif ?>
        </div>
    </div>
</div>
</body>

</html>