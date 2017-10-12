<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }

    if($_SESSION['level'] >= 3) {
        if(isset($_GET['email']) && isset($_GET['level'])) {
            include_once("../db.php");
            $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
			if($_GET['level'] == 1) {
				$req= $bd -> prepare('UPDATE users SET level = 2 WHERE email = :email');
			} else {
				$req= $bd -> prepare('UPDATE users SET level = 1 WHERE email = :email');
			}
            $req->bindValue('email', $_GET['email']);
            $req->execute();
            header("Location: users.php");
        }
}
?>