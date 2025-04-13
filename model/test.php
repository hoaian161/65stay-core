<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

echo Validate::integer($_GET["val"], -20, 15, 0, 100) ? "OKE" : "DEO";