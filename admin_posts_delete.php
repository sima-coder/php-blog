<?php

    // Tester l'existance de l'id dans l'URL et que c'est bien un entier
    if(!array_key_exists('id', $_GET) || !ctype_digit($_GET['id']))
    {
        header('Location: admin_posts_index.php');
        exit();
    }

    include 'app/connect.php';

    $query = $pdo->prepare(
    '
        DELETE FROM post
        WHERE Id = ?
    '
    );

    $query->execute( array($_GET['id']) );

    header('Location: admin_posts_index.php');
    exit();