<?php

include("pds_captcha.php");

$host = "localhost";
$database = "hacker-poulette";
$username = "root";
$password = "";
$adminPassword = "444719";

if (isset($_POST['submit'])) {

    if (!pdscaptcha($_POST)) {
        echo "<script>alert('La réponse au captcha est incorrecte.');</script>";
    } else {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            $userPassword = $_POST['password'];
            $email = $_POST['email'];
            $description = $_POST['description'];
            $file = isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name']) ? file_get_contents($_FILES['file']['tmp_name']) : null;

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $stmt = $pdo->prepare("INSERT INTO client (FirstName, LastName, password, email, description, file) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $FirstName);
                $stmt->bindParam(2, $LastName);
                $stmt->bindParam(3, $userPassword);
                $stmt->bindParam(4, $email);
                $stmt->bindParam(5, $description);
                $stmt->bindParam(6, $file, PDO::PARAM_LOB);
                $stmt->execute();

                $lastInsertedId = $pdo->lastInsertId();
                $stmt = $pdo->prepare("SELECT file FROM client WHERE PersonID = ?");
                $stmt->execute([$lastInsertedId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<script>alert('Formulaire soumis avec succès.');</script>";
            } else {
                echo "<script>alert('Invalid email address, Data not received, you suck!');</script>";
            }
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}


if (isset($_POST['submitAdmin'])) {
    $enteredAdminPassword = $_POST['adminPassword'];

    if ($enteredAdminPassword === $adminPassword) {

        echo "<script>alert('Mot de passe administrateur correct. Redirection vers la page d'administration.');</script>";
        header("Location: http://hackers-poulette.test/dashboard.php");
        exit();
    } else {

        echo "<script>alert('Mot de passe administrateur incorrect.');</script>";
    }
}
echo "<script>";
echo "const adminPassword = '" . $adminPassword . "';";
echo "</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <script defer type="module" src="admin.js"></script>
    <title>Document</title>
</head>
<body class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% ">
<header>
        <form action="" method="post" id="adminForm" class="flex justify-end p-4">
            <input class="bg-blue-100 rounded-md mr-4 pl-4" type="password" id="adminPassword" name="adminPassword" placeholder="Admin password" required><br>
            <button type="submit" name="submitAdmin" class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                El Pouladministrator
            </button>
        </form>
</header>
<div class="container mx-auto p-8">
    <h1 class="text-5xl font-bold text-blue-100 transform hover:rotate-3 transition-transform duration-300 text-center p-8">HACKER - POULET !</h1>
    <form action="" method="post" id="contactForm" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <label for="FirstName">First name:</label><br>
        <br>
        <input class="bg-blue-100 rounded-md" type="text" id="FirstName" name="FirstName" required minlength="2" maxlength="255"><br>
        <br>
        <label for="LastName">Last name:</label><br>
        <br>
        <input class="bg-blue-100 rounded-md" type="text" id="LastName" name="LastName" required minlength="2" maxlength="255"><br>
        <br>
        <label for="password">Password:</label><br>
        <br>
        <input class="bg-blue-100 rounded-md" type="password" id="password" name="password" minlength="6" maxlength="20"><br>
        <br>
        <label for="email">Enter your email:</label><br>
        <br>
        <input class="bg-blue-100 rounded-md" type="email" id="email" name="email" size="30"/><br>
        <br>
        <label for="description" >description
        :</label><br>
        <br>
        <input class="bg-blue-100 rounded-md p-8" type="text" id="description" name="description" required minlength="2" maxlength="1000" placeholder="(2 to 1000 characters)"/><br>
        <br>
        <label for="file">"Vos meilleures images de poulet."</label><br>
        <br>
        <input type="file" id="file" name="file" accept="image/png, image/jpeg, image/gif" /><br>
        <br> 
        <?php echo pdscaptcha("question"); ?>
        <br>
        <button class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800"
         type="submit" name="submit">Please Push on me X__X  </button><br>
         <img src="wing.png" alt="Chicken" class="image">
        <br>
     

    </form>
</div>
  <script defer type="module" src="script.js"></script>
</body>
</html>