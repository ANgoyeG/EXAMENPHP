<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "Guissé";
$password = "juin123";
$dbname = "examphp";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$sql_users = "CREATE TABLE IF NOT EXISTS Users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  passwordd VARCHAR(255) NOT NULL,
  user_type ENUM('admin', 'student') NOT NULL
)";
if ($conn->query($sql_users) === FALSE) {
    die("Erreur lors de la création de la table Users : " . $conn->error);
}

$sql_themes = "CREATE TABLE IF NOT EXISTS Themes (
  theme_id INT AUTO_INCREMENT PRIMARY KEY,
  theme_name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql_themes) === FALSE) {
    die("Erreur lors de la création de la table Themes : " . $conn->error);
}

$sql_domains = "CREATE TABLE IF NOT EXISTS Domains (
  domain_id INT AUTO_INCREMENT PRIMARY KEY,
  domain_name VARCHAR(50) NOT NULL
)";
if ($conn->query($sql_domains) === FALSE) {
    die("Erreur lors de la création de la table Domains : " . $conn->error);
}

$sql_memories = "CREATE TABLE IF NOT EXISTS Memories (
  memo_id INT AUTO_INCREMENT PRIMARY KEY,
  memo_title VARCHAR(100) NOT NULL,
  memo_description TEXT,
  theme_id INT NOT NULL,
  domain_id INT NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (theme_id) REFERENCES Themes(theme_id),
  FOREIGN KEY (domain_id) REFERENCES Domains(domain_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";
if ($conn->query($sql_memories) === FALSE) {
    die("Erreur lors de la création de la table Memories : " . $conn->error);
}

$sql_students = "CREATE TABLE IF NOT EXISTS Students (
  student_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  passwordd VARCHAR(255) NOT NULL,
  other_student_details TEXT
)";
if ($conn->query($sql_students) === FALSE) {
    die("Erreur lors de la création de la table Students : " . $conn->error);
}

$sql_administrators = "CREATE TABLE IF NOT EXISTS Administrators (
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  passwordd VARCHAR(255) NOT NULL,
  other_admin_details TEXT
)";
if ($conn->query($sql_administrators) === FALSE) {
    die("Erreur lors de la création de la table Administrators : " . $conn->error);
}

function authenticate($username, $password, $user_type) {
    global $conn;
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $sql = "SELECT * FROM Users WHERE username='$username' AND passwordd='$password' AND user_type='$user_type'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
   
    if (authenticate($username, $password, $user_type)) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['user_id'] = $user_id;
        if ($user_type === "admin") {
            header("Location: admin_dashboard.php");
            exit();
        } elseif ($user_type === "student") {
            header("Location: student_dashboard.php");
            exit();
        }
    } else {
        $error_message = "Identifiants invalides";
    }
}
?>
