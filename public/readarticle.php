<?php 

// This file is for redirect from old article route like "/readarticle.php?article_id=173"

$article_id = ($_GET['article_id']);
$actual_link =  "/readarticle/" . $article_id;

//redirect to route "article.redirect.get"
header("Location: " . $actual_link, true);
exit;
