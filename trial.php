<?php

require_once 'src/database.php';
$query = 'select * from admins';
$data = db_select($query);
echo $data[0]['username'].$data[0]['password'];
