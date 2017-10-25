<?php
    // Get all the users who have sent a friend request to the supplied id
    function get_friend_request_users($user_id) {
        require __DIR__.'/../connect.php';
        
        $sql = "SELECT users.*
            FROM users INNER JOIN friendships
            ON users.id = friendships.sender_id
            WHERE friendships.receiver_id = :receiver_id
            AND friendships.accepted = 0;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':receiver_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
        
        $result = $statement->fetchAll();
        return $result;
    }

    function get_friend_users($user_id) {
        require __DIR__.'/../connect.php';
        
    // Friends gained by accepting a request
    $sql = "SELECT users.*
        FROM users INNER JOIN friendships
        ON users.id = friendships.sender_id
        WHERE friendships.receiver_id = :receiver_id
        AND friendships.accepted = 1;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':receiver_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $accept_result = $statement->fetchAll();
        
    // Friends gained by sending a request
    $sql = "SELECT users.*
        FROM users INNER JOIN friendships
        ON users.id = friendships.receiver_id
        WHERE friendships.sender_id = :sender_id
        AND friendships.accepted = 1;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':sender_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $send_result = $statement->fetchAll();
        
    return array_merge($accept_result, $send_result);
    }

    function search_for_users($search) {
        require __DIR__.'/../connect.php';
        
        $search_with_wildcards = '%'.$search.'%';
        
        $statement = $pdo->prepare("SELECT * FROM users WHERE name LIKE :search;");
        $statement->bindValue(':search', $search_with_wildcards, PDO::PARAM_STR);
        $statement->execute();
        
        return $statement->fetchAll();
    }

?>