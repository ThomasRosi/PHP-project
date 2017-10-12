<?php
    include('../header.php');
?>
    <ul>
        <li><a href="../index.php">Back</a></li>
    </ul>
</nav>
<?php
    if($_SESSION['level'] >= 2)
    {
        if(isset($_GET['email']) && !isset($_GET['lastname']) && !isset($_GET['firstname']) && !isset($_GET['password'])) {
            try {
                include_once("../db.php");
                $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                $req= $bd ->prepare('SELECT * FROM users WHERE email = :email');
                $req->bindValue('email', $_GET['email']);
                $req->execute();
                $data = $req->fetch();
?>
<div id="form">
    <form method="GET" action="usersmod.php">
        <fieldset>
            <label>Lastname : <input type="text" name="lastname" value="<?php echo($data['lastname']);?>" size="20"></label><br>
            <label>Firstname : <input type="text" name="firstname" value="<?php echo($data['firstname']);?>" size="20"></label><br>
            <label title="5 character minimum">Password :<input type="password" name="password" size="20"></label><br>
            <input type="hidden" name="email" value="<?php echo ($_GET['email']);?>"><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
                if($_SESSION['level'] != 3) {
?>
<div id="content">
    <a href="usersdel.php?email=<?php echo($_GET['email']);?>">Delete your account here</a>
</div>
<?php
                }
                $req->closeCursor();
            } catch (Exception $e) {
                    echo 'Connection error'.$e;
            }
        } else if(isset($_GET['lastname']) && isset($_GET['firstname']) && isset($_GET['password'])) {

            $ln_ok = false;
            $fn_ok = false;
            $pwd_ok = false;
            $all_ok = false;

            if (preg_match("#^([A-Za-zéèçäàêâùïüë]+([ ]?[A-Za-zéèàêçâäùïüë]?['-]?[A-Za-zäéèàêâçùïüë]+)*)#", $_GET['lastname'])) {
                $ln_ok = true;
            }
            if (preg_match("#^([A-Za-zéèçäàêâùïüë]+([ ]?[A-Za-zéèàêçâäùïüë]?['-]?[A-Za-zäéèàêâçùïüë]+)*)#", $_GET['firstname'])) {
                $fn_ok = true;
            }
            if (preg_match("#^[a-zA-Z0-9]{5,}$#", $_GET['password'])) {
                $pwd_ok = true;
            }
            if ($ln_ok && $fn_ok && $pwd_ok) {
                $all_ok = true;
            }
            if($all_ok) {
                try {
                    include_once("../db.php");
                    $password1 = sha1($_GET['password']);
                    $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                    $req= $bd ->prepare('UPDATE users SET lastname = :lastname, firstname = :firstname, password = :password WHERE email = :email');
                    $req->execute(array('lastname' => $_GET['lastname'], 'firstname' => $_GET['firstname'], 'password' => $password1, 'email' => $_GET['email']));
					$_SESSION['lastname'] = $_GET['lastname'];
                    $_SESSION['firstname'] = $_GET['firstname'];
                    header('Location: ../index.php');
                } catch (Exception $e) {
                    echo "Connection error".$e;
                }
            } else {
?>
<div id="form">
    <form method="GET" action="usersmod.php">
        <fieldset>
            <label><?php if(!$ln_ok) {echo "* ";}?>Lastname : <input type="text" name="lastname" value="<?php if($ln_ok) {echo $_GET['lastname'];}?>" size="20"></label><br>
            <label><?php if(!$fn_ok) {echo "* ";}?>Firstname : <input type="text" name="firstname" value="<?php if($fn_ok) {echo $_GET['firstname'];}?>" size="20"></label><br>
            <label title="5 character minimum"><?php if(!$pwd_ok) {echo "* ";}?>Password :<input type="password" name="password" size="20"></label><br>
            <input type="hidden" name="email" value="<?php echo ($_GET['email']);?>"><br>
            <input type="submit" class="button" value="Validate !"><br>
            <i>* = Check about mistakes please.</i>
        </fieldset>
    </form>
</div>
<?php
            }
        }
    }
    include('../footer.php');
?>
</body>
</html>

