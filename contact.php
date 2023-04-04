<?php
require_once('connect.php');
require_once('Gder.php');


$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Codition Name
    if (empty($_POST['name'])) {
        $errors['name'] = 'Le champ "Nom" est obligatoire';
    }

    if (mb_strlen($_POST['name']) > 255) {
        $errors['lenght_name'] = 'La chaîne de caractère est trop longue';
    }
    //Codition Firts Name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'Le champ "Prénom" est obligatoire';
    }

    if (mb_strlen($_POST['first_name']) > 255) {
        $errors['lenght_first_name'] = 'La chaîne de caractère est trop longue';
    }

    //Codition adress
    if (empty($_POST['address'])) {
        $errors['address'] = 'Le champ "Adresse" est obligatoire';
    }

    if (mb_strlen($_POST['address']) > 255) {
        $errors['lenght_address'] = 'La chaîne de caractère est trop longue';
    }

    //Codition Code postal
    if (empty($_POST['postal_code'])) {
        $errors['postal_code'] = 'Le champ "Code postal" est obligatoire';
    }

    if (!preg_match("~^\d{5}$~", $_POST['postal_code'])) {
        $errors['lenght_postal_code'] = "Le code postal n'est pas conforme";
    }

    //Codition Ville
    if (empty($_POST['town'])) {
        $errors['town'] = 'Le champ "Ville" est obligatoire';
    }

    if (mb_strlen($_POST['town']) > 255) {
        $errors['lenght_town'] = "La chaîne de caractère est trop longue";
    }

    //Codition email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Le champ "E-mail" est obligatoire';
    }

    if (mb_strlen($_POST['email']) > 255) {
        $errors['lenght_email'] = "La chaîne de caractère est trop longue";
    }

    if (!preg_match("~^.+@.+\..+$~", $_POST['email'])) {
        $errors['preg_email'] = "l'e-mail est non conforme";
    }

    //Codition Password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Le champ "Password" est obligatoire';
    }

    if (mb_strlen($_POST['password']) > 255) {
        $errors['lenght_password'] = "La chaîne de caractère est trop longue";
    }

    if(empty($_POST['group_id'])){
        $errors['group_menu'] = "Veuillez sélectionner un groupe";
    }

    if (empty($errors)) {

        $name = $_POST['name'];
        $first_name = $_POST['first_name'];
        $address = $_POST['address'];
        $postal_code = $_POST['postal_code'];
        $town = $_POST['town'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $group_id = $_POST['group_id'];

        /*$insertUser = $dbh->prepare('INSERT INTO people(name, first_name, address, postal_code, town, email, password,group_id)VALUES(?, ?, ?, ?, ?, ?, PASSWORD(?), ?)');
        $insertUser->execute(array($name, $first_name, $address, $postal_code, $town, $email, $password, $group_id));*/
        $user = new user($dbh);

        //if ($user->validate($_POST) ) {
        $user->create($_POST);
        //}
        header("location:/camille/php/utilisateur/liste-utilisateur.php");
        exit;
    }
}

