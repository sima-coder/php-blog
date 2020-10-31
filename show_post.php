<?php

    // Tester l'existance de l'id dans l'URL et que c'est bien un entier
    if(!array_key_exists('id', $_GET) || !ctype_digit($_GET['id']))
    {
        header('Location: index.php');
        exit();
    }

    include 'app/connect.php';

    // Récupération des détails de l'article
    $query = $pdo->prepare(
        'SELECT post.Id, Title, Contents,
            DATE_FORMAT(CreationTimestamp, "%W %e %M %Y") AS DateAjout,
            Name, FirstName, LastName
        FROM post
        INNER JOIN category ON post.Category_Id = category.Id
        INNER JOIN author ON post.Author_id = author.Id
        WHERE post.Id = ?'
    );
    $query->execute(array($_GET['id'])); // $query->execute([$_GET['id']);
    $post = $query->fetch();

    //si ($_GET['id']) n'existe pas dans la table post
    if (empty($post)) {
        header('Location: index.php');
        exit();
    }

    // Récupération des commentaires de l'article
    $query = $pdo->prepare(
        'SELECT NickName, Contents
        FROM comment
        WHERE Post_Id = ?'
    );
    $query->execute(array($_GET['id']));
    $comments = $query->fetchAll();

    $title = $post['Title'];
    $template = 'show_post';
    include 'layout.phtml';