<?php
    require('includes\includes.php');

    $get_id = safe_get_id(); // There will only be an id if we are editing.
    $delete_requested = isset($_POST['delete']);

    // Load the game based on...
    if ($_POST) {                      // ...a POSTed form.
        $game = sanitized_game_from_post();
        $validation_error = game_validation_error($game);
    } else if ($get_id) {              // ...a GET request with an id parameter.
        $game = find_game_by_id($get_id);
    } else {                           // ...a GET request with no id parameter.
        $game = blank_game();
    }

    // Validation for create and update, but not for delete.
    if ($_POST && !$delete_requested) {
        $validation_error = category_validation_error($game);
    } else {
        $validation_error = false;
    }

    // Process Create, Update or Delete Requests
    if ($_POST && !$validation_error) {
        if (is_game_new($game)) {
            create_game($game);
        } else if ($delete_requested) {
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
        <?php if (is_game_new($game)): ?>
            <legend>New Board Game</legend>
        <?php else: ?>
            <legend>Update Board Game</legend>
        <?php endif ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" id="name" value="<?= $game['name'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control summernote" rows="10" name="description" id="description"><?= $game['description'] ?></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <label>Minimum # of Players</label>
                    <input class="form-control" type="number" min="1" name="min_num_players" placeholder="minimum #" value="<?= $game['min_num_players'] ?>">
                </div>
                <div class="col-xs-3">
                    <label>Maximum # of Players</label>
                    <input class="form-control" type="number" min="1" name="max_num_players" placeholder="maximum #" value="<?= $game['max_num_players'] ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">
                    <label>Minimum Playtime in Minutes</label>
                    <input class="form-control" type="number" min="1" name="min_play_minutes" placeholder="minimum minutes" value="<?= $game['min_play_minutes'] ?>">
                </div>
                <div class="col-xs-3">
                    <label>Maximum Playtime in Minutes</label>
                    <input class="form-control" type="number" min="1" name="max_play_minutes" placeholder="maximum minutes" value="<?= $game['max_play_minutes'] ?>">
                </div>
            </div>
        </div>
        <?php if (is_game_new($game)): ?>
            <input class="btn btn-primary" type="submit" value="Create Game">
        <?php else: ?>
            <input type="hidden" name="id" value="<?= $game['id'] ?>">
            <input class="btn btn-primary" type="submit" value="Update Game">
            <input  class="btn  btn-danger" type="submit" name="delete" value="Delete Game" onclick="return confirm('Are you sure you want to delete this game?')">
        <?php endif ?>
    </fieldset>
</form>
<?php require('partials\footer.php'); ?>