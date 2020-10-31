<?php

        include 'app/connect.php';

        $name = '';
      
        if (!empty($_POST)) {

            $error = array();
            $name = $_POST['name'];
            
            // tester l'existence des erreurs

            // tester le nom de la catégorie qui ne doit pas être vide
            if (empty($_POST['name'])) {
                $error['name'] = 'Le nom de la catégorie est obligatoire';
            }
           

            if(empty($error))
            {
                $query = $pdo->prepare(
                    'INSERT INTO category(Name)
                    VALUES (?)'
                );
    
                $query->execute(array($_POST['name']));
    
                header('Location: admin_categories_index.php');
                exit();
            }
        }

        // récupération de la liste des catégories
        $query = $pdo->query('SELECT Id, Name FROM category');
        $categories = $query->fetchAll();

        // Récupération de la liste des auteurs
        $query = $pdo->query('SELECT Id, FirstName, LastName FROM author');
        $authors = $query->fetchAll();
                
        $title = 'Créer une catégorie';
        $template = 'admin_categories_new';
        include 'layout.phtml';