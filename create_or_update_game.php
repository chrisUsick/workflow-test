<?php
    require('includes\includes.php');

    $validation_error = false;
    $id = safe_get_id(); // There will only be an id if we are editing.

    // Are we processing an update, setting up for an edit, or creating a new game?
    if ($_POST) {
        $game = sanitized_game();
        $validation_error = validation_error($game);
    } else if ($id) {
        $game = find_game_by_id($id);
    } else {
        $game = blank_game();
    }

    $is_new_game = !isset($game['id']);
    $is_delete   = isset($_POST['delete']);

    // CUD work requires that validations pass.
    if ($_POST && !$validation_error) {
        if ($is_new_game) {
            create_game($game);
        } else if ($is_delete) {
            delete_game_by_id($game['id']);
        } else {
            update_game($game);
        }

        redirect_to('admin.php');
    }

    require('partials\header.php');
?>
<?php if ($validation_error): ?>
    <p class="error"><?=$validation_error ?></p>
<?php endif ?>

<form action="create_or_update_game.php" method="post" role="form">
    <fieldset>
        <?php if ($is_new_game): ?>
            <legend>New Board Game</legend>
        <?php else: ?>
            <legend>Update Board Game</legend>
        <?php endif ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" id="name" value="<?= $game['name'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= $game['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label>Number of Players</label>
            <input name="min_num_players" placeholder="minimum #" value="<?= $game['min_num_players'] ?>"> -
            <input name="max_num_players" placeholder="maximum #" value="<?= $game['max_num_players'] ?>">
        </div>
        <div class="form-group">
            <label>Play Time</label>
            <input name="min_play_minutes" placeholder="minimum minutes" value="<?= $game['min_play_minutes'] ?>"> -
            <input name="max_play_minutes" placeholder="maximum minutes" value="<?= $game['max_play_minutes'] ?>">
        </div>
        <?php if (isset($game['id'])): ?>
            <input type="hidden" name="id" value="<?= $game['id'] ?>">
        <?php endif ?>
        <?php if ($is_new_game): ?>
            <input type="submit" value="Create Game">
        <?php else: ?>
            <input type="submit" value="Update Game">
            <input type="submit" name="delete" value="Delete Game" onclick="return confirm('Are you sure you want to delete this game?')">
        <?php endif ?>
    </fieldset>
</form>
<?php require('partials\footer.php'); ?>