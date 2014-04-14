<!DOCTYPE html>
<html>
<head>
<title>Generate a password hash</title>
<!-- debug alat, ne mislim zapravo ovo koristit u finalnoj verziji -->
</head>
<body>
<?php if(isset($_POST)){ echo crypt($_POST['password'],$_POST['salt']);}  ?>
<form action="genpass.php" method="post">
<input name="password" type="password" placeholder="Password">
<input name="salt" type="text" placeholder="Salt">
<input type="submit" value="Generate a hash">
</form>
</body>
</html>
