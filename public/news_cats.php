<?php 

// This file is for redirect from news_cats.php route like "domain/news_cats.php" (archiwum)

$actual_link =  "/archive";

//redirect to route "archive.show.get"
header("Location: " . $actual_link, true);
exit;
