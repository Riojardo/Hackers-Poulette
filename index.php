<?php

include("pds_captcha.php");
include("email-pwd.php");

$host = "localhost";
$database = "hacker-poulette";
$username = "root";
$password ="";
$autorisation_pwd = false;

if (isset($_POST['captcha'], $_SESSION['code'])) {
    $autorisation_capcha = false;
    $autorisation_email = false;
    $autorisation_pwd = false;
    if ($_POST['captcha'] == $_SESSION['code'] && pdscaptcha($_POST)) {
        $autorisation_capcha = true;
        $autorisation_email = false;
        $autorisation_pwd = false;
    } else {
        echo "<p>Le code est incorrect :(</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {
        $autorisation_capcha = false;
        $autorisation_email = false;
        $autorisation_pwd = false;
        $password = $_POST['password'];
        $password_client = $_SESSION['password_client'];
        if ($password === $password_client) {
            echo "Password is correct. Proceed with form submission or other actions.";
            $autorisation_pwd = true;
            $autorisation_capcha = true;
            $autorisation_email = true;
        } else {
            echo "Incorrect password. Please try again.";
        }
    }
}

if (isset($_POST["ALL"])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $password_client =  $_SESSION['password_client'];
        $email =  $_SESSION['email'];
        $description = $_POST['description'];
        if (isset($_FILES['file']['tmp_name']) && !empty($_FILES['file']['tmp_name'])) {
            $file = file_get_contents($_FILES['file']['tmp_name']);
        } else {
            $file = null;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $stmt = $pdo->prepare("INSERT INTO client (FirstName,LastName,password,email,description,file) VALUES (?,?,?,?,?,?)");
            $stmt->bindParam(1, $FirstName);
            $stmt->bindParam(2, $LastName);
            $stmt->bindParam(3, $password_client);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $description);
            $stmt->bindParam(6, $file, PDO::PARAM_LOB);
            $stmt->execute();
            $lastInsertedId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("SELECT file FROM client WHERE PersonID = ?");
            $stmt->execute([$lastInsertedId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "All is good bro!";
            if ($file != null) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['file']) . '"/>';
            }
        } else {
            echo "<script>alert('Invalid email address, Data not receveid ,you suck !');</script>";
        }
    } catch (PDOException $exception) {
        echo "Error: " . $exception->getMessage();
        echo "<br><br><u> We are Sorry this is only a demonstration website <u>";
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
    <form action="" method="post" id="contactForm" enctype="multipart/form-data">
        <?php if (!$autorisation_email && !$autorisation_capcha && !$autorisation_pwd): ?>
            <h1>HACKER - POULET !</h1>
            <section class="capcha">
                <input type="text" name="captcha">

                <img src="image.php" onclick="this.src='image.php?' + Math.random();" alt="captcha" style="cursor:pointer;">

                <?php echo pdscaptcha("question"); ?>
                <input type="submit" name="CAPTCHAS" id="CAPTCHAS">
                <br>
                <br>
                <br>
            </section>
        <?php endif; ?>

        <?php if (!$autorisation_email && $autorisation_capcha && !$autorisation_pwd): ?>

            <section classe="formulaire">

                <label for="email">Enter your email:</label><br>
                <br>
                <input type="email" id="email" name="email" size="30" ><br>
                <input type="submit" name="PWD" id="PWD" value="Envoyer"><br>
            <?php endif; ?>
            <?php if ($autorisation_email && $autorisation_capcha && !$autorisation_pwd): ?>
                <?php echo $_SESSION['password_client']; ?>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" ><br>
                <input type="submit" name="PWD" id="PWD" value="Submit"><br>
            <?php endif; ?>
            <?php if ($autorisation_email && $autorisation_capcha && $autorisation_pwd): ?>
                <label for="FirstName">First name:</label><br>
                <br>
                <input type="text" id="FirstName" name="FirstName" required minlength="2" maxlength="255"><br>
                <br>
                <label for="LastName">Last name:</label><br>
                <br>
                <input type="text" id="LastName" name="LastName" required minlength="2" maxlength="255"><br>
                <label for="description">description
                    (2 to 1000 characters):</label><br>
                <br>
                <input type="text" id="description" name="description" required minlength="2" maxlength="1000" size="100"
                    width="500" height="500" /><br>
                <label for="file">VOS MEILLEUR IMAGE DE POULET</label><br>
                <br>
                <input type="file" id="file" name="file" accept="image/png, image/jpeg, image/gif" /><br>
                <br>
                <br>
                <button type="submit" name="ALL" id="ALL">Please Push on me X__X</button><br>
                <br>
            </section>
        <?php endif; ?>
    </form>
</body>
<script defer type="module" src="script.js"></script>
</html>