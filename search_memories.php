<?php
session_start();
include 'pageconnexion.php';
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'student') {
    header("Location: ACCUEIL.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : "";
    $theme_id = isset($_POST['theme_id']) ? intval($_POST['theme_id']) : "";
    $domain_id = isset($_POST['domain_id']) ? intval($_POST['domain_id']) : "";

    $sql = "SELECT * FROM Memories WHERE memo_title LIKE CONCAT('%', ?, '%')";
    $params = array($keyword);

    if ($theme_id != "") {
        $sql .= " AND theme_id = ?";
        $params[] = $theme_id;
    }

    if ($domain_id != "") {
        $sql .= " AND domain_id = ?";
        $params[] = $domain_id;
    }

    $stmt = $conn->prepare($sql);
    if ($stmt === FALSE) {
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    } else {
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>Titre du mémoire : " . htmlspecialchars($row['memo_title']) . "</p>";
                echo "<p>Description : " . htmlspecialchars($row['memo_description']) . "</p>";
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher des mémoires</title>
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
        select {
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
    <h2>Rechercher des mémoires</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="keyword">Mot-clé :</label>
        <input type="text" id="keyword" name="keyword"><br><br>
        <label for="theme_id">Thème :</label>
    
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
        </select><br><br>
        <label for="domain_id">Domaine :</label>
        <select name="domain_id" id="domain_id">
            <option value="">Sélectionner un domaine</option>
            <option value="1">Informatique</option>
            <option value="2">Marketing</option>
            <option value="3">Agriculture</option>
        </select><br><br>
        <input type="submit" value="Rechercher">
    </form>
</body>
</html>
