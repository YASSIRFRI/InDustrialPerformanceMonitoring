<?php
class Flow {
    protected $fid;
    protected $quantity;
    protected $direction;
    protected $indicator;
    protected $ename;
    protected $pname;

    public function __construct($fid, $quantity, $direction, $indicator, $ename, $pname) {
        $this->fid = $fid;
        $this->quantity = $quantity;
        $this->direction = $direction;
        $this->indicator = $indicator;
        $this->ename = $ename;
        $this->pname = $pname;
    }

    public function save() {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('INSERT INTO flow (fid, quantity, direction, indicator, ename, pname) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$this->fid, $this->quantity, $this->direction, $this->indicator, $this->ename, $this->pname]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function findById($id) {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('SELECT * FROM flow WHERE fid = ?');
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            if ($row) {
                return new Flow($row['fid'], $row['quantity'], $row['direction'], $row['indicator'], $row['ename'], $row['pname']);
            }
            return null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function update() {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('UPDATE flow SET quantity = ?, direction = ?, indicator = ?, ename = ?, pname = ? WHERE fid = ?');
            $stmt->execute([$this->quantity, $this->direction, $this->indicator, $this->ename, $this->pname, $this->fid]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete() {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('DELETE FROM flow WHERE fid = ?');
            $stmt->execute([$this->fid]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function findByEname($ename)
    {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('SELECT * FROM flow WHERE ename = ?');
            $stmt->execute([$ename]);
            $flows = [];
            while ($row = $stmt->fetch()) {
                $flows[] = new Flow($row['fid'], $row['quantity'], $row['direction'], $row['indicator'], $row['ename'], $row['pname']);
            }
            return $flows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public static function findByPname($pname)
    {
        try {
            $connexion = $GLOBALS['connexion'];
            $stmt = $connexion->prepare('SELECT * FROM flow WHERE pname = ?');
            $stmt->execute([$pname]);
            $flows = [];
            while ($row = $stmt->fetch()) {
                $flows[] = new Flow($row['fid'], $row['quantity'], $row['direction'], $row['indicator'], $row['ename'], $row['pname']);
            }
            return $flows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

}

?>