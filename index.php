<?php

$host ="localhost";
$database="hacker-poulette";
$username="root";
$password="";



if (isset($_POST['submit'])) {
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=$database",$username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $password =$_POST['password'];
        $email =$_POST['email'];
        $description =$_POST['description'];
        $file =$_POST['file'];

        $stmt =$pdo->prepare("INSERT INTO client (FirstName,LastName,password,email,description,file) VALUES (?,?,?,?,?,?)");
        $stmt->bindParam(1,$FirstName);
        $stmt->bindParam(2,$LastName);
        $stmt->bindParam(3,$password);
        $stmt->bindParam(4,$email);
        $stmt->bindParam(5,$description);
        $stmt->bindParam(6,$file);

        $stmt->execute();

        echo " All is good bro !";
    } catch (PDOException $exception){
        echo "Error" . $exception->getMessage();
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HACKER - POULET !</h1>
    <form action="" method="post">
        <label for="FirstName">First name:</label><br>
        <br>
        <input type="text" id="FirstName" name="FirstName" required minlength="2" maxlength="255"><br>
        <br>
        <label for="LastName">Last name:</label><br>
        <br>
        <input type="text" id="LastName" name="LastName" required minlength="2" maxlength="255"><br>
        <br>
        <label for="password">Password:</label><br>
        <br>
        <input type="password" id="password" name="password" minlength="6" maxlength="20"><br>
        <br>
        <label for="email">Enter your email:</label><br>
        <br>
        <input type="email" id="email" name="email" size="30" required /><br>
        <br>
        <label for="description">description
 (2 to 1000 characters):</label><br>
<br>
<input type="text" id="description" name="description" required minlength="2" maxlength="1000" size="100" width="500" height="500" /><br>
        <label for="file">VOS MEILLEUR IMAGE DE POULET</label><br>
        <br>
        <input type="file" id="file" name="file" accept="image/png, image/jpeg, image/gif" /><br>
        <br>
        <button type="submit" name="submit">Please Push on me X__X  </button><br>
        <br>
    </form>
</body>
</html>