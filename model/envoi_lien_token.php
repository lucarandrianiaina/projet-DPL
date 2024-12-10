<?php
// Connexion à la base de données
include('fonction.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Vérifie si l'email existe
    $query = "SELECT * FROM login l JOIN personnel p ON l.id_l = p.id_login WHERE p.mail = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Générer un token unique
        $token = bin2hex(random_bytes(16));

        // Mettre à jour le token dans la table login
        $updateQuery = "UPDATE login SET token = ? WHERE id_l = ?";
        $stmt = $connexion->prepare($updateQuery);
        $stmt->execute([$token, $user['id_l']]);

        // Envoyer un email avec le lien de réinitialisation
        $resetLink = "localhost/DPL/vue/reset_mdp.php?token=" . $token;
        $message =['head'=>'Réinitialisation du mot de passe','body'=>'Cliquez sur ce lien pour réinitialiser votre mot de passe : ' . $resetLink ,'alt_body'=>''];
        $headers = "From: no-reply@votresite.com";

        send_mail($email,$message);
      $_SESSION['message']['text'] = "Un e-mail de réinitialisation a été envoyé.";
      $_SESSION['message']['type'] = "success";
    } else {
      $_SESSION['message']['text'] = "Cet e-mail n'est pas enregistré.";
      $_SESSION['message']['type'] = "danger";
    }
}
header("Location: ../vue/mdp_oublie.php");
?>
