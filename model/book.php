<?php

include_once "./utils/bdd.php";

function addBook(string $title, string $description,string $author,string $idCategory,string $user): void{
    try {
        $request = "INSERT INTO book(title, description, author, id_category, id_users) VALUE (?,?,?,?,?)";
        //prépararation de la requête
        $req = connectBDD()->prepare($request);
        //bind param
        $req->bindParam(1, $title, \PDO::PARAM_STR);
        $req->bindParam(2, $description, \PDO::PARAM_STR);
        $req->bindParam(3, $author, \PDO::PARAM_STR);
        $req->bindParam(4, $idCategory, \PDO::PARAM_STR);
        $req->bindParam(5, $user, \PDO::PARAM_STR);
        //éxécution de la requête
        $req->execute();
    } catch(\Exception $e) {
        throw new \Exception($e->getMessage());
    }
}

function findAllBooks(): array {
    try {
        $request = "SELECT b.id_book, b.title, b.description, b.publication_date, b.author, b.id_category, b.id_users, category.name, users.id_users FROM book AS b INNER JOIN category ON b.id_category = category.id_category INNER JOIN users ON b.id_users = users.id_users";
        $req = connectBDD()->prepare($request);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
}
