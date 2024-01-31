<?php
require_once "includes/database.php";

// get country code from url
$id = $_GET['id'] ?? '1';

// build query
$query = "SELECT final_review.*, final_movie.MovieTitle AS MovieTitle
                FROM final_review 
                JOIN final_movie ON final_review.MovieId = final_movie.MovieId
                WHERE final_movie.MovieId = '$id'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading city.');

// get one record from the database
$title = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete <?= $title['ReviewTitle'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<h1>Delete Review</h1>


<?php
// if form was submitted
if(isset($_POST['delete'])) {
    // get values from form
    $reviewId = $_POST['ReviewId'] ?? '';

    // TODO: validate inputs

    // query to add record
    $query = "DELETE FROM `final_review` 
                WHERE `final_review`.`ReviewId` = $reviewId
                LIMIT 1;";

    // execute query
    $result = mysqli_query($db, $query) or die("Error deleting review.");

    // check if record was edited
    //if(mysqli_affected_rows($db)){
    // redirect
    header('Location: reviews.php?id=' . $title['ReviewId']);
    //}
}

// close database connection (put in footer to avoid doing multiple times)
mysqli_close($db);
?>

<form method="post">
    <p>Are you sure you want to delete "<?= $title['ReviewTitle'] ?>" from <?= $title['MovieTitle'] ?>?</p>
    <p>
        <input type="hidden" name="cityPlaceId" value="<?= $title['ReviewId'] ?>">
        <button type="submit" name="delete" class="btn btn-danger">Delete Place</button>
    </p>
</form>

</body>
</html>

