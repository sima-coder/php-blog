<?php
include 'app/connect.php';

/*
    BONUS : REQUETE COMPLEXE

    Lister les catégories
      (Y COMPRIS LES CATÉGORIES SANS ARTICLE)
      et afficher le total des articles de la catégorie

    https://sql.sh/fonctions/agregation/count

    https://sql.sh/cours/group-by

    https://sql.sh/cours/jointures/left-join


  */
  $query = $pdo -> prepare
  (
  '
    SELECT
      category.Id AS Id,
      Name,
      COUNT(Category_Id) AS Total
    FROM
      category
    LEFT JOIN
      post ON category.Id = Category_Id
    GROUP BY category.Id
  '
  );

  $query->execute();
  $categories = $query->fetchAll();

$title = 'Gestion des catégories';
$template = 'admin_categories_index';
include 'layout.phtml';
