<?php 

// This file is for redirect from news.pho route like "domain/news.php"

$actual_link =  "/";

//redirect to route "index.get"
header("Location: " . $actual_link, true);
exit;
