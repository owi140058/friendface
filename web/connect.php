<?php
    $host = 'localhost:8889';
    $dbname = 'account';
    $username = "root";
    $password = "root";

    $database_url = getenv('CLEARDB_DATABASE_URL');
    if ($database_url != false) {
        $host = 'HOST';
        $dbname = 'DBNAME';
        $username = "USERNAME";
        $password = "PASSWORD";
    }

    $dsn = "mysql:host=$host;charset=utf8"; // Note: Doesn't include a dbname

    try {
        $pdo = new PDO($dsn, $username, $password);
        // Create the database if necessary
        $statement = $pdo->prepare("CREATE DATABASE IF NOT EXISTS $dbname;");
        $statement->execute();
        $pdo->query("use $dbname;");
        
        // Create the user table if necessary
        $statement = $pdo->prepare("CREATE TABLE IF NOT EXISTS users (
            id int NOT NULL AUTO_INCREMENT,
            name varchar(255),
            email varchar(255),
            avatar_path varchar(255),
            password_hash varchar(32),
            PRIMARY KEY (id)
        );");
        $statement->execute();
        
        // Create the user table if necessary
        $statement = $pdo->prepare("CREATE TABLE IF NOT EXISTS friendships (
            sender_id int,
            receiver_id int,
            accepted int(1),
            PRIMARY KEY (sender_id, receiver_id)
        );");
        $statement->execute();
        
        // Add some users if the table is empty
    $statement = $pdo->prepare("SELECT COUNT(*) FROM users;");
    $statement->execute();
    $numUsers = $statement->fetchColumn();
    if ($numUsers == 0) {
    $sql = "INSERT INTO users (name, email, avatar_path, password_hash)
    VALUES (:name, :email, :avatar_path, :password_hash);";
    $statement = $pdo->prepare($sql);
        
    $statement->bindValue(':name', 'Mark');
    $statement->bindValue(':email', 'mark@facebook.com');
    $statement->bindValue(':avatar_path', '/images/mark.jpg');
    $statement->bindValue(':password_hash', md5('friendface'));
    $statement->execute();
        
    $statement->bindValue(':name', 'Bill');
    $statement->bindValue(':email', 'bill@microsoft.com');
    $statement->bindValue(':avatar_path', '/images/bill.jpg');
    $statement->bindValue(':password_hash', md5('windows'));
    $statement->execute();
        
    $statement->bindValue(':name', 'Tim', PDO::PARAM_STR);
    $statement->bindValue(':email', 'tim@web.com', PDO::PARAM_STR);
    $statement->bindValue(':avatar_path', '/images/tim.png', PDO::PARAM_STR);
    $statement->bindValue(':password_hash', md5('www'), PDO::PARAM_STR);
    $statement->execute();
        
    $statement->bindValue(':name', 'Dennis', PDO::PARAM_STR);
    $statement->bindValue(':email', 'dennis@unix.com', PDO::PARAM_STR);
    $statement->bindValue(':avatar_path', '/images/dennis.jpg', PDO::PARAM_STR);
    $statement->bindValue(':password_hash', md5('c++'), PDO::PARAM_STR);
    $statement->execute();
}
        
    $statement = $pdo->prepare("SELECT COUNT(*) FROM friendships;");
    $statement->execute();
    $numFriendships = $statement->fetchColumn();
    if ($numFriendships == 0) {
        $sql = "INSERT INTO friendships (sender_id, receiver_id, accepted)
            VALUES (:sender_id, :receiver_id, :accepted);";
        $statement = $pdo->prepare($sql);
        
        $statement->bindValue(':sender_id', 2, PDO::PARAM_INT);
        $statement->bindValue(':receiver_id', 1, PDO::PARAM_INT);
        $statement->bindValue(':accepted', 0, PDO::PARAM_INT);
        $statement->execute();
        
        $statement->bindValue(':sender_id', 3, PDO::PARAM_INT);
        $statement->bindValue(':receiver_id', 1, PDO::PARAM_INT);
        $statement->bindValue(':accepted', 0, PDO::PARAM_INT);
        $statement->execute();
        
        $statement->bindValue(':sender_id', 1, PDO::PARAM_INT);
        $statement->bindValue(':receiver_id', 4, PDO::PARAM_INT);
        $statement->bindValue(':accepted', 1, PDO::PARAM_INT);
        $statement->execute();
    }
        
    } catch (PDOException $exception) {
        echo 'Database error: ' . $exception->getMessage();
    } 
?>