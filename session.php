<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

function Verifier_session()
{
    if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] != "1") {
        header('Location: login.php');
        exit();
    }
}
