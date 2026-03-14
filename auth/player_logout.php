<?php
require_once __DIR__ . '/../adding/functions.php';
session_start();

unset($_SESSION['player_id']);
unset($_SESSION['player_name']);

redirect('../index.php');
