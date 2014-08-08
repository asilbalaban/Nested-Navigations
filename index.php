<?php

    # SET LINK
    define('BASE_URL', 'http://localhost/nestednavigations/');

    # Include database class
    include 'vendor/php/MysqliDb.php';

    # Connect DB
    $db = new Mysqlidb ('localhost', 'root', '', 'nestednavigations');

    include 'theme/index.php';