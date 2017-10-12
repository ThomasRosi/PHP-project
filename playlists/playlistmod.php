<?php
    include('../header.php');
?>
    <ul>
        <li><a href="playlist.php">Back</a></li>
    </ul>
</nav>
<?php
    if($_SESSION['level'] >= 2)
    {
        if(isset($_GET['playlist_id']) && !isset($_GET['name'])) {
            try {
                include_once("../db.php");
                $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                $req= $bd ->prepare('SELECT * FROM playlists WHERE playlist_id = :playlist_id');
                $req->bindValue('playlist_id', $_GET['playlist_id']);
                $req->execute();
                $data = $req->fetch();
?>
<div id="form">
    <form method="GET" action="playlistmod.php">
        <fieldset>
            <label>Name : <input type="text" name="name" value="<?php echo($data['name']);?>" size="20"></label><br>
            <input type="hidden" name="playlist_id" value="<?php echo ($_GET['playlist_id']);?>"><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
                $req->closeCursor();
            } catch (Exception $e) {
                    echo 'Connection error'.$e;
            }
        } else if(isset($_GET['name'])) {
            if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_GET['name'])){
                try {
                    include_once("../db.php");
                    $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                    $req= $bd ->prepare('UPDATE playlists SET name = :name WHERE playlist_id = :playlist_id');
                    $req->bindValue('name', $_GET['name']);
                    $req->bindValue('playlist_id', $_GET['playlist_id']);
                    $req->execute();
                    header('Location: playlist.php');
                } catch (Exception $e) {
                    echo "Connection error".$e;
                }
            } else {
?>
<div id="form">
    <form method="GET" action="playlistmod.php">
        <fieldset>
            <label><?php if(!$name_ok) {echo "* ";}?>Name : <input type="text" name="name" value="<?php if($name_ok) {echo $_GET['name'];}?>" size="20"></label><br>
            <input type="hidden" name="playlist_id" value="<?php echo ($_GET['playlist_id']);?>"><br>
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

