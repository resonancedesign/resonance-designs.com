<?php
    // Connect to database
    include_once "scripts/resdesign_connect.php";   
    mysql_query("set names 'utf8'");

    $sqlTalks = mysql_query("SELECT * FROM portfolio WHERE category='webdesign' ORDER BY placement ASC");

    $portfolioDisplayList = ""; // Initialize the variable here

    while($row = mysql_fetch_array($sqlTalks)){
        $id = $row["id"];
        $data_src = $row["data_src"];
        $title = $row["title"];
        $href = $row["href"];
        $img = $row["img"];
        $thumb = $row["thumb"];
        $alignment = $row["alignment"];
        $description = $row["description"];
        $portfolioDisplayList .='
            <div class="col-lg-3 ' . $alignment . '">
                <img class="img-responsive" alt="' . $title . '" src="imgs/webdesign/thumbs/' . $thumb . '">
                <h2 class="folio-heading">' . $title . '</h2>
                <p><a class="btn btn-default" href="' . $href . '" role="button">More...</a></p>
            </div>
            <div class="col-lg-4 ' . $alignment . '">
                <p>' . $description . '</p>
            </div>
            <div class="col-lg-5">
                <p><img class="img-responsive img-thumbnail" alt="' . $title . '" src="imgs/webdesign/' . $img . '"></p>
            </div>
        ';
    }
?>
<?php 
    // Connect to database
    include_once "scripts/resdesign_connect_mysqli.php";

    ////////////////////////
    //  INSERT META DATA  //
    ////////////////////////

    // Fetch meta data
    $sqlCommand = "SELECT * FROM meta WHERE page='webdesign_portfolio'"; 
    $query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error()); 
    // Loop through the meta data
    while ($row = mysqli_fetch_array($query)) { 
        $id = $row["id"];
        $title = $row["title"];
        $robots = $row["robots"];
        $keywords = $row["keywords"];
        $author = $row["author"];
        $description = $row["description"];
        $generator = $row["generator"];
    } 
    mysqli_free_result($query); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- meta start -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="<?php echo $robots ?>" />
        <meta name="keywords" content="<?php echo $keywords ?>" />
        <meta name="author" content="<?php echo $author ?>" />
        <meta name="description" content="<?php echo $description ?>" />
        <meta name="generator" content="<?php echo $generator ?>" />
        <title><?php echo $title ?></title>
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

        <!-- Custom styles for this template -->
        <link href="css/carousel.css" rel="stylesheet">
        <link href="css/fonts.css" rel="stylesheet">
    </head>
    
    <body>
        <!-- NAVBAR ================================================== -->
        <?php include_once "includes/main_navigation.php" ?>
        <!-- /.navbar -->

        <!-- Marketing messaging and featurettes ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->
        <div class="container portfolio">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="centered-titles">Portfolio <span class="text-muted">Web Design</span></h1>
                </div>
                
                <?php print "$portfolioDisplayList"; ?>
            </div>
            <!-- /.row -->

            <!-- FOOTER -->
            <?php include_once "includes/footer.php" ?>
            <!-- /.footer -->

        </div>
        <!-- /.container -->


        <!-- Bootstrap core JavaScript ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/bootstrap.min.js"></script>
        <script src="scripts/menu.js"></script>

    </body>
</html>