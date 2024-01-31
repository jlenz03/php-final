

<?php
require_once "includes/header.php";
require_once "includes/database.php";

?>
<body>
<div class="row justify-content-start">
    <div class="col-4">
        <h1>Movie Database</h1>
    </div>
    <div class="col-4">
        <img  class="banner" src="images/lovereview.jpg" alt="guy loving the movie">
    </div>
</div>


</body>
</html>
<?php
// query to rn on the database
//use  title artist and price as ur 3 columns
$sort= $_GET['sort'] ?? 'MovieTitle';

$query= "SELECT final_movie.MovieTitle AS MovieTitle, final_movie.MovieId
        FROM final_movie
        ORDER BY $sort";

// run the query
//$result = @mysqli_query($db, $query) or die('Error in query');
//in development
$result = @mysqli_query($db, $query) or die('Error in query'.mysqli_error($db));
?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th><a href="?sort=MovieTitle"> MovieTitle</a></th>
        <th> Reviews</a></th>

    </tr>
    </thead>
    <tbody>
    <?php
    //loop through results
    //EACH  time mysqli_fetch_array is called, it retrieves the next record
    while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)){
        //$row represents a record in database
        //echo $row['Name'] . '<br>';
        ?>
        <tr>
            <!-- <a href="customer.php?Customer=$row['AlbumTitle'] "> </a>-->
            <td> <?=$row['MovieTitle'] ?> </td>
            <br>
            <td>
                <a href="reviews.php?MovieId=<?= $row['MovieId']?> " class='btn btn-sm btn-secondary'>Reviews</a>
            </td>

        </tr>
        <?php
    }

    //close database connection
    //usually done in footer of page
    mysqli_close($db);
    ?>






</table>
<?php
require_once "includes/footer.php";
?>
