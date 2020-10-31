<?php

    include 'app/connect.php';

    
    if( !empty($_POST) ) {

        $query = $pdo->prepare(
        'UPDATE `category` 
        SET 
            `Name`=?
             WHERE   `Id`=?
        ');
  
        $query->execute( array($_POST['name'], $_POST['id']));
      
        // Redirection vers le dashboard de l'admin
        header('Location: admin_categories_index.php');
        exit();
    }

    if( !array_key_exists('id', $_GET) OR !ctype_digit($_GET['id']) ) {
        header('Location: admin_categories_index.php');
        exit();
      }

      $query = $pdo->prepare(
        ' SELECT Category.Id, Name
            FROM category
            WHERE category.Id = ?
            -- WHERE Post.Id = :id
        ');
        $query ->execute( array($_GET['id']) );
        // $query ->execute( array('id' => $_GET['id']) );

        $category = $query->fetch();
        $query->closeCursor();

        if( empty($category) ) {
            header('Location: admin_categories_index.php');
            exit();
          }


     

    $title = 'Modifier une catégorie';
    $template = 'admin_categories_edit';
    include './layout.phtml';