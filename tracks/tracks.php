<?php
    include('../header.php');
?>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../playlists/playlist.php">Playlists</a></li>
<?php
        if($_SESSION['level'] >= 3) {
?>
        <li><a href="../users/users.php">Users</a></li>
<?php
        }
?>
    </ul>
</nav>
<div id="content">
    <p>
        You can see here all music tracks in our database.
    </p>
<?php
    if($_SESSION['level'] >= 3) {
?>
    <a href="trackadd.php">Click here to add a track to the database !</a><br>
<?php
    }
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
            Genre : <?php echo $data['genre'];?>
            <?php if($_SESSION['level'] >= 3) {?><br> <a href="tracksmod.php?track_id=<?php echo($data['track_id']);?>">Modify</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="tracksdel.php?track_id=<?php echo($data['track_id']);?>">Delete</a><?php } ?>
        </fieldset>
<?php
            $n++;
        }
    } catch (Exception $e) {
        echo 'Connection error'.$e;
    }
?>
</div>
<?php
    include('../footer.php');
?>
</body>
</html>