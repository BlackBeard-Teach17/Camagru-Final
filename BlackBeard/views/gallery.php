<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Config/database.php';

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $dbh->prepare("SELECT images.image_id,images.image, COUNT(likes.like_id) AS likes,
                    GROUP_CONCAT(users.Username SEPARATOR '|') AS liked_by FROM images LEFT JOIN likes
                    ON images.image_id = likes.image_id LEFT JOIN users
                    ON likes.user = users.Username GROUP BY images.image_id
                    ");
/*SELECT statement selects image_id and the image from the images table**
COUNT statement counts the number of unique like_ids from the likes table-> AS statement
gives a column in a table a temporary name e.g COUNT(likes.like_id)is a column name
and its temporary name is likes...Removing AS likes does not change the functionality but
complicates things e.g wherever you see variable "likes" below it will have to be replaced
by COUNT(likes.like_id)*********
LEFT JOIN(joins using the relationship between the 2 table, what they have in common) will select any images that might have

*/
$sql->execute();

while ($result = $sql->fetch(PDO::FETCH_ASSOC))
{
    $result['liked_by'] = $result['liked_by'] ? explode('|', $result['liked_by']) : [];
    $img[] = $result;
}
?>

<?php
// session_start();
require_once('../Config/database.php');

$name =$_SESSION['username'];

if (isset($_GET['page']) && $_GET['page'] >= 5) {
    $curpage = $_GET['page'];
} else {
    $curpage = 0;
}

$result;
$lyk;


//echo $count_page['total'];

    try {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $count_page = $conn->query("SELECT COUNT(*) FROM `images`", PDO::FETCH_ASSOC)->fetchColumn();

        if ($count_page == 0)
        {
            echo "";
        }
        else
            {
            if ($curpage < $count_page) {
                $result = $conn->query("SELECT * FROM `images`ORDER BY date_added DESC LIMIT 5 OFFSET $curpage", PDO::FETCH_ASSOC);
            } else {
                $curpage = $curpage - 5;
                $result = $conn->query("SELECT * FROM `images`ORDER BY date_added DESC LIMIT 5 OFFSET $curpage", PDO::FETCH_ASSOC);
            }
            $lyk = $conn->query("SELECT * FROM `likes`", PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo "ERROR EXECUTING: \n" . $e->getMessage();

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Fredericka+the+Great|Monoton|VT323" rel="stylesheet">
    <link href="../styles/styles.css" rel="stylesheet">
    <style>
        body{
            font-family: 'Fredericka the Great', cursive;
            background-color: silver;
        }
        .main {
            margin-left: 20%;
            margin-right: 20%;
        }
        .page
        {
            margin-bottom: 10%;
            margin-left: 40%;
            color: ;
            text-blink: 0.1s;
            letter-spacing: 3px;
        }
        h1
        {
            text-align: center;
            font-family: 'Fredericka the Great', cursive;
            font-size: 200%;
            font-weight: normal;
        }
        h2
        {
            text-align: center;
            font-family: 'Fredericka the Great', cursive;
            text-color: red;
        }

    </style>
</head>
<body>
<header style="display: flex;">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
    <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="cam.php"><i class="fa fa-camera-retro"></i> Camera</a>
    <a href="../functions/logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
    </div>
</header>
<h1 class="Head"> Gallery</h1>
<div id="main" class="main"> 
<?php
    if ($result)
        foreach ($result as $row) {
            $count =0;
            $lyk1 = $conn->query("SELECT * FROM `likes`", PDO::FETCH_ASSOC);

            ?>
            <p style="color: black">Posted by <?php echo $row['user']?></p>
            <img id="e1" src=<?= $row['image']; ?> width="50%%" height="50%">

            <?php foreach ($lyk1 as $pic) {
                if ($pic['image_id'] == $row['image_id']) {
                    $count++;
                }
            }
            ?>
            <div class="pic">
            </div>
           <p><button><a class="fa fa-thumbs-up" aria-hidden="true"
                       href="../functions/like.php?type=image&image_id=<?php echo $row['image_id']; ?>"></a>
            </button>
            <b><?php echo $count; ?> people like this picture</b></p>
            <div class="comment-box">
                <?php
                $id = $row['image_id'];
                $sql = $dbh->prepare("SELECT * FROM comments WHERE image_id=:image_id ORDER BY date_added ASC ");
                $sql->execute(array(':image_id' => $id));
                $comments = $sql->fetchAll();
                echo '<table><ul style="list-style-type: none">';
                for ($j = 0; $j < sizeof($comments); $j++) {
                    //Store the comment in a 2d array
                    $comment = $comments[$j]['comment'];//Column in DB where comment is.
                    $comment_by = $comments[$j]['Username'];
                    echo '
						<tr style="background-color: whitesmoke">
						<td><li style="list-style-type: none; text-decoration-color: deepskyblue"><i class="fa fa-comment-alt"></i> '
                        . $comment_by .//Display username of the commenter
                        ' - </li><td>'
                        . $comment .// Display the comment
                        '</td>' .
                        '</td>
						</tr>
						';
                }
                echo '
					</ul></table>
					';
                ?>
            </div>
            <form action="../functions/comments.php" id="commentform" method="POST">
                <input type="hidden" value="<?php echo $row['image_id']; ?>" name="image_id">
                <textarea name="comment_txt" placeholder="Comment on picture"></textarea>
                <input type="submit">
            </form>
           <?php
        }
    else
        echo "<h2>Gallery Empty<h2>";
    ?>
</div>
<div class="page">
    <li style="list-style-type: none ; " class="page-item">Next Page<a class="page-link" href="?page=<?php echo $curpage+5?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
    <li style="list-style-type: none" class="page-item">Previous Page<a class="page-link" href="?page=<?php if ($curpage != 0) echo $curpage-5; else echo $curpage; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
</div>
<div class="block"></div>
<div class="footer">
    <p>kmfoloe&trade;-Camagru 2018&copy;</p>
</div>
<script src="../javascript/Menu_items.js">
</script>
</body>
</html>