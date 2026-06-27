<?php
try {
    $db = new PDO('sqlite:C:/Users/Dell/ims/database/database.sqlite');
    $stmt = $db->query('SELECT email, password FROM users LIMIT 5');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users, JSON_PRETTY_PRINT);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
