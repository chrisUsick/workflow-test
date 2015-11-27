<?php

/* Finds all rows in the categories table.

   Returns an array of hashes. */
function find_all_categories() {
    $sql        = "SELECT * FROM categories";
    $pdo_result = Database::prepare_and_execute($sql);
    $categories      = $pdo_result->fetchAll();

    return $categories;
}

/* Find a single category row by id.

   Returns an associative array which contains the row data
   or a blank category if no row is found. */
function find_category_by_id($id) {
    $sql        = "SELECT * FROM categories WHERE id = :id";
    $pdo_result = Database::prepare_and_execute($sql, ['id' => $id]);

    if ($pdo_result->rowCount() == 1) {
        $category = $pdo_result->fetch();
    } else {
        $category = blank_category();
    }

    return $category;
}

/* Deletes a row in the category table by id. */
function delete_category_by_id($id) {
    $sql        = "DELETE FROM categories WHERE id = :id";
    $pdo_result = Database::prepare_and_execute($sql, ['id' => $id]);
}

/* Creates a new category in the categories table by building the appropriate
   SQL INSERT statement.
   Usage:
   $new_category = ['name' => 'New Category'];
   $success = create_category($new_category); */
function create_category($category) {
    $sql  = "INSERT INTO categories (name) VALUES (:name)";

    return Database::prepare_and_execute($sql, $category);
}

/* Creates a blank category hash with the same keys expected by the
   functions that are defined with a $category parameter.
*/
function blank_category() {
    return ['name' => ''];
}

/* Categories that are not coming from the database will not have an
   id key in their hash. These might be games POSTed by the user or
   blank games produced by the above function. */
function is_category_new($category) {
    return !isset($category['id']);
}

/* Builds a hash of sanitized category form data from the POST super global.

   If nothing was provided for a particular input the default will be an empty string.

   Only adds the 'id' key if an id was POSTed. */
function sanitized_category_from_post() {
    $category = ['name' => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS)];

    if (isset($_POST['id'])) {
        $category['id'] = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    return $category;
}

/* Returns a string describing the validation error if there is one.

   If the category is valid the function returns false. */
function category_validation_error($category) {
    if (strlen($category['name']) == 0) {
        return "A name must be provided.";
    } else if (isset($category['id']) && !is_numeric($category['id'])) {
        return "Could not update the specified category.";
    } else {
        return false;
    }
}

/* Dynamically builds a PDO SQL update statement based on the provided $category hash.

   The hash keys must be valid categories table columns.

   The $category hash must contain an id key to specific which row to update.

   Usage:

    $updated_category = ['name' => 'Changed',
                    'max_play_minutes' =>  180,
                    'id' => 2];
    $pdo_result = update_category($new_category);

   This would build the following SQL statement:

    UPDATE categories SET name = :name, max_play_minutes = :max_play_minutes, id = :id WHERE id = :id

   Which would in turn be bound to the $updated_category data. */
function update_category($category) {
    // Being the SQL UPDATE statement
    $sql = "UPDATE categories SET ";

    // Add all the "column = :placeholder" parts to the SQL statement
    foreach($category as $column => $value) {
        $sql .= "{$column} = :{$column}, ";
    }

    // Remove the last ", " added above so that we can add the final WHERE clause.
    $sql = substr($sql, 0, count($sql) - 3);
    $sql .= " WHERE id = :id";

    return Database::prepare_and_execute($sql, $category);
}
?>