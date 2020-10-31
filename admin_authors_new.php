<?php

        include 'app/connect.php';

        $firstname = '';
        $lastname = '';

        if (!empty($_POST)) {

            $error = array();
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            
            // tester l'existence des erreurs

            // tester le prénom qui ne doit pas être vide
            if (empty($_POST['firstname'])) {
                $error['firstname'] = 'Le prénom est obligatoire';
            }

            // tester le nom qui ne doit pas être vide
            if (empty($_POST['lastname'])) {
                $error['lastname'] = 'Le nom est obligatoire';
            }
            
            if(empty($error))
            {
                $query = $pdo->prepare(
                    'INSERT INTO author(FirstName, LastName)
                    VALUES (?, ?)'
                );
    
                $query->execute(array($_POST['firstname'], $_POST['lastname']));
    
                header('Location: admin_authors_index.php'); 
                exit();
            }
        }
                
        $title = 'Créer un auteur';
        $template = 'admin_authors_new';
        include 'layout.phtml';