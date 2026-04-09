<?php
session_start();
session_unset();
session_destroy();

setcookie('remember_user', '', time() - 3600, '/');
setcookie('theme', '', time() - 3600, '/');

header('Location: index.php');
exit();
?>
