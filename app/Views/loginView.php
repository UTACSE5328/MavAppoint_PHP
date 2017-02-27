<?php
$content = json_decode($content, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<form action="?c=login&a=check" method="POST">
    Email:<input type="text" name="email"/><br>
    Password:<input type="password" name="password"><br>
    <input type="submit" value="submit">

</form>

</body>
</html>