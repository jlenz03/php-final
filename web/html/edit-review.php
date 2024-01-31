<?php
require_once "includes/header.php";
require_once "includes/database.php";

// get country code from url
$id = $_GET['id'] ?? '1';

// build query
$query = "SELECT final_review.*, final_movie.MovieTitle AS MovieTitle
                FROM final_review 
                JOIN final_movie ON final_review.MovieId = final_movie.MovieId
                WHERE final_movie.MovieId = '$id'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading review.');

// get one record from the database
$movieTitle = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit <?= $movieTitle['MovieTitle'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<h1>Edit Review</h1>


<?php
// if form was submitted
if(isset($_POST['update'])) {
    // get values from form
    $reviewId = $_POST['ReviewId'] ?? '';
    $title = $_POST['ReviewTitle'] ?? '';
    $review = $_POST['Review'] ?? '';
    $rating = $_POST['Rating'] ?? '';
    $movieId = $_POST['MovieId'] ?? '';

    // TODO: validate inputs

    // query to add record
    $query = "UPDATE `final_review` SET 
                       `Title` = '$title', 
                       `Review` = '$review', 
                       `Rating` = '$rating' 
                WHERE `final_review`.`MovieId` = $movieId;";

    // execute query
    $result = mysqli_query($db, $query) or die("Error updating review.");

    // check if record was edited
    //if(mysqli_affected_rows($db)){
    // redirect
    header('Location: reviews.php?id=' . $movieId);
    //}
}

// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

<form method="post">
    <p>
        <label for="name">Review Title: </label>
        <input type="text" id="title" name="title" value="<?= $movieTitle['ReviewTitle'] ?>">
    </p>
    <p>
        <label for="review">Review: </label>
        <input type="text" id="review" name="review" value="<?= $movieTitle['Review'] ?>">
    </p>
    <p>
        <label for="id">Movie: </label>
        <input type="hidden" name="reviewId" value="<?= $movieTitle['ReviewId'] ?>">
        <input type="text" id="title" value="<?= $movieTitle['MovieTitle'] ?>"disabled>
    </p>

    <p>
        <label for="rating">Rating: </label>
        <select id="rating" name="rating">
            <option value="1" <?= $movieTitle['Rating'] == 1 ? 'selected' : '' ?>>⭐️</option>
            <option value="2" <?= $movieTitle['Rating'] == 2 ? 'selected' : '' ?>>&starf;&starf;️</option>
            <option value="3" <?= $movieTitle['Rating'] == 3 ? 'selected' : '' ?>>⭐⭐⭐️</option>
            <option value="4" <?= $movieTitle['Rating'] == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐️</option>
            <option value="5" <?= $movieTitle['Rating'] == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐️</option>
        </select>
    </p>
    <p>
        <input type="hidden" name="movieId" value="<?= $movieTitle['MovieId'] ?>">
        <button type="submit" name="update" class="btn btn-primary">Update Review</button>
    </p>
</form>

</body>
</html>

