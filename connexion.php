<?php

session_start();

if (isset($_POST['email'], $_POST['pass'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $db = new PDO('mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201628', 'dutinfopw201628', 'bumuqasy');

    $sql = "SELECT * FROM Utilisateurs where email = '$email' ";
    $result = $db->prepare($sql);
    $result->execute();

    if ($result->rowCount() > 0) 
    {
        $data = $result->fetch();

        if (password_verify($pass, $data["mdp"])) {
            echo "Connexion effectuée";
            $_SESSION['email'] = $email;
        }
    } else {
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Utilisateurs (email, mdp) VALUES ('$email', '$hashpass')";
        $req = $db->prepare($sql);
        $req->execute();

        echo "<center><h1>Inscription effectué</h1></center>";
        header('Location: accueil.php');
        exit();    }
}

?>