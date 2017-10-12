<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }

    if($_SESSION['level'] >= 2) {
        if(isset($_GET['email'])) {
            include_once("../db.php");
            $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
            $req= $bd -> prepare('DELETE FROM links WHERE playlist_id in (SELECT playlist_id FROM playlists WHERE user_email = :user_email)');
            $req->bindValue('user_email', $_GET['email']);
            $req->execute();
            $req2= $bd -> prepare('DELETE FROM playlists WHERE user_email = :user_email');
            $req2->bindValue('user_email', $_GET['email']);
            $req2->execute();
            $req3= $bd -> prepare('DELETE FROM users WHERE email = :email');
            $req3->bindValue('email', $_GET['email']);
            $req3->execute();

            header("Location: users.php");
        }
}
?>