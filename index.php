<?php




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> HACkER - POULET !</h1>
<form>
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" required minlength="2" maxlength="255"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" required minlength="2" maxlength="255"><br>
  <label for="pwd">Password:</label><br>
  <input type="password" id="pwd" name="pwd"><br>
  <label for="email">Enter your example.com email:</label><br>
    <input type="email" id="email" pattern=".+@example\.com" size="30" required /><br>
  <label for="description">description (2 to 1000 characters):</label><br>
    <input type="text" id="description" name="description" required minlength="2" maxlength="1000" size="10" /><br>
    <label for="avatar">VOS MEILLEUR IMAGE DE POULET</label><br>
<input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg, image/gif" /><br>

</form>
</body>
</html>