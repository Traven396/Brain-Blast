<?php
// Get the ideas
$difficulty_id = filter_input(INPUT_POST, 'difficulty_id', FILTER_VALIDATE_INT);
$idea = filter_input(INPUT_POST, 'actual_idea');
$category = filter_input(INPUT_POST, 'category');

// Validate inputs
if ($difficulty_id == null || $difficulty_id == false ||
        $idea == null || empty($idea) || $category == null || empty($category) ) {
    $error = "Invalid input data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the idea to the database  
    $query = 'INSERT INTO ideas
                 (difficultyID, idea, dateAdded, category)
              VALUES
                 (:difficulty_id, :idea, :dateAdded, :category)';
    $statement = $db->prepare($query);
    $statement->bindValue(':difficulty_id', $difficulty_id);
    $statement->bindValue(':idea', $idea);
	$statement->bindValue(':dateAdded', date("Y-m-d"));
	$statement->bindValue(':category', $category);
    $statement->execute();
    $statement->closeCursor();

    // Display the Idea List page
    include('listView.php');
}
?>