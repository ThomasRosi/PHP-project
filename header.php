<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="ROSI Thomas">
    <title>Song Sequency</title>
    <link href="../css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div id="title">
    <h1>Song Sequency</h1>
</div>
<?php
    session_start();
    if(!isset($_SESSION['level'])) {
        $_SESSION['level'] = 0;
    }
	if($_SESSION['level'] == 0) {
		header('Location: ../index.php');
	}
?>
<div id="id">
    <span><?php echo $_SESSION['lastname']; ?></span><br>
    <span><?php echo $_SESSION['firstname']; ?></span><br>
    <span><a href="../logout.php">Log out</a></span><br>
    <span><a href="../users/usersmod.php?email=<?php echo($_SESSION['email']);?>">User Options</a></span>
</div>
<nav id="navbar">