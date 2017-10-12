<?php
    include('../header.php');
?>
    <ul>
        <li><a href="playlist.php">Back</a></li>
    </ul>
</nav>
<div id="content">
<?php
    if($_SESSION['level'] >= 2){
        if(isset($_GET['playlist_id'])) {
            try {
                include_once("../db.php");
                $bd = new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                $req= $bd -> query('SELECT * FROM tracks');
                $n = 1;
                while($data = $req->fetch()) {
?>
    <fieldset>
        <legend><?php echo $n; ?></legend>
        Title : <?php echo $data['title'];?><br>
        Artist : <?php echo $data['artist'];?><br>
        Album : <?php echo $data['album'];?><br>
        Genre : <?php echo $data['genre'];?><br>
        <a href="playlisttrackadd.php?playlist_id=<?php echo($_GET['playlist_id'])?>&track_id=<?php echo($data['track_id'])?>">Add this track to your playlist</a>
    </fieldset>
<?php
                    $n++;
                }
            } catch (Exception $e) {
                echo 'Connection error'.$e;
            }
        }
    }
?>
</div>
<?php
    include('../footer.php');
?>
</body>
</html>