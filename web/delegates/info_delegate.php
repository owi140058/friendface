<?php

    function update_info($id, $name, $email) {
        require __DIR__.'/../connect.php';
        
        $sql = "UPDATE users SET name=:name, email=:email WHERE id=:id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->execute();
        
    }

?>