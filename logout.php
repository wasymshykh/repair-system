<?php 

require_once 'app/start.php';

$Users->logout();
message_move('success', 'Logged out successfully', 'login.php');

