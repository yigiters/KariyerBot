<?php
session_start();
ob_start();
session_destroy();
echo "Çıkış Yaptınız. Ana Sayfaya Yönlendiriliyorsunuz";
header("Location: ../index.php");
ob_end_flush();
?>