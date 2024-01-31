<?php
require_once "includes/database.php";
require_once "includes/header.php";

// get country code from url
$id = $_GET['id'] ?? '1';

// build query
$query = "SELECT * FROM final_review WHERE ID = '$id'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading review.');

// get one record from the database
$addReview = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $addReview['MovieId'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<h1>Add Movie Review</h1>


<?php
// if form was submitted
if(isset($_POST['add'])) {
    // get values from form
    $reviewId = $_POST['ReviewId'] ?? '';
    $movieId = $_POST['MovieId'] ?? '';
    $reviewTitle = $_POST['ReviewTitle'] ?? '';
    $review = $_POST['review'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $firstName = $_POST['FirstName'] ?? '';
    $lastName = $_POST['LastName'] ?? '';

    // TODO: validate inputs

    // query to add record
    $query = "INSERT INTO `final_review` 
        (`ReviewId`, `MovieId`, `ReviewTitle`, `Review`, `Rating`, `FirstName`, `LastName`) 
    VALUES 
        (NULL, '?', '?', '?', '?', '?');";


    $stmt= mysqli_prepare($db, $query) or die ('Invalid query');

    mysqli_stmt_bind_param($stmt,'issi', $reviewId, $movieId, $reviewTitle,$review, $rating , $firstName, $lastName);

    mysqli_stmt_execute($stmt);

    // execute query
    $result = mysqli_query($db, $query) or die("Error adding review.");

    // check if record was added
    // this will give you the id of the record that was just added
    if(mysqli_insert_id($db)){
        // redirect
        header('Location: city.php?id=' . $reviewId);
    }else{
        // TODO: let the user know there was an error
    }
}

// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

<form method="post">
    <p>
        <label for="title">Review Title: </label>
        <input type="text" id="title" name="title">
    </p>
    <p>
        <label for="review">Review: </label>
        <input type="text" id="review" name="review">
    </p>
    <p>
        <label for="movie">Movie: </label>
        <input type="hidden" name="cityId" value="<?= $addReview['MovieId'] ?>">
        <input type="text" id="city" value="<?= $addReview['MovieTitle'] ?>" disabled>
    </p>

    <p>
        <label for="rating">Rating: </label>
        <select id="rating" name="rating">
            <option value="1">⭐️</option>
            <option value="2">&starf;&starf;️</option>
            <option value="3">⭐⭐⭐️</option>
            <option value="4">⭐⭐⭐⭐️</option>
            <option value="5">⭐⭐⭐⭐⭐️</option>
        </select>
    </p>

    <p>
        <label for="first">First Name: </label>
        <input type="text" id="first" name="first">
    </p>

    <p>
        <label for="last">Last Name: </label>
        <input type="text" id="last" name="last">
    </p>
    <p>
        <button type="submit" name="add" class="btn btn-primary">Add Place</button>
    </p>
</form>

</body>
</html>
