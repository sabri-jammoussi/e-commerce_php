<?php
session_start();
class connexion
{
    public function CNXbase()
    {
        try {
            $con = new PDO(
                'mysql:host=localhost;dbname=projet_php_iit',
                'root',
                ''
            );
            return $con;
            // $conn = mysqli_connect('localhost','root','','projet1');
        } catch (Exception $e) {
            echo 'Erreur de connexion: ' . $e->getMessage();
        }
    }
}