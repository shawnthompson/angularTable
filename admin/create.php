<?php

    require '../inc/connect.php';
    $title = "Add track";
    $path = "../";

    if ( !empty($_POST)) {
        // keep track validation errors
        $songError = null;
        $artistError = null;
        $genreError = null;

        // keep track post values
        $song = $_POST['song'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $topSong = $_POST['topSong'];

        // validate input
        $valid = true;
        if (empty($song)) {
            $songError = 'Please enter song';
            $valid = false;
        }

        if (empty($artist)) {
            $artistError = 'Please enter artist';
            $valid = false;
        }

        if (empty($genre)) {
            $genreError = 'Please enter genre';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tracks (Song,Artist,Genre,TopSong) values (?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($song,$artist,$genre,$topSong));
            Database::disconnect();
            header("Location: ../inc/convert.php");
        }
    }
include "../inc/head.php";
?>
<main class="main col-xs-12">
    <h1><?php echo $title; ?></h1>
    <form action="create.php" method="post">
        <div class="form-group <?php echo !empty($songError)?'error':'';?>">
            <label for="addSongTitle" class="control-label">Song:</label>
            <input name="song" value="<?php echo !empty($song)?$song:'';?>" placeholder="Enter song title" type="text" class="form-control" id="addSongTitle">
            <?php if (!empty($songError)): ?>
            <span class="help-block"><?php echo $songError;?></span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo !empty($artistError)?'error':'';?>">
            <label for="addSongArtist" class="control-label">Artist:</label>
            <input name="artist" value="<?php echo !empty($artist)?$artist:'';?>" placeholder="Enter artist name" type="text" class="form-control" id="addSongArtist">
            <?php if (!empty($artistError)): ?>
            <span class="help-block"><?php echo $artistError;?></span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo !empty($genreError)?'error':'';?>">
            <label for="addSongGenre" class="control-label">Genre:</label>
            <input name="genre" value="<?php echo !empty($genre)?$genre:'';?>" placeholder="Enter genre" type="text" class="form-control" id="addSongGenre">
            <?php if (!empty($genreError)): ?>
            <span class="help-block"><?php echo $genreError;?></span>
            <?php endif; ?>
        </div>
        <fieldset>
            <legend>Top Song:</legend>
            <input id="top-yes" type="radio" name="topSong" value="true">
            <label class="radio-inline" for="top-yes">Yes</label><br>
            <input id="top-no" type="radio" name="topSong" checked="checked" value="">
            <label class="radio-inline" for="top-no">No</label><br>
        </fieldset>
        <div class="form-action mrgn-tp-lg">
            <p class="btn btn-default"><a href="index.php">Cancel</a></p>
            <button type="submit" class="btn btn-default">Add Song</button>
        </div>
    </form>
</main>
<?php include "../inc/foot.php";?>