<?php
session_start();
unset($_SESSION["UserID"]);
echo "
<script>
window.location='index.html'
</script>";
