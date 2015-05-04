<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once ('core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
// Connect to database
include_once "core/connect.php";   
mysql_query("set names 'utf8'");

//////////////////////////////
//  PORTFOLIO LIST DISPLAY  //
//////////////////////////////

$sqlTalks = mysql_query("SELECT * FROM portfolio ORDER BY id ASC");

$portfolioDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sqlTalks)) {
    $id = $row["id"];
    $title = $row["title"];
    $placement = $row["placement"];
    $category = $row["category"];
    $portfolioDisplayList .='
        <div class="col-sm-9 table-row">
            ' . $title . ' (' . $category . ')
        </div>
        <div class="col-sm-1">
            <div class="text-center">' . $placement . '</div>
        </div>
        <div class="col-sm-1">
            <form id="editForm" name="editForm" method="post" action="edit_portfolio.php">
                <input type="hidden" name="id" id="id" value="'.$id.'">
                <button id="editBtn" class="center-block" type="submit" name="submit">Edit</button>
            </form>
        </div>
        <div class="col-sm-1">
            <form id="deleteForm" name="deleteForm" method="post" action="delete_portfolio.php">
                <input type="hidden" name="id" id="id" value="'.$id.'">
                <button id="deleteBtn" class="center-block" type="submit" name="submit">Delete</button>
            </form>
        </div>
    ';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta start -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="resonance design, admin, design, development, graphics, html, html5, xhtml, css, richard bakos" />
        <meta name="author" content="Richard Bakos" />
        <meta name="description" content="The administration console for Resonance Design" />
        <meta name="generator" content="Custom CMS by Richard Bakos" />
        <title>Resonance Design - Administration: Admins</title>
        <!-- meta stop -->

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Customized styling -->
        <link href="css/stylized.css" rel="stylesheet">
        <link href="css/toMerge1.css" rel="stylesheet">
        <link href="css/toMerge2.css" rel="stylesheet">
    </head>
    
    <body>
        <!-- NAVBAR ================================================== -->
        <?php include_once "includes/layout/signed_in_nav.php" ?>
        <!-- /.navbar -->

        <!-- Marketing messaging and featurettes ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container-fluid contentArea">
            <div class="row-fluid" id="user-list">
                <div class="col-sm-12">
                    <h1 class="titles text-center">Portfolio Pieces</h1>
                </div>
                <div class="col-sm-9 table-headers table-header-left">
                    Title (Category)
                </div>
                <div class="col-sm-1 table-headers table-header-split text-center">
                    Placement
                </div>
                <div class="col-sm-1 table-headers table-header-split text-center">
                    Edit
                </div>
                <div class="col-sm-1 table-headers text-center table-header-right">
                    Delete
                </div>
                <?php print "$portfolioDisplayList"; ?>
            </div>
            <div class="row-fluid">
                <a href="add_to_portfolio.php" class="titles">
                    <button type="button" class="btn btn-resdes pull-right">Create Portfolio Piece</button>
                </a>
            </div>
        </div>
        <!-- /.container -->

        <!-- FOOTER -->
        <?php include_once "includes/layout/signed_in_footer.php" ?>
        <!-- /.footer -->

        <!-- Bootstrap core JavaScript ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="libs/jquery-1.11.1.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>
        <script src="scripts/main.js"></script>
    </body>
</html>