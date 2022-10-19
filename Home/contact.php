<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Contact</title>
</head>

<body>
<h1>Contact</h1>
<form method="post">
    <label>Votre email</label>
    <input type="email" name="email" required><br>
    <label>Message</label>
    <textarea name="message" required></textarea><br>
    <input type="submit">
</form>
<?php
if (isset($_POST['message'])) {
    $retour = mail('alex.ganassi@free.fr', 'Envoi depuis la page Contact', $_POST['message test'], 'From: ' . "\r\n" . 'Reply-to: ' . $_POST['email']);
    if($retour)
        echo '<p>Votre message a bien été envoyé.</p>';
    else
        echo '<p>Votre message na pas été envoyé.</p>';
}
?>
</body>
</html>