<?php

$server = 'sql302.epizy.com';
$username = 'epiz_31125266';
$password = 'DPt9zHVFAejXNn';
$dbname = 'epiz_31125266_vinylsonline';

$connection = mysqli_connect($server, $username, $password, $dbname);

if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
};
