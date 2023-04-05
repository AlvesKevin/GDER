<?php
try {
    $dbh = new PDO('mysql:host=localhost:3306;dbname=root2;charset=utf8', 'root2', 'root');
} catch (Exception $e) {
    die('Erreur de connexion' . $e->getMessage());
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Codition email
    if (!preg_match("~^.+@.+\..+$~", $_POST['email'])) {
        $errors['preg_email'] = "l'e-mail est non conforme";
    }

    //Code postal
    if (!preg_match("~^\d{5}$~", $_POST['code_postal'])) {
        $errors['lenght_code_postal'] = "Le code postal n'est pas conforme";
    }

    //Code postal
    if (!preg_match("~^\d{10}$~", $_POST['telephone'])) {
        $errors['lenght_telephone'] = "Le numéro de téléphone n'est pas conforme";
    }

    if (empty($errors)){

        try {

            $query_params = array(
                ':nom' => $_POST['nom'],
                ':prenom' => $_POST['prenom'],
                ':nom_entreprise' => $_POST['nom_entreprise'],
                ':code_postal' => $_POST['code_postal'],
                ':telephone' => $_POST['telephone'],
                ':email' => $_POST['email'],
                ':service' => $_POST['service']
            );

            $query = $dbh->prepare('INSERT INTO gderps (nom, prenom, nom_entreprise, code_postal, telephone, email, service) VALUES(:nom, :prenom, :nom_entreprise, :code_postal, :telephone, :email, :service)');
            $query->execute($query_params);
            header('Location: redirectory.html');
            exit;

        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage() . "<br>";
            return false;
        }
    }
}

//exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GDER - Panneaux solaires</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="GDER.css">

</head>
<body>
<nav>
    <div id="left">
        <img src="img/logo-detourre.png" alt="Logo de l'entreprise GDER">
    </div>

    <div id="right">
        <a href="#transition-energetique">
            <div>
                <p>TRANSITION ÉNERGETIQUE</p>
            </div>
        </a>
        <a href="#accompagnement">
            <div>
                <p>ACCOMPAGNEMENT</p>
            </div>
        </a>
        <a href="#services">
            <div>
                <p>NOS SERVICES</p>
            </div>
        </a>
    </div>
</nav>

<header>
    <div id="left-header">
        <h1>PRODUISEZ VOTRE PROPRE ÉNERGIE ET DEVENEZ INDÉPENDANT</h1>
        <p>DIMINUEZ L'IMPACT DE LA HAUSSE DE L'ÉNERGIE ET CHOISISSEZ L'OFFRE LA PLUS ADAPTÉE</p>
        <a href="#services">
            <button>DÉCOUVRIR</button>
        </a>
    </div>

    <div class="right-header">
        <form method="POST" action="index.php">
            <div class="fl">
                <select id="status" name="service">
                    <option value="">SERVICE ... <sup>*</sup></option>
                    <option value="toiture">Panneaux solaires sur toiture</option>
                    <option value="sol">Panneaux solaires au sol</option>
                    <option value="ombriere">Ombrière photovoltaïque</option>
                </select>
            </div>

            <div class="f2pl">
                <input type="text" id="nom" name="nom" placeholder="NOM *" autocomplete="nom" required>

                <input type="text" id="prenom" name="prenom" placeholder="PRENOM *" autocomplete="prenom">
            </div>

            <div class="fl">
                <input type="text" id="nom_entreprise" name="nom_entreprise" placeholder="NOM DE L'ENTREPRISE" autocomplete="nom_entreprise">
            </div>

            <div class="f2pl">
                <input type="text" id="code_postal" name="code_postal" placeholder="CODE POSTAL" autocomplete="code_postal" required>

                <input type="text" id="telephone" name="telephone" placeholder="TELEPHONE *" required>
            </div>

            <div class="f2pl">
                <?php if (isset($errors['lenght_code_postal'])) { ?>
                    <p id="error1"><?php echo $errors['lenght_code_postal']; ?></p>
                <?php } ?>

                <?php if (isset($errors['lenght_telephone'])) { ?>
                    <p id="error2"><?php echo $errors['lenght_telephone']; ?></p>
                <?php } ?>
            </div>


            <div class="fl">
                <label for="email"></label>
                <input type="text" id="email" name="email" placeholder="E-MAIL *" autocomplete="email" required>

                <?php if (isset($errors['preg_email'])) { ?>
                    <p id="error3"><?php echo $errors['preg_email']; ?></p>
                <?php } ?>

            </div>
            <div id="le-buttun-perdu">
                <input type="submit" value="ENVOYER" id="hbutton">
            </div>
        </form>
    </div>
</header>

<div id="transition-energetique">
    <div class="title">
        <h2>TRANSITION ÉNERGÉTIQUE</h2>
        <p>LE BUREAU D’ÉTUDES QUI VOUS ACCOMPAGNE POUR LA TRANSITION ÉNERGETIQUE</p>
    </div>

    <div class="container-card">
        <a href="#services">
            <div id="card1">
                <p>Produisez votre propre électricité verte grâce à une centrale photovoltaïque.</p>
            </div>
        </a>

        <a href="#services">
            <div id="card2">
                <p>Devenez indépendant énergétique de manière compétitive !</p>
            </div>
        </a>

        <a href="#services">
            <div id="card3">
                <p>Choisissez la bonne GTB (Gestion Technique de Bâtiment) pour piloter vos consommations énergetiques et béneficiez d'aides.</p>
            </div>
        </a>

    </div>
