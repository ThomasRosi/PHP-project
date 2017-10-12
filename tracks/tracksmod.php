<?php
    $tabGenre = array('Alternative', 'Classique', 'Country', 'Dubstep', 'Electro', 'Hip-Hop', 'House', 'Jazz', 'Metal', 'Opera', 'Pop', 'Punk', 'Rap', 'Reggae', 'Religion', 'Rock', 'Techno', 'Variete');
    include('../header.php');
?>
    <ul>
        <li><a href="tracks.php">Back</a></li>
    </ul>
</nav>
<?php
    if($_SESSION['level'] >= 3) {
        if(isset($_GET['track_id']) && !isset($_GET['title']) && !isset($_GET['artist']) && !isset($_GET['album'])) {
            try {
                include_once("../db.php");
                $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                $req= $bd ->prepare('SELECT * FROM tracks WHERE track_id = :track_id');
                $req->bindValue('track_id', $_GET['track_id']);
                $req->execute();
                $data = $req->fetch();
?>
<div id="form">
    <form method="GET" action="tracksmod.php">
        <fieldset>
            <label>Title : <input type="text" name="title" value="<?php echo($data['title']);?>" size="20"></label><br>
            <label>Artist : <input type="text" name="artist" value="<?php echo($data['artist']);?>" size="20"></label><br>
            <label>Album :<input type="text" name="album" value="<?php echo($data['album']);?>" size="20"></label><br>
            <label>Genre : <select name="genre">
<?php
                foreach ($tabGenre as $value) {
?>
                <option value="<?php echo $value?>" <?php if($data['genre']=="$value"){?> selected <?php } ?>><?php echo $value?></option>
<?php
                }
?>
                </select></label>
            <input type="hidden" name="track_id" value="<?php echo ($_GET['track_id']);?>"><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
                $req->closeCursor();
            } catch (Exception $e) {
                    echo 'Connection error'.$e;
            }
        } else if(isset($_GET['title']) && isset($_GET['artist']) && isset($_GET['album'])) {

            $title_ok = false;
            $artist_ok = false;
            $album_ok = false;
            $all_ok = false;

            if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_GET['title'])) {
                $title_ok = true;
            }
            if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_GET['artist'])) {
                $artist_ok = true;
            }
            if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_GET['album'])) {
                $album_ok = true;
            }
            if ($title_ok && $artist_ok && $album_ok) {
                $all_ok = true;
            }
            if($all_ok) {
                try {
                    include_once("../db.php");
                    $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                    $req= $bd ->prepare('UPDATE tracks SET title = :title, album = :album, artist = :artist, genre = :genre WHERE track_id = :track_id');
                    $req->bindValue('title', $_GET['title']);
                    $req->bindValue('album', $_GET['album']);
                    $req->bindValue('artist', $_GET['artist']);
                    $req->bindValue('genre', $_GET[('genre')]);
                    $req->bindValue('track_id', $_GET['track_id']);
                    $req->execute();
                    header('Location: tracks.php');
                } catch (Exception $e) {
                    echo "Connection error".$e;
                }
            } else {
?>
<div id="form">
    <form method="GET" action="tracksmod.php">
        <fieldset>
            <label><?php if(!$title_ok) {echo "* ";}?>Title : <input type="text" name="title" value="<?php if($title_ok) {echo $_GET['title'];}?>" size="20"></label><br>
            <label><?php if(!$artist_ok) {echo "* ";}?>Artist : <input type="text" name="artist" value="<?php if($artist_ok) {echo $_GET['artist'];}?>" size="20"></label><br>
            <label><?php if(!$album_ok) {echo "* ";}?>Album :<input type="text" name="album" value="<?php if($album_ok) {echo $_GET['album'];}?>" size="20"></label><br>
            <label>Genre : <select name="genre">
<?php
                foreach ($tabGenre as $value) {
?>
                <option value="<?php echo $value?>" <?php if($_GET['genre']=="$value"){?> selected <?php } ?>><?php echo $value?></option>
<?php
                }
?>
                </select></label>
            <input type="hidden" name="track_id" value="<?php echo ($_GET['track_id']);?>"><br>
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

