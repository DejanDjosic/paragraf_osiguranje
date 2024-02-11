<?php require('konekcija.php');

unset($_SESSION['id_polise']);

if(isset($_SESSION['id_sesije'])){
if($_SESSION['id_sesije']==='korisnik')
header('Location: index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css'>
</head>

<body>
    <?php include('delovi_stranica/navbar.php'); ?>
    <div class='jumbotron text-center'>
        <h2>Admin panel</h2>
    </div>
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
                <th scope="col">Opcije</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $upit = "SELECT * FROM polisa";
            $rezultat = mysqli_query($baza, $upit);
            while ($red = mysqli_fetch_assoc($rezultat)) : ?>
                <tr>
                    <th scope="row"><?php echo $red['id']; ?></th>
                    <td><?php echo $red['datum_kreiranja']; ?></td>
                    <td><?php echo $red['nosilac_ime']; ?></td>
                    <td><?php echo $red['nosilac_prezime']; ?></td>
                    <td><?php echo $red['datum_rodjenja']; ?></td>
                    <td><?php echo $red['broj_pasosa']; ?></td>
                    <td><?php echo $red['telefon']; ?></td>
                    <td><?php echo $red['email']; ?></td>
                    <td><?php echo $red['datum_putovanja_od']; ?></td>
                    <td><?php echo $red['datum_putovanja_do']; ?></td>
                    <td><?php echo $red['broj_dana']; ?></td>
                    <td><?php echo $red['vrsta_polise']; ?></td>
                    <td>
                        <?php if ($red['vrsta_polise'] === 'grupno'): ?> <form action='prikaz_dodatnih.php' method='post'><input type='hidden' name='id_polise' value='<?php echo $red['id']; ?>'><button class='btn btn-info form-control' name='submit'>Pregled grupnog osiguranja</button></form>
                            <?php endif?>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</body>

</html>