<?php require('konekcija.php');
    if(!isset($_GET['id_polise']))
    header('Location: index.php');

    $id_polise=$_GET['id_polise'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodatni osiguranici</title>
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <?php require('delovi_stranica/navbar.php');

    ?>
    <div class='jumbotron text-center'>
        <h2>Putno osiguranje</h2>
        <h4>Molimo Vas unesite dodatne osiguranike polise</h4>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-6 offset-3'>
                <form action="grupno_osiguranje.php?id_polise=<?php echo $id_polise;?>" method='post'>
                    <label for='ime'>Ime:</label><br>
                    <input type="text" name='ime' id='ime' class="form-control mb-2" placeholder="Unesite ime dodatnog osiguranika..." value=<?php if (isset($_GET['ime'])) echo $_GET['ime'];  ?>>
                    <label for='prezime'>Prezime:</label><br>
                    <input type="text" name='prezime' id='prezime' class="form-control mb-2" placeholder="Unesite prezime dodatnog osiguranika..." value=<?php if (isset($_GET['prezime'])) echo $_GET['prezime'];  ?>>
                    <label for='datum_rodjenja'>Datum rođenja:</label><br>
                    <input type="date" id="datum" name="datum_rodjenja" class="form-control" value=<?php if (isset($_GET['datum_rodjenja'])) echo $_GET['datum_rodjenja'];  ?>>
                    <label for='broj_pasosa'>Broj pasoša:</label>
                    <input type="text" name='broj_pasosa' id='broj_pasosa' class="form-control mb-2" placeholder="Unesite broj pasoša dodatnog osiguranika..." value=<?php if (isset($_GET['broj_pasosa'])) echo $_GET['broj_pasosa'];  ?>>
                    <label>Želim da dodam još jednog osiguranika:</label><input type='checkbox' name='jos_jedan_osiguranik'><br>
                    <a href='zahvaljujemo_se.php'>Završili ste sa dodavanjem? Kliknite <u>OVDE</u></a>
                    <button type='submit' name='submit' class='btn btn-info form-control mb-2'>Sačuvaj</button>
                </form>
                <?php
                if (!isset($_GET['error']))
                    exit();
                else {
                    $error = $_GET['error'];
                    if ($error == 'praznopolje') {
                        echo "<p class='error mt-2'>Molimo Vas popunite sva polja</p>";
                        exit();
                    } elseif ($error == 'karakteri') {
                        echo "<p class='error mt-2'>Molimo Vas unesite validne znakove u polje za ime ili prezime</p>";
                        exit();
                    } elseif ($error == 'datum') {
                        echo "<p class='error mt-2'>Molimo Vas unesite validan datum</p>";
                        exit();
                    } elseif ($error == 'pasos') {
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format broja pasoša</p>";
                        exit();
                    }
                    elseif($error='uspesnoubacivanje')
                    echo "<p class='success mt-2'>Uspešno ubačen dodatni osiguranik</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>