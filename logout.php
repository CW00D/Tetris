<?php
session_start();
session_destroy();
header("Location: http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:51857/index.php");
exit;
?>