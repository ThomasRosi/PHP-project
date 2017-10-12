<?php
    include('../header.php');
?>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../tracks/tracks.php">Tracks</a></li>
        <li><a href="../playlists/playlist.php">Playlists</a></li>
    </ul>
</nav>
<div id="content">
    <p>
        You can see here all users in our database.
    </p>
<?php
    if($_SESSION['level'] >= 3) {
        try {
            include_once("../db.php");
            $bd = new PDO('mysql:host='.$host.';dbname='.$bdname,$user,$password);
            $req= $bd -> query('SELECT * FROM users WHERE level != 3');
            $n = 1;
            while($data = $req->fetch()) {
?>
    <fieldset>
        <legend><?php echo $n; ?></legend>
        Lastname : <?php echo $data['lastname'];?> &nbsp;&nbsp; Firstname : <?php echo $data['firstname'];?><br>
		<a href="userban.php?email=<?php echo($data['email']);?>&level=<?php echo($data['level']);?>"><?php if($data['level'] == 1) { echo("Unban");} else {echo("Ban");}?></a><br>
		<a href="usersdel.php?email=<?php echo($data['email']);?>">Delete</a>
    </fieldset>
<?php
                $n++;
            }
        } catch (Exception $e) {
            echo 'Connection error'.$e;
        }
    } else {
        session_destroy();
        header('Location: ../index.php');
    }
?>
</div>
<?php
    include('../footer.php');
?>
</body>
</html>