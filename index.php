<?php

    // Connexion à la BD (fichier à part)
    include 'app/connect.php';
    // Requête SQL pour récupérer les 10 derniers articles
    $query = $pdo->prepare(
        'SELECT
            Post.Id, Title,
            SUBSTRING(Contents, 1, 150) AS SubContents,
            DATE_FORMAT(CreationTimestamp, "%W %e %M %Y") AS DateAjout,
            FirstName, LastName, Name
        FROM post
        INNER JOIN Category ON post.Category_Id = category.Id
        INNER JOIN author ON post.Author_id = author.Id
        ORDER BY CreationTimestamp DESC
        LIMIT 10'
    );
    $query->execute();
    // Récupération du réulstat de la requête
    $posts = $query->fetchAll();
   // var_dump($posts);

    $title = 'Accueil du Blog';
    $template = 'index';
    include 'layout.phtml';