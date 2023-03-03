<?php
session_start();
require "connect.php";

$query= $pdo->prepare("SELECT * FROM tab_usuarios WHERE user_id =?");
$query->execute([$user['user-id']]);
$user = $query->fetch();