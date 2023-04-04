<?php

try {
    $dbh = new PDO('mysql:host=localhost:3306;dbname=root2;charset=utf8', 'root2', 'root');
    echo "connexion réussie";
} catch (Exception $e) {
    die('Erreur de connexion' . $e->getMessage());
}