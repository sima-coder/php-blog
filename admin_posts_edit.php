<?php

    include 'app/connect.php';

    
    if( !empty($_POST) ) {

        $query = $pdo->prepare(
        ' UPDATE post
            SET
                Title = :title,
                Contents = :contents,
                Category_Id = :category,
                Author_Id = :author,
                CreationTimestamp = NOW()
            WHERE Id = :id
        ');
  
      //   $query->bindParam(':title', $_POST['title']);
      //   $query->bindParam(':contents', $_POST['contents']);
      //   $query->bindParam(':category', $_POST['category']);
      //   $query->bindParam(':author', $_POST['author']);
      //   $query->bindParam(':id', $_POST['id']);
      //   $query->execute();
  
        $query->execute( array(
          'title'     => $_POST['title'],
          'contents'  => $_POST['contents'],
          'category'  => intval($_POST['category']),
          'author'    => intval($_POST['author']),
          'id'        => intval($_POST['id'])
        ));
      
        // Redirection vers la page de le dashboard de l'admin
        header('Location: show_post.php?id='.$_POST['id']);
        exit();
      }

    if( !array_key_exists('id', $_GET) OR !ctype_digit($_GET['id']) ) {
        header('Location: admin_posts_index.php');
        exit();
      }

      $query = $pdo->prepare(
        ' SELECT post.Id, Title, Contents, Category_Id, Author_Id
            FROM post
            WHERE post.Id = ?
            -- WHERE Post.Id = :id
        ');
        $query ->execute( array($_GET['id']) );
        // $query ->execute( array('id' => $_GET['id']) );

        $post = $query->fetch();
        $query->closeCursor();

        if( empty($post) ) {
            header('Location: admin_posts_index.php');
            exit();
          }

          // récupération de la liste des catégories
        $query = $pdo->query('SELECT Id, Name FROM category');
        $categories = $query->fetchAll();

        // Récupération de la liste des auteurs
        $query = $pdo->query('SELECT Id, FirstName, LastName FROM author');
        $authors = $query->fetchAll();

    $title = 'Modifier un article';
    $template = 'admin_posts_edit';
    include './layout.phtml';