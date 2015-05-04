<?php
    // Connect to database
    include_once "scripts/resdesign_connect.php";   
    mysql_query("set names 'utf8'");

    /////////////////////////
    //  INDICATOR DISPLAY  //
    /////////////////////////

    // Fetch indicator data
    $sqlTalks = mysql_query("SELECT id, indicator, active FROM carousel ORDER BY id ASC");
    // Initialize the variable to display all the indicators here
    $indicatorDisplayList = ""; 
    // Loop through the indicator data
    while($row = mysql_fetch_array($sqlTalks)){
        $id = $row["id"];
        $indicator = $row["indicator"];
        $active = $row["active"];
        // Format and display all the indicators to the user
        $indicatorDisplayList .= '
            <li data-target="#myCarousel" data-slide-to="' . $indicator . '" class="indicator ' . $active . '"></li>
        ';
    }

    ////////////////////////
    //  CAROUSEL DISPLAY  //
    ////////////////////////

    // Fetch carousel data
    $sqlTalks = mysql_query("SELECT id, img, class, slide, title, caption, button_text, indicator, active FROM carousel ORDER BY indicator ASC");
    // Initialize the variable to display the carousel items here
    $carouselDisplayList = "";
    // Loop through the carousel data
    while($row = mysql_fetch_array($sqlTalks)){
        $id = $row["id"];
        $img = $row["img"];
        $class = $row["class"];
        $slide = $row["slide"];
        $title = $row["title"];
        $caption = $row["caption"];
        $button_text = $row["button_text"];
        $active = $row["active"];
        // Format and display all the carousel items to the user
        $carouselDisplayList .= '
            <div class="item ' . $active . '">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:' . $slide . '">
                <div class="container">
                    <div class="carousel-caption">
                        <img class="carousel-img ' . $class . '" src="imgs/carousel/' . $img . '">
                        <h1>' . $title . '</h1>
                        <p>' . $caption . '</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">' . $button_text . '</a></p>
                    </div>
                </div>
            </div>
        ';
    }

    ////////////////////////////////////
    //  PORTFOLIO CATEGORIES DISPLAY  //
    ////////////////////////////////////

    // Fetch portfolio category data
    $sqlTalks = mysql_query("SELECT id, data_src, title, caption, img, href, button_text FROM portfolio_cats ORDER BY id ASC");
    // Initialize the variable to display the portfolio categories here
    $portfolioCatDisplayList = "";
    // Loop through the portfolio category data
    while($row = mysql_fetch_array($sqlTalks)){
        $id = $row["id"];
        $data_src = $row["data_src"];
        $title = $row["title"];
        $caption = $row["caption"];
        $img = $row["img"];
        $href = $row["href"];
        $button_text = $row["button_text"];
        // Format and display all the portfolio categories to the user
        $portfolioCatDisplayList .= '
            <div class="col-lg-4">
                <img alt="140x140" data-src="' . $data_src . '" class="img-circle" style="width: 140px; height: 140px;" src="' . $img . '">
                <h2 class="folio-heading">' . $title . '</h2>
                <p>' . $caption . '</p>
                <p><a class="btn btn-default" href="' . $href . '" role="button">' . $button_text . '</a></p>
            </div>
        ';
    }

    ///////////////////////////////
    //  LATEST PROJECTS DISPLAY  //
    ///////////////////////////////

    // Fetch portfolio category data
    $sqlTalks = mysql_query("SELECT id, heading, sub_heading, caption, data_src, img, href FROM latest_projects ORDER BY id ASC");
    // Initialize the variable to display the portfolio categories here
    $latestProjectsDisplayList = "";
    // Loop through the portfolio category data
    while($row = mysql_fetch_array($sqlTalks)){
        $id = $row["id"];
        $heading = $row["heading"];
        $sub_heading = $row["sub_heading"];
        $caption = $row["caption"];
        $data_src = $row["data_src"];
        $img = $row["img"];
        $href = $row["href"];
        // Format and display all the portfolio categories to the user
        $latestProjectsDisplayList .= '
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">' . $heading . '<span class="text-muted">' . $sub_heading . '</span></h2>
                    <p class="lead">' . $caption . '</p>
                </div>
                <div class="col-md-5">
                    <a href="' . $href . '">
                        <img alt="500x500" data-src="' . $data_src . '" class="featurette-image img-responsive" src="' . $img . '">
                    </a>
                </div>
            </div>

            <hr class="featurette-divider">
        ';
    }

    // Connect to database
    include_once "scripts/resdesign_connect_mysqli.php";

    ////////////////////////
    //  INSERT META DATA  //
    ////////////////////////

    // Fetch meta data
    $sqlCommand = "SELECT * FROM meta WHERE page='home'"; 
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

        <!-- Carousel ================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php print "$indicatorDisplayList"; ?>
            </ol>
            <!-- /.indicators -->

            <!-- Rotator -->
            <div class="carousel-inner">
                <?php print "$carouselDisplayList"; ?>
            </div>
            <!-- /.rotator -->

            <!-- Navigation -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            <!-- /.navigation -->
        </div>
        <!-- /.carousel -->

        <!-- Marketing messaging and featurettes ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="centered-titles">Portfolio</h1>
                </div>
                
                <?php print "$portfolioCatDisplayList"; ?>
            </div>
            <!-- /.row -->

            <!-- START THE FEATURETTES -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="centered-titles">Lastest Projects</h1>
                </div>
            </div>

            <?php print "$latestProjectsDisplayList"; ?>
            <!-- /END THE FEATURETTES -->


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