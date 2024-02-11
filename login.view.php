<?php require('konekcija.php');
if(isset($_SESSION['id_sesije']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Prijava</title>
</head>

<body>
    <?php
    require('delovi_stranica/navbar.php');
    ?>
    <div class='jumbotron text-center'>
        <h2>Prijava</h2>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-6 offset-3'>
                <form action='login.php' method='post'>
                    <label for='email'>E-mail:</label>
                    <input type="email" name='email' id='email' class="form-control mb-2" placeholder="Unesite Vašu E-mail adresu...">
                    <label for='password'>Lozinka:</label>
                    <input type='password' name='lozinka' placeholder="Unesite Vašu lozinku..." class="form-control"><br>
                    <a href='registracija.view.php'>Nemate nalog? Registrujte se</a>
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
                    }elseif($error=='pogresniparametri')
                    {
                        echo "<p class='error mt-2'>Molimo Vas unesite ispravne parametre</p>";
                        exit();
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>