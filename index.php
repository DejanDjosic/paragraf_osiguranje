<?php require('konekcija.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Paragraf Lex</title>
</head>

<body>
    <?php require('delovi_stranica/navbar.php');

    ?>
    <div class='jumbotron text-center'>
        <h2>Putno osiguranje</h2>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-6 offset-3'>
                <form action='individualno_osiguranje.php' method='post'>
                    <label for='ime'>Ime:</label><br>
                    <input type="text" name='ime' id='ime' class="form-control mb-2" placeholder="Unesite Vaše ime..." required value=<?php if (isset($_GET['ime'])) echo $_GET['ime'];elseif (isset($_SESSION['ime'])) echo $_SESSION['ime'];  ?> >
                    <label for='prezime'>Prezime:</label><br>
                    <input type="text" name='prezime' id='prezime' class="form-control mb-2" placeholder="Unesite Vaše prezime..." required value=<?php if (isset($_GET['prezime'])) echo $_GET['prezime'];elseif (isset($_SESSION['prezime'])) echo $_SESSION['prezime'];  ?> >
                    <label for='datum_rodjenja'>Datum rođenja:</label><br>
                    <input type="date" id="datum" name="datum_rodjenja" pattern="\d{2}-\d{2}-\d{4}" class="form-control" required value=<?php if (isset($_GET['datum_rodjenja'])) echo $_GET['datum_rodjenja'];elseif (isset($_SESSION['datum_rodjenja'])) echo $_SESSION['datum_rodjenja'];  ?> >
                    <label for='broj_pasosa'>Broj pasoša:</label>
                    <input type="text" name='broj_pasosa' id='broj_pasosa' class="form-control mb-2" placeholder="Unesite Vaš broj pasoša..." value=<?php if (isset($_GET['broj_pasosa'])) echo $_GET['broj_pasosa']; elseif (isset($_SESSION['broj_pasosa'])) echo $_SESSION['broj_pasosa']; ?>>
                    <label for='telefon'>Telefon:</label>
                    <input type="tel" name='telefon' class="form-control mb-2" placeholder="Unesite Vaš broj telefona..." value=<?php if (isset($_GET['telefon'])) echo $_GET['telefon'];  elseif (isset($_SESSION['telefon'])) echo $_SESSION['telefon']; ?>>
                    <label for='email'>E-mail adresa:</label>
                    <input type="email" name='email' class="form-control mb-2" placeholder="Unesite Vašu E-mail adresu..." required value=<?php if (isset($_GET['email'])) echo $_GET['email'];  elseif (isset($_SESSION['email'])) echo $_SESSION['email']; ?>>
                    <label for='datod'>Datum OD:</label>
                    <input type="date" id='datum' name='datod' class="form-control" value=<?php if (isset($_GET['datod'])) echo $_GET['datod'];  ?>>
                    <label for='datdo'>Datum DO:</label>
                    <input type="date" id='datum' name='datdo' class="form-control" value=<?php if (isset($_GET['datdo'])) echo $_GET['datdo'];  ?>>
                    <label for="vrsta_polise">Odabir vrste polise osiguranja:</label><br>
                    <select id="vrsta_polise" name="vrsta_polise" class='form-control mb-2'>
                        <option value="individualno">Individualno</option>
                        <option value="grupno">Grupno</option>
                    </select>
                    <a href='registracija.view.php'>Želite da se registrujete?</a>
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
                        echo "<p class='error mt-2'>Morate biti punoletni kako biste napravili polisu</p>";
                        exit();
                    } elseif ($error == 'pasos') {
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format broja pasoša</p>";
                        exit();
                    } elseif ($error == 'email') {
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format E-mail adrese</p>";
                        exit();
                    } elseif ($error == 'datum') {
                        echo "<p class='error mt-2'>Molimo Vas izaberite validno trajanje važenja osiguranja</p>";
                        exit();
                    }
                    elseif($error=='telefon'){
                        echo "<p class='error mt-2'>Molimo Vas unesite pravilan format broja telefona (počevši sa +381 ili 06)</p>";
                    
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>