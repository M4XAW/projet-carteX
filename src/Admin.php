<?php 
require_once 'config.php';

class CarteManager
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function createCarte(Carte $carte) {
        $this->pdo->exec('');
    }
    public function getCarteById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cards WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $carte = $stmt->fetch(PDO::FETCH_ASSOC);
        return $carte;
    }
    public function deleteCarte(Carte $carte) {
        $this->pdo->exec('');
        $stmt = $this->pdo->prepare('DELETE FROM cards WHERE id = :id');
        $stmt->execute(['id' => $carte->getId()]);
        $carte = $stmt->fetch(PDO::FETCH_ASSOC);
        return $carte;

    }
    public function updateCarte(Carte $carte) {
        $this->pdo->exec('');
        $stmt = $this->pdo->prepare(" UPDATE FROM cards WHERE id = :id");
        $stmt->execute(['id' => $carte->getId()]);
        $carte = $stmt->fetch(PDO::FETCH_ASSOC);
        return $carte;
    }

}


