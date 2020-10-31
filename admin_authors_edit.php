<?php

    include 'app/connect.php';

    
    if( !empty($_POST) ) {

        $query = $pdo->prepare(
        'UPDATE `author` 
         SET `FirstName`=?,`LastName`=?
         WHERE `Id`=?
        ');
  
        $query->execute( array($_POST['firstname'], $_POST['lastname'], $_POST['id']));
        $query->bindParam(':firstname', $_POST['firstname']);
    
        // Redirection vers la page de le dashboard de l'admin
        header('Location: admin_authors_index.php');
        exit();
      }

    if( !array_key_exists('id', $_GET) OR !ctype_digit($_GET['id']) ) {
        header('Location: admin_authors_index.php');
        exit();
      }

      $query = $pdo->prepare(
        ' SELECT author.Id, FirstName, LastName
            FROM author
            WHERE author.Id = ?
            -- WHERE author.Id = :id
        ');
        $query ->execute( array($_GET['id']) );
        // $query ->execute( array('id' => $_GET['id']) );

        $author = $query->fetch();
        $query->closeCursor();

        if( empty($author) ) {
            header('Location: admin_authors_index.php');
            exit();
          }

    $title = 'Modifier un auteur';
    $template = 'admin_authors_edit';
    include './layout.phtml';