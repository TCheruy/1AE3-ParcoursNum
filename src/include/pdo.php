<?php
class Connexion {
    private $connec;

    public function __construct(){
        $this->connexion();
    }

    private function connexion(){
        try
        {
            $host = '192.168.1.53:3310';
            $db = 'projet';
            $login = 'app';
            $pass = 'test';
            $bdd = new PDO(
                'mysql:host='. $host .';dbname='.$db.';charset=utf8mb4',
                $login,
                $pass
            );
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->connec = $bdd;
        }
        catch (PDOException $e)
        {
            $msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage() . ' Il faut rentrer vos identifiants dans include/pdo.php';
            die($msg);
        }
    }

    /*
     Query sql and fetch all result
    */
    public function q($sql,Array $cond = null){
        $stmt = $this->connec->prepare($sql);

        if($cond){
            foreach ($cond as $v) {
                $stmt->bindParam($v[0],$v[1],$v[2]);
            }
        }

        $stmt->execute();

        return $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt=NULL;
    }

    /*
    Query sql and fetch only first result
    */

    public function qone($sql,Array $cond = null){
        $stmt = $this->connec->prepare($sql);

        if($cond){
            foreach ($cond as $v) {
                $stmt->bindParam($v[0],$v[1],$v[2]);
            }
        }

        $stmt->execute();

        return $stmt->fetch();
        $stmt->closeCursor();
        $stmt=NULL;
    }

    /*
    Execute sql request, used in import.php
    */

    public function execute($sql,Array $cond = null){
        $stmt = $this->connec->prepare($sql);

        if($cond){
            foreach ($cond as $v) {
                $stmt->bindParam($v[0],$v[1],$v[2]);
            }
        }

        $stmt->execute();

        $stmt->closeCursor();
        $stmt=NULL;
    }


}