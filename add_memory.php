<?php
session_start();
include 'pageconnexion.php';

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ACCUEIL.php");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_memory'])) {
    $memo_title = $_POST['memo_title'];
    $memo_description = $_POST['memo_description'];
    $theme_id = $_POST['theme_id'];
    $domain_id = $_POST['domain_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO Memories (memo_title, memo_description, theme_id, domain_id, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === FALSE) {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    } else {
        $stmt->bind_param("ssiii", $memo_title, $memo_description, $theme_id, $domain_id, $user_id);
        if ($stmt->execute()) {
            echo "Mémoire ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la mémoire : " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une mémoire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Ajouter une mémoire</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="memo_title">Titre :</label><br>
        <input type="text" id="memo_title" name="memo_title"><br>
        <label for="memo_description">Description :</label><br>
        <textarea id="memo_description" name="memo_description"></textarea><br>
        <label for="theme_id">Thème :</label><br>
        <select name="theme_id" id="theme_id">
            <option value="">Sélectionner un thème</option>
            <option value="2">Réseaux informatiques et télécommunications</option>
            <option value="3">Intelligence artificielle et big data</option>
            <option value="4">Sécurité informatique</option>
            <option value="5">La communication comme levier de fidélisation</option>
            <option value="6">Marketing en ligne et budget modéré</option>
            <option value="7">Influenceurs et marketing digital</option>
            <option value="8">Impact de l’agriculture sur la croissance économique</option>
            <option value="9">Durabilité et pratiques agricoles</option>
            <option value="10">Changement climatique et adaptation agricole</option>
        </select><br>
        <label for="domain_id">Domaine :</label><br>
        <select name="domain_id" id="domain_id">
            <option value="">Sélectionner un domaine</option>
            <option value="1">Informatique</option>
            <option value="2">Marketing</option>
            <option value="3">Agriculture</option>
        </select><br>
        <input type="submit" value="Ajouter la mémoire" name="add_memory">
    </form>
</body>
</html>