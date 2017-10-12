<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }

    if($_SESSION['level'] >= 2) {
        if(isset($_GET['playlist_id'])) {
            include_once("../db.php");
            $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
            $req= $bd -> prepare('DELETE FROM links WHERE playlist_id = :playlist_id');
            $req->bindValue('playlist_id', $_GET['playlist_id']);
            $req->execute();
            $req2= $bd -> prepare('DELETE FROM playlists WHERE playlist_id = :playlist_id');
            $req2->bindValue('playlist_id', $_GET['playlist_id']);
            $req2->execute();
            header("Location: playlist.php");
        }
}
?>