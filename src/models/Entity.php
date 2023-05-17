<?php
class Entity {
    protected $ename;
    protected $sname;
  
    public function __construct($ename, $sname) {
        $this->ename = $ename;
        $this->sname = $sname;
    }
  
    public function save() {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('INSERT INTO entity (ename, sname) VALUES (?, ?)');
            $stmt->execute([$this->ename, $this->sname]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public static function findByName($ename) {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('SELECT * FROM entity WHERE ename = ?');
            $stmt->execute([$ename]);
            $row = $stmt->fetch();
            if ($row) {
                return new Entity($row['ename'], $row['sname']);
            }
            return null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function update($ename, $sname) {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('UPDATE entity SET ename = ?, sname = ? WHERE ename = ?');
            $stmt->execute([$ename, $sname, $this->ename]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function delete() {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('DELETE FROM entity WHERE id = ?');
            $stmt->execute([$this->ename]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function addProduct($pname, $quantity)
    {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('INSERT INTO entity_product (pname, quantity, ename) VALUES (?, ?, ?)');
            $stmt->execute([$pname, $quantity, $this->ename]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
