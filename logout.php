<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }

    if($_SESSION['level'] >= 1) {
        session_destroy();
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }
?>