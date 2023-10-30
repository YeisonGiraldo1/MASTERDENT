<?php
if (!(session_status() === PHP_SESSION_ACTIVE)) {
  session_start();
}

// session_destroy();
$ruta = "..\index.php";
header("Location: $ruta");
exit;
