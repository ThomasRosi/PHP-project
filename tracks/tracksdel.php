<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }

    if($_SESSION['level'] >= 3) {
        if(isset($_GET['track_id'])) {
            include_once("../db.php");
            $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
			$req= $bd -> prepare('DELETE FROM links WHERE track_id = :track_id');
			$req->bindValue('track_id', $_GET['track_id']);
			$req->execute();
            $req1= $bd -> prepare('DELETE FROM tracks WHERE track_id = :track_id');
			$req1->bindValue('track_id', $_GET['track_id']);
            $req1->execute();
            header("Location: tracks.php");
        }

}
?>