<?php

if (!empty($_POST['comment'])) {
    include 'app/connect.php';

    // $query = $pdo->prepare(
    //     'INSERT INTO comment(NickName, Contents, CreationTimestamp, Post_id)
    //     VALUES (?, ?, NOW(), ?)'
    // );

    // $query->execute(array($_POST['pseudo'], $_POST['comment'], $_POST['postId']));

    //ou bien
    $query = $pdo->prepare(
        'INSERT INTO comment(NickName, Contents, CreationTimestamp, Post_id)
        VALUES (:pseudo, :comment, NOW(), :id)'
    );

    // $query->execute(array(
    //     'pseudo' => $_POST['pseudo'],
    //     'comment'=> $_POST['comment'],
    //     'id' => $_POST['postId'])
    // );

    $query->bindParam(':pseudo', $_POST['pseudo']);
    $query->bindParam(':comment', $_POST['comment']);
    $query->bindParam(':id', $_POST['postId']);
    $query->execute();


  

    header('Location: show_post.php?id='.$_POST['postId']);
    exit();
}
else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

