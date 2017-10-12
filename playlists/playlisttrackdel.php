<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }

    if($_SESSION['level'] >= 2) {
        if(isset($_GET['playlist_id']) && isset($_GET['track_id'])) {
            include_once("../db.php");
            $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
            $req= $bd -> prepare('DELETE FROM links WHERE playlist_id = :playlist_id && track_id = :track_id');
            $req->bindValue('playlist_id', $_GET['playlist_id']);
            $req->bindValue('track_id', $_GET['track_id']);
            $req->execute();
            header("Location: playlist.php");
        }
}
?>