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

    if(!$_SESSION['level'] >= 1) {
        if(isset($_POST['email']) && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['password'])) {

            $email_ok = false;
            $ln_ok = false;
            $fn_ok = false;
            $pwd_ok = false;
            $all_ok = false;

            if (preg_match("#^[a-z0-9.\-_]{1,}@[a-z](.?[a-z])*\.([a-z]){2,4}$#", $_POST['email'])) {
                $email_ok = true;
            }
            if (preg_match("#^([A-Za-zéèàêâäçùïüë]+([ ]?[A-Za-zéèàêäçâùïüë]?['-]?[A-Za-zéèàêâùïäçüë]+)*)#", $_POST['lastname'])) {
                $ln_ok = true;
            }
            if (preg_match("#^([A-Za-zéèçäàêâùïüë]+([ ]?[A-Za-zéèàêçâäùïüë]?['-]?[A-Za-zäéèàêâçùïüë]+)*)#", $_POST['firstname'])) {
                $fn_ok = true;
            }
            if (preg_match("#^[a-zA-Z0-9]{5,}$#", $_POST['password'])) {
                $pwd_ok = true;
            }
            if ($email_ok && $ln_ok && $fn_ok && $pwd_ok) {
                $all_ok = true;
            }
            if($all_ok) {
                try {
                    include_once("db.php");
                    $password1 = sha1($_POST['password']);
                    $bd = new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                    $req = $bd->prepare('INSERT INTO users (lastname, firstname, email, password) VALUES (:lastname, :firstname, :email, :password)');
                    $req->bindValue(':lastname', $_POST['lastname']);
                    $req->bindValue(':firstname', $_POST['firstname']);
                    $req->bindValue(':email', $_POST['email']);
                    $req->bindValue(':password', $password1);
                    $req->execute();

                    header('Location: index.php');
                } catch (Exception $e) {
                    echo 'Connection error'.$e;
                }
            } else {
?>
<nav id="navbar">
    <ul>
        <li><a href="index.php">Index</a></li>
        <li><a href="inscription.php">Registration</a></li>
    </ul>
</nav>
<div id="form">
    <form method="POST" action="inscription.php">
        <fieldset>
            <legend>Registration</legend>
            <label><?php if(!$email_ok) {echo "* ";}?>Email : <input type="text" name="email" value="<?php if($email_ok) {echo $_POST['email'];}?>" size="20"></label><br>
            <label><?php if(!$ln_ok) {echo "* ";}?>Lastname : <input type="text" name="lastname" value="<?php if($ln_ok) {echo $_POST['lastname'];}?>" size="20"></label><br>
            <label><?php if(!$fn_ok) {echo "* ";}?>Firstname : <input type="text" name="firstname" value="<?php if($fn_ok) {echo $_POST['firstname'];}?>" size="20"></label><br>
            <label title="5 character minimum"><?php if(!$pwd_ok) {echo "* ";}?>Password : <input type="password" name="password" size="20"></label><br>
            <input type="submit" class="button" value="Validate !"><br>
            <i>* = Check about mistakes please.</i><br>
            <i>Password : No symbols allowed.</i>
        </fieldset>
    </form>
</div>
<?php
            }
        } else {
?>
<nav id="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="inscription.php">Registration</a></li>
    </ul>
</nav>
<div id="form">
    <form method="POST" action="inscription.php">
        <fieldset>
            <legend>Registration</legend>
            <label>Email : <input type="text" name="email" size="20"></label><br>
            <label>Lastname : <input type="text" name="lastname" size="20"></label><br>
            <label>Firstname : <input type="text" name="firstname" size="20"></label><br>
            <label title="5 character minimum">Password : <input type="password" name="password" size="20"></label><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
        }
    } else {
        echo 'You are already logged.';
    }
    include('footer.php')
?>
</body>
</html>