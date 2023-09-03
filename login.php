<?php
// Assuming you have a database connection
$db = new PDO('mysql:host=localhost;dbname=php-crud', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Perform database query to validate the login credentials
    $query = $db->prepare('SELECT * FROM crud WHERE username = :username AND email = :email');
    $query->execute(array(':username' => $username, ':email' => $email));

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Login successful, redirect to the home page or any other desired page
        header("Location: index.html");
        exit();
    } else {
        // Login failed, show an error message
        echo 'Invalid username or password';
    }
}
?>
