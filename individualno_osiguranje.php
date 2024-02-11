<?php
require('konekcija.php');

function proveraPunoletnosti($datum_rodjenja)
{
    $razlika = date_diff(date_create($datum_rodjenja), date_create(date('Y-m-d')));
    if ($razlika->y < 18)
        return false;
    else
        return true;
}

function proveraDatuma($datod, $datdo)
{

    if ($datod > $datdo) {
        return false;
    } else {
        $datod = strtotime($datod);

        $danasnji_datum = time();
        if ($datod < $danasnji_datum)
            return false;
    }
    return true;
}

function trajanjePolise($datod, $datdo)
{
    $razlika = date_diff(date_create($datod), date_create($datdo));
    return $razlika->d;
}

if (isset($_POST['submit'])) {
    $ime_regex = "/^[A-Z]{1}[a-z]{2,23}$/";
    $email_regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    $pasos_regex = "/^[0-9]{9}$/";
    $telefon_regex = "/^(\+3816|06)(([0-6]|[8-9])\d{6,7}|(77|78)\d{5,6})$/";


    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $datum_rodjenja = $_POST['datum_rodjenja'];
    $broj_pasosa = $_POST['broj_pasosa'];
    $email = $_POST['email'];
    $datod = $_POST['datod'];
    $datdo = $_POST['datdo'];
    $vrsta_polise = $_POST['vrsta_polise'];
    if (isset($_POST['telefon']))
        $telefon = $_POST['telefon'];
    else
        $telefon = "";

    if (empty($ime) || empty($prezime) || empty($datum_rodjenja) || empty($broj_pasosa) || empty($email) || empty($datod) || empty($datdo) || empty($vrsta_polise)) {
        header('Location: index.php?error=praznopolje');
        exit();
    } else {
        if (!preg_match($ime_regex, $ime) || !preg_match($ime_regex, $prezime)) {
            header('Location: index.php?error=karakteri');
            exit();
        } elseif (!proveraPunoletnosti($datum_rodjenja)) {
            header("Location: index.php?error=nijepunoletan&ime=$ime&prezime=$prezime");
            exit();
        } elseif (!preg_match($pasos_regex, $broj_pasosa)) {
            header("Location: index.php?error=pasos&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja");
            exit();
        } elseif (!empty($telefon) && !preg_match($telefon_regex, $telefon)) {
            header("Location: index.php?error=telefon&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa");
            exit();
        } elseif (!preg_match($email_regex, $email)) {
            if (!empty($telefon))
                header("Location: index.php?error=email&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa&telefon=$telefon");
            else
                header("Location: index.php?error=email&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa");

            exit();
        } elseif (!proveraDatuma($datod, $datdo)) {
            if (!empty($telefon))
                header("Location: index.php?error=datum&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa&telefon=$telefon&email=$email");
            else
                header("Location: index.php?error=datum&ime=$ime&prezime=$prezime&datum_rodjenja=$datum_rodjenja&broj_pasosa=$broj_pasosa&email=$email");
            exit();
        }
    }



    $broj_dana = trajanjePolise($datod, $datdo);
    $trenutni_datum = date("Y-m-d");


    $upit_max_id = "SELECT MAX(id) AS max_id FROM polisa";
    $rezultat = mysqli_query($baza, $upit_max_id);


    if ($rezultat) {
        $row = mysqli_fetch_assoc($rezultat);
        $id = $row['max_id'] + 1;
    } else {
        echo "Greška pri generisanju najvećeg id-a polise: " . mysqli_error($baza);
        exit();
    }


    $_SESSION['email'] = $email;

    $upit = $baza->prepare("INSERT INTO polisa VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$upit) {
        die('Greška pri pripremi upita: ' . $baza->error);
    }
    $upit->bind_param("isssssssssis", $id, $trenutni_datum, $ime, $prezime, $datum_rodjenja, $broj_pasosa, $telefon, $email, $datod, $datdo, $broj_dana, $vrsta_polise);
    $rezultat = $upit->execute();
    if (!$rezultat) {
        die('Greška pri izvršavanju upita: ' . $upit->error);
    }
    $upit->close();

    if ($vrsta_polise === 'individualno')
        header('Location: zahvaljujemo_se.php');
    elseif ($vrsta_polise === 'grupno') {

        header("Location: dodatni_osiguranik.php?id_polise=$id");
    }
} else {
    header('Location: index.php');
}
