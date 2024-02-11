<?php
require('konekcija.php');

function proveraDatuma($dat_rodj)
{
    $datum_za_proveru = strtotime($dat_rodj);

    $danasnji_datum = time();
    if ($datum_za_proveru > $danasnji_datum)
        return false;
    else
        return true;
}

if (isset($_POST['submit'])&&isset($_GET['id_polise'])) {
    $ime_regex = "/^[A-Z]{1}[a-z]{2,23}$/";
    $pasos_regex = "/^[0-9]{9}$/";

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $datum_rodjenja = $_POST['datum_rodjenja'];
    $broj_pasosa = $_POST['broj_pasosa'];
    $id_polise=$_GET['id_polise'];


    if (empty($ime) || empty($prezime) || empty($datum_rodjenja) || empty($broj_pasosa)) {
        header('Location: dodatni_osiguranik.php?error=praznopolje');
        exit();
    } else {
        if (!preg_match($ime_regex, $ime) || !preg_match($ime_regex, $prezime)) {
            header('Location: dodatni_osiguranik.php?error=karakteri');
            exit();
        } elseif (!proveraDatuma($datum_rodjenja)) {
            header("Location: dodatni_osiguranik.php?error=datum&ime=$ime&prezime=$prezime");
            exit();
        } elseif (!preg_match($pasos_regex, $broj_pasosa)) {
            header("Location: dodatni_osiguranik.php?error=pasos&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja");
            exit();
        }
    }


    $upit_max_id = "SELECT MAX(id) AS max_id FROM dodatni_osiguranik";
    $rezultat = mysqli_query($baza, $upit_max_id);

    if ($rezultat) {
        $row = mysqli_fetch_assoc($rezultat);
        $id = $row['max_id'] + 1;
    } else {
        echo "Greška pri generisanju najvećeg id-a dodatnog osiguranika: " . mysqli_error($baza);
        exit();
    }

    $upit = $baza->prepare("INSERT INTO dodatni_osiguranik VALUES (?, ?, ?, ?, ?, ?)");

    if (!$upit) {
        die('Greška pri pripremi upita: ' . $baza->error);
    }
    $upit->bind_param("issssi", $id, $ime, $prezime, $datum_rodjenja, $broj_pasosa, $id_polise);
    $rezultat = $upit->execute();
    if (!$rezultat) {
        die('Greška pri izvršavanju upita: ' . $upit->error);
    }
    $upit->close();
    if (isset($_POST['jos_jedan_osiguranik'])) {
        header("Location: dodatni_osiguranik.php?id_polise=$id_polise");
    } else {
        header('Location: zahvaljujemo_se.php');
    }
} else
    header('Location: dodatni_osiguranik.php');
