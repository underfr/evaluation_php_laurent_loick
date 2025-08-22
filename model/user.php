<?php

include_once "./utils/bdd.php";

function saveUser(string $firstname, string $lastname, string $email, string $password): void  {
    try {
        $request = "INSERT INTO users(firstname, lastname, email, password) VALUE (?,?,?,?)";
        //prépararation de la requête
        $req = connectBDD()->prepare($request);
        //bind param
        $req->bindParam(1, $firstname, \PDO::PARAM_STR);
        $req->bindParam(2, $lastname, \PDO::PARAM_STR);
        $req->bindParam(3, $email, \PDO::PARAM_STR);
        $req->bindParam(4, $password, \PDO::PARAM_STR);
        //éxécution de la requête
        $req->execute();
    } catch(\Exception $e) {
        throw new \Exception($e->getMessage());
    }
}

function isUserByEmailExist(string $email): bool {
    try {
        $request = "SELECT u.id_users FROM users AS u WHERE u.email = ?";
        $req = connectBDD()->prepare($request);
        $req->bindParam(1, $email, \PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
function findUserByEmail(string $email): array {
    try {
        $request = "SELECT u.id_users AS idUser, u.firstname, u.email, u.lastname, u.password FROM users AS u WHERE u.email = ?";
        $req = connectBDD()->prepare($request);
        //assigner le paramètre
        $req->bindParam(1, $email, \PDO::PARAM_STR);
        //exécuter la requête
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_ASSOC);
        return $req->fetch();
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
}
function hashPassword(string $password): string {
    $password = password_hash($password, PASSWORD_DEFAULT);
    return $password;
}
function passwordVerify(string $password, string $hash): bool {
    return password_verify($password, $hash);
}

