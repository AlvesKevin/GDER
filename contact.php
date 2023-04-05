<?php
try {
    $dbh = new PDO('mysql:host=localhost:3306;dbname=root2;charset=utf8', 'root2', 'root');
    echo "connexion réussie";
} catch (Exception $e) {
    die('Erreur de connexion' . $e->getMessage());
}

/*$insertUser = $dbh->prepare('INSERT INTO people(name, first_name, address, postal_code, town, email, password,group_id)VALUES(?, ?, ?, ?, ?, ?, PASSWORD(?), ?)');
$insertUser->execute(array($name, $first_name, $address, $postal_code, $town, $email, $password, $group_id));*/

//$user = new Gder($dbh);

//if ($user->validate($_POST) ) {
//$user->create($_POST);
//}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Codition email
    if (mb_strlen($_POST['email']) > 255) {
        $errors['lenght_email'] = "La chaîne de caractère est trop longue";
    }

    if (!preg_match("~^.+@.+\..+$~", $_POST['email'])) {
        $errors['preg_email'] = "l'e-mail est non conforme";
        echo " mauvais email";
        /*header('Location: index.php');
        exit;*/
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



