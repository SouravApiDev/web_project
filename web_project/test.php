<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
$_SESSION["favcolor"] = "hello";
echo $_SESSION["favcolor"];
echo '<script>sessionStorage.getItem("train_date");</script>';
?>

</body>
</html>