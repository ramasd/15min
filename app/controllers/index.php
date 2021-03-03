<?php

use App\Core\App;

$db = App::get('database');
$articles = $db->selectAll("articles");

require 'app/views/index.view.php';
