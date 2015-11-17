<?php
    require('includes\includes.php');
    
    if ($_POST) {
        $new_game = sanitized_game();
        $validation_error = validation_error($new_game);

        if (!$validation_error) {
            create_game($new_game);
        }
    } else {
        $new_game = blank_game();
    }
    
    require('partials\header.php');
?>
<?php if (isset($validation_error) && $validation_error): ?>
    <p class="error"><?=$validation_error ?></p>
<?php endif ?>

<form action="new_game.php" method="post" role="form">
    <fieldset>
        <legend>New Board Game</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" id="name" value="<?= $new_game['name'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $new_game['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label>Number of Players</label>
            <input name="min_num_players" placeholder="minimum #" value="<?= $new_game['min_num_players'] ?>"> - 
            <input name="max_num_players" placeholder="maximum #" value="<?= $new_game['max_num_players'] ?>">
        </div>
        <div class="form-group">
            <label>Play Time</label>
            <input name="min_play_minutes" placeholder="minimum minutes" value="<?= $new_game['min_play_minutes'] ?>"> - 
            <input name="max_play_minutes" placeholder="maximum minutes" value="<?= $new_game['max_play_minutes'] ?>">
        </div>
        <input type="submit">
    </fieldset>
</form>
<?php require('partials\footer.php'); ?>