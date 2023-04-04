<?php
require_once('connect.php');

class Gder
{
    private array $columns;
    private string $table = 'pac';

    /**
     * Create a new user
     *
     * @param array $values
     * @return boolean
     */

    public function user($values)
    {
        //$values['password'] = password_hash($values['password'], PASSWORD_DEFAULT);
        try {
            $query = $this->$dbh->prepare('INSERT INTO gderps(nom, prenom, nom_entreprise, code_postal, telephone, email, service) VALUES(:nom, :prenom, :nom_entreprise, :code_postal, :telephone, :email, :service)');
            return $query->execute(/*$this->filter*/($values));
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage() . "<br>";
            return false;
        }
    }
}