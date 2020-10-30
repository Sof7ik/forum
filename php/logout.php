<?php
setcookie('user', '', time()-86400, '/');
header('Location: ./../index.php');
?>