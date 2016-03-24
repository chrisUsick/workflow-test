<?php
    require('includes\includes.php');

    $get_id = safe_get_id(); // There will only be an id if we are editing.
    $delete_requested = isset($_POST['delete']);

    // Load the category based on...
    if ($_POST) { // ...a POSTed form.
        $category = sanitized_category_from_post();
    } else if ($get_id) {              // ...a GET request with an id parameter.
        $category = find_category_by_id($get_id);
    } else {                           // ...a GET request with no id parameter.
        $category = blank_category();
    }

    // Validation for create and update, but not for delete.
    if ($_POST && !$delete_requested) {
        $validation_error = category_validation_error($category);
    } else {
        $validation_error = false;
    }

    // Process Create, Update or Delete Requests
    if ($_POST && !$validation_error) {
        if (is_category_new($category)) {
            create_category($category);
        } else if ($delete_requested) {
            delete_category_by_id($category['id']);
        } else {
            update_category($category);
        }

        redirect_to('admin.php');
    }

    require('partials\header.php');
?>
<?php if ($validation_error): ?>
    <p class="error"><?=$validation_error ?></p>
<?php endif ?>

<form action="create_or_update_category.php" method="post" role="form">
    <fieldset>
        <?php if (is_category_new($category)): ?>
            <legend>New Category</legend>
        <?php else: ?>
            <legend>Update Category</legend>
        <?php endif ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" id="name" value="<?= $category['name'] ?>">
        </div>
        <?php if (is_category_new($category)): ?>
            <input class="btn btn-primary" type="submit" value="Create Game">
        <?php else: ?>
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <input class="btn btn-primary" type="submit" value="Update Game">
            <input  class="btn  btn-danger" type="submit" name="delete" value="Delete Game" onclick="return confirm('Are you sure you want to delete this category?')">
        <?php endif ?>
    </fieldset>
</form>
<?php require('partials\footer.php'); ?>