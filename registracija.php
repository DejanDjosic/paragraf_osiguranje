<?php
function proveraPunoletnosti($datum_rodjenja)
{
    $razlika = date_diff(date_create($datum_rodjenja), date_create(date('Y-m-d')));
    if ($razlika->y < 18)
        return false;
    else
        return true;
}

function proveraPostojecegMejla($baza, $email)
{
    $rezultat = mysqli_query($baza, "SELECT * FROM korisnik where email='$email'");
    $broj_redova = mysqli_num_rows($rezultat);
    if ($broj_redova > 0)
        return false;
    else
        return true;
}

if (isset($_POST['submit'])) {
    require('konekcija.php');


    $ime_regex = "/^[A-Z]{1}[a-z]{2,23}$/";
    $email_regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $pasos_regex = "/^[0-9]{9}$/";
    $telefon_regex = "/^(\+3816|06)(([0-6]|[8-9])\d{6,7}|(77|78)\d{5,6})$/";


    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $datum_rodjenja = $_POST['datum_rodjenja'];
    $broj_pasosa = $_POST['broj_pasosa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $lozinka = $_POST['lozinka'];
    $potvrda_lozinke = $_POST['potvrda_lozinke'];

    if (empty($ime) || empty($prezime) || empty($datum_rodjenja) || empty($broj_pasosa) || empty($telefon) || empty($email)  || empty($lozinka) || empty($potvrda_lozinke)) {
        header('Location: registracija.view.php?error=praznopolje');
        exit();
    } else {
        if (!preg_match($ime_regex, $ime) || !preg_match($ime_regex, $prezime)) {
            header('Location: registracija.view.php?error=karakteri');
            exit();
        } elseif (!proveraPunoletnosti($datum_rodjenja)) {
            header("Location: registracija.view.php?error=nijepunoletan&ime=$ime&prezime=$prezime");
            exit();
        } elseif (!preg_match($pasos_regex, $broj_pasosa)) {
            header("Location: registracija.view.php?error=pasos&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja");
            exit();
        } elseif (!preg_match($telefon_regex, $telefon)) {
            header("Location: registracija.view.php?error=telefon&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa");
            exit();
        } elseif (!preg_match($email_regex, $email)) {
            header("Location: registracija.view.php?error=email&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa&telefon=$telefon");
            exit();
        } elseif (!proveraPostojecegMejla($baza, $email)) {
            header("Location: registracija.view.php?error=postojeciemail&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa&telefon=$telefon");
            exit();
        } elseif ($lozinka !== $potvrda_lozinke) {
            header("Location: registracija.view.php?error=lozinka&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa&telefon=$telefon&email=$email");
            exit();
        }
    }
    $upit_max_id = "SELECT MAX(id) AS max_id FROM korisnik";
    $rezultat = mysqli_query($baza, $upit_max_id);

    if ($rezultat) {
        $row = mysqli_fetch_assoc($rezultat);
        $id = $row['max_id'] + 1;
    } else {
        echo "Greška pri generisanju najvećeg id-a korisnika: " . mysqli_error($baza);
        exit();
    }

    $salt = "gjsdshkafh";
    $lozinka = sha1($lozinka . $salt);
    $upit = $baza->prepare("INSERT INTO korisnik VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$upit) {
        die('Greška pri pripremi upita: ' . $baza->error);
    }
    $upit->bind_param("isssssss", $id, $ime, $prezime, $datum_rodjenja, $broj_pasosa, $telefon,  $email, $lozinka);
    $rezultat = $upit->execute();
    if (!$rezultat) {
        die('Greška pri izvršavanju upita: ' . $upit->error);
    }
    $upit->close();
    header('Location: login.view.php');
} else
    header('Location: registracija.view.php');
