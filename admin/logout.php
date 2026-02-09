<?php
session_start();
session_destroy();
header('Location: /ensol-group/admin/login.php');
exit;
?>
