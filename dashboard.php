<?php
$host ="localhost";
$database="hacker-poulette";
$username="root";
$password="";

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $client_id = $_POST['client_id'];

    $stmtDelete = $pdo->prepare("DELETE FROM client WHERE PersonID = ?");
    $stmtDelete->execute([$client_id]);
}

$stmt = $pdo->prepare("SELECT * FROM client");
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-sky-500 to-emerald-500 min-h-screen flex items-center justify-center">
<div class="w-full max-w-3xl p-4 bg-white rounded-lg shadow-md">
<div class="w-full max-w-3xl p-4 bg-white rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-center pr-80 mb-0">Tableau de bord</h1>
            <a href="http://hackers-poulette.test/" class="ml-auto">
                <button class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Redirection</button>
            </a>
        </div>
        <table class="w-full border-collapse border border-gray-400">
            <thead>
                <tr class="bg-blue-100">
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">First Name</th>
                    <th class="py-2 px-4 border">Last Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Description</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td class="py-2 px-4 border"><?php echo $client['PersonID']; ?></td>
                        <td class="py-2 px-4 border"><?php echo $client['FirstName']; ?></td>
                        <td class="py-2 px-4 border"><?php echo $client['LastName']; ?></td>
                        <td class="py-2 px-4 border"><?php echo $client['email']; ?></td>
                        <td class="py-2 px-4 border"><?php echo $client['description']; ?></td>
                        <td class="py-2 px-4 border">
                            <form method="post">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="client_id" value="<?php echo $client['PersonID']; ?>">
                                <button type="submit" class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
