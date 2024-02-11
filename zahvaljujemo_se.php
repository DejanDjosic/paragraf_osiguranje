<?php require('konekcija.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zahvaljujemo se</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css'>
</head>

<body>
    <?php include('delovi_stranica/navbar.php'); ?>
    <div class='jumbotron text-center'>
        <h2>Hvala Vam što ste se osigurali preko nas.</h2>
        <h3>Poslali smo Vam informacije o Vašoj polisi na <?php echo $_SESSION['email']; ?> </h3>
        <h4 class="mb-3">Srećan put!</h4>
        <a href='index.php'>Povratak na početnu stranicu</a>

    </div>

</body>
<?php
if(!isset($_SESSION['id_sesije']))
unset($_SESSION['email']);?>
</html>