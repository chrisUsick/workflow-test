<?php

/* Finds all rows in the games table.

   Returns an array of hashes. */
function find_all_games() {
    $sql        = "SELECT * FROM games";
    $pdo_result = Database::prepare_and_execute($sql);
    $games      = $pdo_result->fetchAll();

    return $games;
}

/* Find a single game row by id.

   Returns an associative array which contains the row data
   or a blank game if no row is found. */
function find_game_by_id($id) {
    $sql        = "SELECT * FROM games WHERE id = :id";
    $pdo_result = Database::prepare_and_execute($sql, ['id' => $id]);

    if ($pdo_result->rowCount() == 1) {
        $game       = $pdo_result->fetch();
    } else {
        $game = blank_game();
    }

    return $game;
}

/* Deletes a row in the game table by id. */
function delete_game_by_id($id) {
    $sql        = "DELETE FROM games WHERE id = :id";
    $pdo_result = Database::prepare_and_execute($sql, ['id' => $id]);
}

/* Creates a new game in the games table by building the appropriate
   SQL INSERT statement.
   Usage:
   $new_game = ['name'             => 'New Game',
                'description'      => 'New Description',
                'min_num_players'  => 2,
                'max_num_players'  => 4,
                'min_play_minutes' => 60,
                'max_play_minutes' =>  120];
   $success = create_game($new_game); */
function create_game($game) {
    $sql  = "INSERT INTO games";
    $sql .= "(name, description, min_num_players, max_num_players, min_play_minutes, max_play_minutes, category_id)";
    $sql .= " VALUES (:name, :description, :min_num_players, :max_num_players, :min_play_minutes, :max_play_minutes, :category_id)";

    return Database::prepare_and_execute($sql, $game);
}

/* Creates a blank game hash with the same keys expected by the
   functions that are defined with a $game parameter. */
function blank_game() {
    return [
        'name'             => '',
        'description'      => '',
        'min_num_players'  => '',
        'max_num_players'  => '',
        'min_play_minutes' => '',
        'max_play_minutes' => '',
        'category_id'      => ''
    ];
}

/* Games that are not coming from the database will not have an id
   key in their hash. These might be games POSTed by the user or
   blank games produced by the above function. */
function is_game_new($game) {
    return !isset($game['id']);
}

/* Builds a hash of sanitized game form data from the POST super global.

   If nothing was provided for a particular input the default will be an empty string.

   Only adds the 'id' key if an id was POSTed.
*/
function sanitized_game_from_post() {
    $game = [
        'name'             => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        'description'      => $_POST['description'], // Unfiltered to allow for WYSIWYG Editor Styles
        'min_num_players'  => filter_input(INPUT_POST, 'min_num_players', FILTER_SANITIZE_NUMBER_INT),
        'max_num_players'  => filter_input(INPUT_POST, 'max_num_players', FILTER_SANITIZE_NUMBER_INT),
        'min_play_minutes' => filter_input(INPUT_POST, 'min_play_minutes', FILTER_SANITIZE_NUMBER_INT),
        'max_play_minutes' => filter_input(INPUT_POST, 'max_play_minutes', FILTER_SANITIZE_NUMBER_INT),
        'category_id'      => filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT)
    ];

    if (isset($_POST['id'])) {
        $game['id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    return $game;
}

/* Returns a string describing the validation error if there is one.

   If the game is valid the function returns false.
*/
function game_validation_error($game) {
    if (strlen($game['name']) == 0) {
        return "A name must be provided.";
    } else if (strlen($game['description']) == 0) {
        return "A description must be provided.";
    } else if (!is_numeric($game['min_num_players']) || ($game['min_num_players'] < 1)) {
        return "The minimum number of players must be greater than 0.";
    } else if (!is_numeric($game['max_num_players']) || ($game['max_num_players'] < 1)) {
        return "The maximum number of players must be greater than 0.";
    } else if ($game['max_num_players'] < $game['min_num_players']) {
        return "The maximum number of players must be greater than or equal to the minimum number of players.";
    } else if (!is_numeric($game['min_play_minutes']) || ($game['min_play_minutes'] < 1)) {
        return "The minimum play time must be greater than 0 minutes.";
    } else if (!is_numeric($game['max_play_minutes']) || ($game['max_play_minutes'] < 1)) {
        return "The maximum play time must be greater than 0 minutes.";
    } else if ($game['max_play_minutes'] < $game['min_play_minutes']) {
        return "The maximum play time must be greater than or equal to the minimum play time.";
    } else if (!isset($game['category_id'])) {
        return "You must specify a category.";
    } else if (isset($game['category_id']) && !is_numeric($game['category_id'])) {
        return "Unrecognized category.";
    } else if (isset($game['id']) && !is_numeric($game['id'])) {
        return "Could not update the specified game.";
    } else {
        return false;
    }
}

/* Dynamically builds a PDO SQL update statement based on the provided $game hash.

   The hash keys must be valid games table columns.

   The $game hash must contain an id key to specific which row to update.

   Usage:

    $updated_game = ['name' => 'Changed',
                    'max_play_minutes' =>  180,
                    'id' => 2];
    $pdo_result = update_game($new_game);

   This would build the following SQL statement:

    UPDATE games SET name = :name, max_play_minutes = :max_play_minutes, id = :id WHERE id = :id

   Which would in turn be bound to the $updated_game data.
*/
function update_game($game) {
    // Being the SQL UPDATE statement
    $sql = "UPDATE games SET ";

    // Add all the "column = :placeholder" parts to the SQL statement
    foreach($game as $column => $value) {
        $sql .= "{$column} = :{$column}, ";
    }

    // Remove the last ", " added above so that we can add the final WHERE clause.
    $sql = substr($sql, 0, count($sql) - 3);
    $sql .= " WHERE id = :id";

    return Database::prepare_and_execute($sql, $game);
}

?>