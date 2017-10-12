<?php
    include('../header.php');
?>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../tracks/tracks.php">Tracks</a></li>
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
        You can add, delete and modify your playlists here !
    </p>
<?php
    if($_SESSION['level'] == 2) {
?>
    <a href="playlistadd.php">Click here to add a playlist to the database !</a><br>
<?php
    }
    if($_SESSION['level'] >= 2) {
        try {
            include_once("../db.php");
            $bd = new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
            if($_SESSION['level'] >= 3) {
                $req= $bd->query('SELECT * FROM playlists');
            } else {
                $req= $bd -> prepare('SELECT * FROM playlists where user_email = :user_email');
                $req->bindValue('user_email', $_SESSION['email']);
                $req->execute();
            }
            $n1 = 1;
            while($data = $req->fetch()) {
?>
    <fieldset>
        <legend><?php echo $n1; ?></legend>
        Name : <?php echo $data['name'];?><br>
<?php
                if($_SESSION['level'] >= 3) {
?>
        User Email : <?php echo $data['user_email'];?><br>
<?php
                } else {
?>
        <a href="playlistmod.php?playlist_id=<?php echo($data['playlist_id']);?>">Modify</a> &nbsp;&nbsp;
<?php
                }
?>
        <a href="playlistdel.php?playlist_id=<?php echo($data['playlist_id']);?>">Delete</a>
<?php
                if($_SESSION['level'] == 2) {
                    try {
                        include_once("../db.php");
                        $bd=new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
                        $req2= $bd ->prepare('SELECT * FROM tracks WHERE track_id in (SELECT track_id FROM links WHERE playlist_id = :playlist_id)');
                        $req2->bindValue('playlist_id', $data['playlist_id']);
                        $req2->execute();
                        $n2 = 1;
                        while($data2 = $req2->fetch()) {
?>
        <fieldset>
            <legend><?php echo $n2; ?></legend>
            Title : <?php echo $data2['title'];?><br>
            Artist : <?php echo $data2['artist'];?><br>
            Album : <?php echo $data2['album'];?><br>
            Genre : <?php echo $data2['genre'];?><br>
            <a href="playlisttrackdel.php?track_id=<?php echo($data2['track_id']);?>&playlist_id=<?php echo($data['playlist_id'])?>">Delete from playlist</a>
        </fieldset>
<?php
                            $n2++;
                        }
                    }  catch (Exception $e) {
                    echo 'Connection error'.$e;
                    }
                }
                if($_SESSION['level'] == 2) {
?>
        <br><a href="playlisttracklist.php?playlist_id=<?php echo($data['playlist_id']);?>">Add a track</a>
<?php
                }
?>
    </fieldset>
<?php
            $n1++;
            }
        } catch (Exception $e) {
            echo 'Connection error'.$e;
        }
    }
?>
</div>
<?php
    include('../footer.php');
?>
</body>
</html>