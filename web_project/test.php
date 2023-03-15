<?php
$var =" hello data this is sourav ";
function printMessage() {
    echo "Hello World!";
}
?>

<script>
    document.write("<?php printMessage(); echo $var; ?>");
</script>