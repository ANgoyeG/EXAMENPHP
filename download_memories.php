<?php
session_start();
include 'pageconnexion.php';
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'student') {
    header("Location: ACCUEIL.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['memo_id'])) {
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Télécharger des mémoires</title>
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
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Télécharger des mémoires</h1>
        <ul>
            <li><a href="#">Mémoire 1</a></li>
            <li><a href="#">Mémoire 2</a></li>
            <li><a href="#">Mémoire 3</a></li>
        </ul>
    </div>
</body>
</html>