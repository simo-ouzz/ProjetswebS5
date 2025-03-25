<?php
session_start();

// Détruire toutes les variables de session
session_unset();
session_destroy();

// Redirection vers la page de connexion (ou la page d'accueil)
header("Location: /projets6/public/index.php");
exit();
