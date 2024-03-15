

<?php
session_start();
include 'pageconnexion.php';
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'student') {
    header("Location: ACCUEIL.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Étudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        p {
            text-align: center;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tableau de bord Étudiant</h1>
        <p>Bienvenue, <?php echo $_SESSION['username']; ?>!</p>
        <a href="search_memories.php">Rechercher des mémoires</a>
        <a href="download_memories.php">Télécharger des mémoires</a>
        <a href="logout.php">Se déconnecter</a>
    </div>
</body>
</html>
