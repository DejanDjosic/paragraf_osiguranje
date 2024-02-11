<?php
require('konekcija.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $lozinka = $_POST['lozinka'];


    $salt = "gjsdshkafh";
    $lozinka = sha1($lozinka . $salt);

    $upit = "SELECT * FROM korisnik WHERE email='$email' AND lozinka='$lozinka'";

    $query = mysqli_query($baza, $upit);

    $rezultat = mysqli_fetch_assoc($query);


    if ($rezultat) {
        $_SESSION['korisnik_id'] = $rezultat['id'];
        $_SESSION['ime'] = $rezultat['ime'];
        $_SESSION['prezime'] = $rezultat['prezime'];
        $_SESSION['datum_rodjenja'] = $rezultat['datum_rodjenja'];
        $_SESSION['broj_pasosa'] = $rezultat['broj_pasosa'];
        $_SESSION['telefon'] = $rezultat['telefon'];
        $_SESSION['email'] = $rezultat['email'];
        if ($rezultat['ime'] === 'Admin') {
            $_SESSION['id_sesije'] = 'admin';
            header('Location: admin_panel.php');
        } else {
            $_SESSION['id_sesije'] = 'korisnik';
            header('Location: index.php');
        }
    } else {
        if (empty($email) || empty($lozinka)) {
            header('location: login.view.php?error=praznopolje');
            exit();
        }
        header('location: login.view.php?error=pogresniparametri');
        exit();
    }
} else
    header('Location: login.view.php');
