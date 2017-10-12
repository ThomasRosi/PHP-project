<?php
    $tabGenre = array('Alternative', 'Classique', 'Country', 'Dubstep', 'Electro', 'Hip-Hop', 'House', 'Jazz', 'Metal', 'Opera', 'Pop', 'Punk', 'Rap', 'Reggae', 'Religion', 'Rock', 'Techno', 'Variete');
    include('../header.php');
?>
    <ul>
        <li><a href="tracks.php">Back</a></li>
    </ul>
</nav>
<?php
	if($_SESSION['level'] == 3) {
		if(isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['album'])) {

			$title_ok = false;
			$artist_ok = false;
			$album_ok = false;
			$all_ok = false;

			if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_POST['title'])) {
				$title_ok = true;
			}
			if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_POST['artist'])) {
				$artist_ok = true;
			}
			if (preg_match("#^[a-zA-Z0-9éèàêâùïüë\' \-_]+$#", $_POST['album'])) {
				$album_ok = true;
			}
			if ($title_ok && $artist_ok && $album_ok) {
				$all_ok = true;
			}
			if($all_ok) {
				try {
					include_once("../db.php");
					$bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
					$req= $bd ->prepare('INSERT INTO tracks (title, album, artist, genre) VALUES (:title, :album, :artist, :genre)');
					$req->bindValue(':title', $_POST['title']);
					$req->bindValue(':album', $_POST['album']);
					$req->bindValue(':artist', $_POST['artist']);
					$req->bindValue(':genre', $_POST['genre']);
					$req->execute();
					header('Location: tracks.php');
				} catch (Exception $e) {
					echo 'Connection error'.$e;
				}
			} else {
?>
<div id="form">
    <form method="POST" action="trackadd.php">
        <fieldset>
            <legend>New Track</legend>
            <label><?php if(!$title_ok) {echo "* ";}?>Title : <input type="text" name="title" value="<?php if($title_ok) {echo $_POST['title'];}?>" size="20"></label><br>
            <label><?php if(!$artist_ok) {echo "* ";}?>Artist : <input type="text" name="artist" value="<?php if($artist_ok) {echo $_POST['artist'];}?>" size="20"></label><br>
            <label><?php if(!$album_ok) {echo "* ";}?>Album : <input type="text" name="album" value="<?php if($album_ok) {echo $_POST['album'];}?>" size="20"></label><br>
            <label>Genre : <select name="genre">
<?php
				foreach ($tabGenre as $value) {
?>
                <option value="<?php echo $value?>"><?php echo $value?></option>
<?php
				}
?>
            </select></label>
            <input type="submit" class="button" value="Validate !"><br>
            <i>* = Check about mistakes please.</i>
        </fieldset>
    </form>
</div>
<?php
			}
		} else {
?>
<div id="form">
    <form method="POST" action="trackadd.php">
        <fieldset>
            <legend>New Track</legend>
            <label>Title : <input type="text" name="title" size="20"></label><br>
            <label>Artist : <input type="text" name="artist" size="20"></label><br>
            <label>Album : <input type="text" name="album" size="20"></label><br>
            <label>Genre : <select name="genre">
<?php
        foreach ($tabGenre as $value) {
?>
                <option value="<?php echo $value?>"><?php echo $value?></option>
<?php
			}
?>
            </select></label><br>
            <input type="submit" class="button" value="Validate !">
        </fieldset>
    </form>
</div>
<?php
		}
	}
    include('../footer.php');
?>
</body>
</html>