</div>

<div id="accompagnement">
    <div class="title">
        <h2>NOTRE ACCOMPAGNEMENT</h2>
        <p>LES ÉTAPES POUR VOUS SUIVRE TOUT AU LONG DE VOTRE PROJET</p>
    </div>

    <div id="container-stage">
        <div class="stage">
            <div>
                <img src="img/validity.png" alt="icon d'un document validé">
                <h3>Validation</h3>
                <p>Un collaborateur prendra contact avec vous pour confirmer votre demande. Vos informations seront ensuite transmises.</p>
            </div>
        </div>

        <div class="stage">
            <div>
                <img src="img/administrator.png" alt="icone d'un employé d'administration devant son ordinateur">
                <h3>Support administratif</h3>
                <p>GDER se charge de toutes les démarches administratives de manière professionnelle et efficace nécessaires. </p>
            </div>
        </div>

        <div class="stage">
            <div>
                <img src="img/solar-panel.png" alt="icon d'un panneau solaire">
                <h3>Travaux et chantier</h3>
                <p>Un expert de notre équipe est contacté pour vous fournir un devis gratuit. Il vous prodiguera des conseils personnalisés pour votre projet.</p>
            </div>
        </div>

        <div class="stage">
            <div>
                <img src="img/interpretation.png" alt="icone d'une personne présentant un graphique">
                <h3>Suivi du projet</h3>
                <p>Avec GDER, bénéficiez d'un accompagnement personnalisé et de garanties tout au long de la durée de vie de votre installation photovoltaïque. </p>
            </div>
        </div>

        <div class="stage">
            <div>
                <img src="img/dollar.png" alt="icone d'un dollar">
                <h3>Optimiser</h3>
                <p>Faites des économies sur le long terme.
                    GDER vous accompagne dans la selection de votre fournisseur d’électricité.
                </p>
            </div>
        </div>
    </div>

    <div id="t">
        <a href="#form">
            <button>ME FAIRE ACCOMPAGNER</button>
        </a>
    </div>
</div>

<div id="services">
    <div class="title">
        <h2>NOS SERVICES</h2>
        <p>INSTALLEZ DÉS MAINTEANT VOS PROPRES PANNEAUX-SOLAIRES</p>
    </div>

    <div class="container-card">
        <div id="card4">
            <div>
                <h3>PANNEAUX SOLAIRES SUR TOITURE</h3>
                <a href="">
                    <button>Découvrir</button>
                </a>
            </div>
        </div>

        <div id="card5">
            <div>
                <h3>PANNEAUX SOLAIRES AU SOL</h3>
                <a href="">
                    <button>Découvrir</button>
                </a>
            </div>
        </div>

        <div id="card6">
            <div>
                <h3>OMBRIÈRE PHOTOVOLTAÏQUE</h3>
                <a href="">
                    <button>Découvrir</button>
                </a>
            </div>
        </div>

    </div>
</div>

<div id="form">
    <div class="title">
        <h2>FORMULAIRE</h2>
        <p>REMPLISSEZ MAINTENANT NOTRE FORMULAIRE AFIN DE NOUS FOURNIR VOS INFORMATIONS ET COMMENCER A CONSTRUIRE VOTRE PROJET</p>
    </div>

    <div id="contact">
        <div id="illustration">
            <h3>DEVENEZ PRODUCTEUR INDÉPENDANT D’ÉLECTRICITE VERTE !</h3>
            <p>Remplissez notre formulaire et installer vos panneaux solaires, réalisez des économies et devenez éco-responsable !</p>
            <img src="img/solar-panel-power.png" alt="image d'un panneau solaire avec des fleurs dessus">
        </div>

        <div id="grey"></div>

        <div id="container-form">
            <form method="POST" action="index.php">
                <div class="fl">
                    <select id="status" name="service">
                        <option value="">SERVICE ... <sup>*</sup></option>
                        <option value="toiture">Panneaux solaires sur toiture</option>
                        <option value="sol">Panneaux solaires au sol</option>
                        <option value="ombriere">Ombrière photovoltaïque</option>
                    </select>
                </div>

                <div class="f2pl">
                    <input type="text" id="nom" name="nom" placeholder="NOM *" autocomplete="nom">

                    <input type="text" id="prenom" name="prenom" placeholder="PRENOM *" autocomplete="prenom">
                </div>

                <div class="fl">
                    <input type="text" id="nom_entreprise" name="nom_entreprise" placeholder="NOM DE L'ENTREPRISE" autocomplete="nom_entreprise">
                </div>

                <div class="f2pl">
                    <input type="text" id="code_postal" name="code_postal" placeholder="CODE POSTAL" autocomplete="code_postal">

                    <input type="text" id="telephone" name="telephone" placeholder="TELEPHONE *">
                </div>

                <div class="fl">
                    <label for="email"></label>
                    <input type="text" id="email" name="email" placeholder="E-MAIL *" autocomplete="email">
                </div>

                <div id="container-fbutton">
                    <input type="submit" value="ENVOYER">
                </div>
            </form>
        </div>

    </div>
</div>

<footer>

</footer>

</body>
</html>
