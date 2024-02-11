<?php require('konekcija.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registracija</title>
</head>

<body>
    <?php
    require('delovi_stranica/navbar.php');
    ?>
    <div class='jumbotron text-center'>
        <h2>Registracija</h2>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-6 offset-3'>
                <form action='registracija.php' method='post'>
                    <label for='ime'>Ime:</label><br>
                    <input type="text" name='ime' id='ime' class="form-control mb-2" placeholder="Unesite Vaše ime..." value=<?php if (isset($_GET['ime'])) echo $_GET['ime'];  ?>>
                    <label for='prezime'>Prezime:</label><br>
                    <input type="text" name='prezime' id='prezime' class="form-control mb-2" placeholder="Unesite Vaše prezime..." value=<?php if (isset($_GET['prezime'])) echo $_GET['prezime'];  ?>>
                    <label for='datum_rodjenja'>Datum rođenja:</label><br>
                    <input type="date" id="datum" name="datum_rodjenja" class="form-control" value=<?php if (isset($_GET['datum_rodjenja'])) echo $_GET['datum_rodjenja'];  ?>>
                    <label for='broj_pasosa'>Broj pasoša:</label>
                    <input type="text" name='broj_pasosa' id='broj_pasosa' class="form-control mb-2" placeholder="Unesite Vaš broj pasoša ..." value=<?php if (isset($_GET['broj_pasosa'])) echo $_GET['broj_pasosa'];  ?>>
                    <label for='telefon'>Telefon:</label>
                    <input type="tel" name='telefon' class="form-control mb-2" placeholder="Unesite Vaš broj telefona..." value=<?php if (isset($_GET['telefon'])) echo $_GET['telefon']; ?>>
                    <label for='email'>E-mail:</label>
                    <input type="email" name='email' id='email' class="form-control mb-2" placeholder="Unesite Vašu E-mail adresu ..." value=<?php if (isset($_GET['email'])) echo $_GET['email'];  ?>>
                    <label for='password'>Lozinka:</label>
                    <input type='password' name='lozinka' placeholder="Unesite Vašu lozinku..." class="form-control"><br>
                    <label for='potvrda_lozinke'>Potvrda lozinke:</label>
                    <input type='password' name='potvrda_lozinke' placeholder="Potvrdite Vašu lozinku" class="form-control"><br>
                    <a href='login.view.php'>Već imate nalog? Ulogujte se</a>
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
                    } elseif ($error == 'nijepunoletan') {
                        echo "<p class='error mt-2'>Morate biti punoletni kako biste napravili nalog</p>";
                        exit();
                    } elseif ($error == 'pasos') {
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format broja pasoša</p>";
                        exit();
                    } elseif ($error == 'email') {
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format E-mail adrese</p>";
                        exit();
                    } elseif ($error = 'telefon') {
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format broja telefona (počevši sa +381 ili 06)</p>";
                        exit();
                    } elseif ($error = 'postojeciemail') {
                        echo "<p class='error mt-2'>Korisnik sa unetom E-mail adresom već postoji. Molimo Vas unesite drugi E-mail</p>";
                        exit();
                    } elseif ($error == 'lozinka') {
                        echo "<p class='error mt-2'>Molimo Vas unesite lozinke koje se podudaraju</p>";
                        exit();
                    }
                }
                ?>
</body>

</html>