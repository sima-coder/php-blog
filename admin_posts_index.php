<?php

    include 'app/connect.php';

    $query = $pdo->prepare(
        'SELECT
            post.Id, Title,
            DATE_FORMAT(CreationTimestamp, "%d/%m/%Y") AS DateAjout,
            FirstName, LastName, Name
        FROM post
        INNER JOIN category ON post.Category_Id = category.Id
        INNER JOIN author ON post.Author_id = author.Id
        ORDER BY Post.Id DESC'
    );

    $query->execute();
    $posts = $query->fetchAll();

    $countPosts = $query->rowCount(); // récupérer le nombre des lignes dans le résultat

    $title = 'Gestion des Articles';    
    $template = 'admin_posts_index';
    include 'layout.phtml';