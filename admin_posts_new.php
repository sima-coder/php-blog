<?php

        include 'app/connect.php';

        $titlePost = '';
        $contentPost = '';
        $authorPost = '';
        $categoryPost = '';


        if (!empty($_POST)) {

            $error = array();
            $titlePost = $_POST['title'];
            $contentPost = $_POST['content'];
            $authorPost = $_POST['author'];
            $categoryPost = $_POST['category'];
            
            // tester l'existence des erreurs

            // tester le titre qui ne doit pas être vide
            if (empty($_POST['title'])) {
                $error['title'] = 'Le titre est obligatoire';
            }
            // tester le contenu qui ne doit pas être vide et sa longueur [10, 10000]
            if (empty(trim($_POST['content']))) {
                $error['content'] = 'Le texte est obligatoire';
            } else if (strlen($_POST['content']) > 10000 OR strlen($_POST['content']) < 10) {
                $error['content'] = 'Le texte doit contenir de 10 à 10000 caractères';
            }
            // tester que l'ID de la catégorie est une valeur entière
            if( !intval( $_POST['category'] ) ) {
                $error['category'] = 'Choisir une catégorie';
              }
            // tester que l'ID de l'auteur est une valeur entière
            if( !intval( $_POST['author'] ) ) {
                $error['author'] = 'Choisir un auteur';
              }

            if(empty($error))
            {
                $query = $pdo->prepare(
                   'INSERT INTO `post`(`Title`, `Contents`, `Category_Id`, `Author_Id`, `CreationTimestamp`) 
                    VALUES (?,?,?,?,NOW())'
                );
    
                $query->execute(array($_POST['title'], $_POST['content'], $_POST['category'], $_POST['author']));
    
                header('Location: show_post.php?id='.$pdo->lastInsertId());
                // header('Location: admin_posts_index.php'); // ou bien
                exit();
            }
        }

        // récupération de la liste des catégories
        $query = $pdo->query('SELECT Id, Name FROM category');
        $categories = $query->fetchAll();

        // Récupération de la liste des auteurs
        $query = $pdo->query('SELECT Id, FirstName, LastName FROM author');
        $authors = $query->fetchAll();
                
        $title = 'Créer un article';
        $template = 'admin_posts_new';
        include 'layout.phtml';