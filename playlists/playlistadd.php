<?php
    include('../header.php');
?>
    <ul>
        <li><a href="playlist.php">Back</a></li>
    </ul>
</nav>
<?php
    if($_SESSION['level'] >= 2) {
        if(isset($_POST['name'])) {
            if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_POST['name'])){
                try {
                    include_once("../db.php");
                    $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                    $req= $bd ->prepare('INSERT INTO playlists (name, user_email) VALUES (:name, :user_email)');
                    $req->bindValue('name', $_POST['name']);
                    $req->bindValue('user_email', $_SESSION['email']);
                    $req->execute();
                    header('Location: playlist.php');
                } catch (Exception $e) {
                    echo 'Connection error'.$e;
                }
            } else {
?>
<div id="form">
    <form method="POST" action="playlistadd.php">
        <fieldset>
            <legend>New Playlist</legend>
            <label><?php if(!$name_ok) {echo "* ";}?>Name : <input type="text" name="name" size="20" value="<?php if($name_ok) {echo $_POST['name'];}?>"></label><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
            }
        } else {
?>
<div id="form">
    <form method="POST" action="playlistadd.php">
        <fieldset>
            <legend>New Playlist</legend>
            <label>Name : <input type="text" name="name" size="20"></label><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
        }
    }
?>
<?php
    include('../footer.php');
?>
</body>
</html>