<?php 
namespace otazkyodpovede;

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/config.php');

use PDO;
use PDOException;

class QnA {
    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $config = DATABASE;

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            $this->conn = new PDO(
                'mysql:host='.$config['HOST'].';dbname='.$config['DBNAME'].';port='.$config['PORT'],
                $config['USER_NAME'],
                $config['PASSWORD'],
                $options
            );
        } catch (PDOException $e) {
            die("Chyba pripojenia: " . $e->getMessage());
        }
    }

    public function readQnA() {
        try {
            
            // vytvorenie aj poslanie prikazu "SELECT" ktory vypiše otazky aj odpovede k nim
            $sql = "SELECT otazka, odpoved FROM otazky";
            $stmt = $this->conn->prepare($sql); 
            $stmt->execute();

            // konvertovanie vystupu prikazu SELECT z tabuľky otazok do array v PHP
            $results = $stmt->fetchAll();

            // vytvorenie prvkov v akordeone aj použivanie udajov z DB

            foreach ($results as $row) {
                echo '<div class="accordion">';
                echo '<div class="question">' . htmlspecialchars($row['otazka']) . '</div>';
                echo '<div class="answer">' . htmlspecialchars($row['odpoved']) . '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Chyba pri načítaní dát: " . $e->getMessage();
        }
    }
}
?>





