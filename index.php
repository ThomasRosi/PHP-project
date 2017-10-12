<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="ROSI Thomas">
    <title>Song Sequency</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
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
        if(isset($_POST['email']) && isset($_POST['password'])) {
            try {
                $password1 = sha1($_POST['password']);
                include_once("db.php");
                $bd = new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                $req = $bd->prepare('SELECT lastname, firstname, level FROM users WHERE email = :email && password = :password');
                $req->bindValue('email', $_POST['email']);
                $req->bindValue('password', $password1);
                $req->execute();
                $data = $req->fetch();
                if(!empty($data)) {
                    $_SESSION['level'] = $data['level'];
                    $_SESSION['lastname'] = $data['lastname'];
                    $_SESSION['firstname'] = $data['firstname'];
                    $_SESSION['email'] = $_POST['email'];
                    header('Location: index.php');
                } else {
                    $_SESSION['level'] = 0;
?>
<nav id="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="inscription.php">Registration</a></li>
    </ul>
</nav>
<div id="content">
    <p>
        Welcome in Song Sequency !
    </p>
    <p>
        Please login or create a new account in the registration tab.
    </p>
</div>
<div id="form">
    <form method="POST" action="index.php">
        <fieldset>
            <legend>Log in</legend>
            <label><?php if(empty($_POST['email'])) {echo "* ";}?>Email : <input type="text" name="email" value="<?php if(!empty($_POST['email'])) {echo $_POST['email'];}?>"></label><br>
            <label>* Password : <input type="password" name="password"></label><br>
            <input type="submit" class="button" value="Log in"><br>
            <i>* = Check about mistakes please.</i>
        </fieldset>
    </form>
</div>
<?php
                }
            } catch (Exception $e) {
                echo 'Connection error'.$e;
            }
        } else {
?>
<nav id="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="inscription.php">Registration</a></li>
    </ul>
</nav>
<div id="content">
    <p>
        Welcome in Song Sequency !
    </p>
    <p>
        Please login or create a new account in the registration tab.
    </p>
</div>
<div id="form">
    <form method="POST" action="index.php">
        <fieldset>
            <legend>Log in</legend>
            <label>Email : <input type="text" name="email"></label><br>
            <label>Password : <input type="password" name="password"></label><br>
            <input type="submit" class="button" value="Log in">
        </fieldset>
    </form>
</div>
<?php
        }
    } else if($_SESSION['level'] == 1) {
?>
<div id="id">
    <span><?php echo $_SESSION['lastname']; ?></span><br>
    <span><?php echo $_SESSION['firstname']; ?></span><br>
    <span><a href="logout.php">Log out</a></span><br>
</div>
<nav id="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>
</nav>
<div id="content">
    <p>
        Your account is banned! Please send a email to the administrator : <a href="mailto:thomas.rosi@skynet.be">thomas.rosi@skynet.be</a>
    </p>
</div>
<?php
	} else {		
?>
<div id="id">
    <span><?php echo $_SESSION['lastname']; ?></span><br>
    <span><?php echo $_SESSION['firstname']; ?></span><br>
    <span><a href="logout.php">Log out</a></span><br>
    <span><a href="users/usersmod.php?email=<?php echo($_SESSION['email']);?>">User Options</a></span>
</div>
<nav id="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>
</nav>
<div id="content">
    <p>
        Welcome in Song Sequency !
    </p>
    <p>
        You're now connected to our database and ready to share some tracks of music and playlists created by yourself !
    </p>
    <ul>
        <li><a href="tracks/tracks.php">Tracks</a></li>
        <li><a href="playlists/playlist.php">Playlists</a></li>
<?php
		if($_SESSION['level'] >= 3) {
?>
        <li><a href="users/users.php">Users</a></li>
<?php
		}
?>
    </ul>
</div>
<?php
    }
    include('footer.php')
?>
</body>
</html>