<?php
session_start();
include 'pageconnexion.php';

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ACCUEIL.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];

        $sql = "INSERT INTO Users (username, passwordd, user_type) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === FALSE) {
            echo "Erreur lors de la préparation de la requête : " . $conn->error;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $username, $hashed_password, $user_type);
            if ($stmt->execute()) {
                echo "Utilisateur ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
            }
        }
    } elseif (isset($_POST['edit_user'])) {
        $username = $_POST['username'];
        $user_type = $_POST['user_type'];

        if (!empty($username)) {
            $sql = "UPDATE Users SET user_type = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === FALSE) {
                echo "Erreur lors de la préparation de la requête : " . $conn->error;
            } else {
                $stmt->bind_param("ss", $user_type, $username);
                if ($stmt->execute()) {
                    echo "Utilisateur modifié avec succès.";
                } else {
                    echo "Erreur lors de la modification de l'utilisateur : " . $stmt->error;
                }
            }
        } else {
            echo "Nom d'utilisateur vide.";
        }
    } elseif (isset($_POST['delete_user'])) {
        $username = $_POST['username'];

        if (!empty($username)) {
            $sql = "DELETE FROM Users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === FALSE) {
                echo "Erreur lors de la préparation de la requête : " . $conn->error;
            } else {
                $stmt->bind_param("s", $username);
                if ($stmt->execute()) {
                    echo "Utilisateur supprimé avec succès.";
                } else {
                    echo "Erreur lors de la suppression de l'utilisateur : " . $stmt->error;
                }
            }
        } else {
            echo "Nom d'utilisateur vide.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les utilisateurs</title>
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
        input[type="password"],
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
    <h2>Gérer les utilisateurs</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password"><br>
        <label for="user_type">Type d'utilisateur :</label>
        <select name="user_type" id="user_type">
            <option value="admin">Administrateur</option>
            <option value="student">Étudiant</option>
        </select><br>
        <input type="submit" value="Ajouter l'utilisateur" name="add_user">
        <input type="submit" value="Modifier l'utilisateur" name="edit_user">
        <input type="submit" value="Supprimer l'utilisateur" name="delete_user">
    </form>
</body>
</html>
