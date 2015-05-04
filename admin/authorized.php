<?php
require_once ('core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
require_once "core/connect.php";   
mysql_query("set names 'utf8'");

/////////////////////////////////////
//  SITE ADMIN CATEGORIES DISPLAY  //
/////////////////////////////////////

// "Site" Category Items
$sqlTalks = mysql_query("SELECT * FROM admin_categories WHERE category='site' ORDER BY placement ASC");

$siteCatDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sqlTalks)) {
    $id = $row["id"];
    $title = $row["title"];
    $description = $row["description"];
    $helper = $row["helper"];
    $href = $row["href"];
    $img = $row["img"];
    $siteCatDisplayList .='
        <div class="col-sm-2 portfolio-item">
            <a href="' . $href . '" target="_blank">
                <img class="img-responsive" src="imgs/' . $img . '" alt="' . $helper . '">
            </a>
            <a href="' . $href . '"><h3>' . $title . '</a><br>
                <span class="muted-text">' . $description . '</span>
            </h3>
        </div>
    ';
}

// "Sesrver" Category Items
$sqlTalks = mysql_query("SELECT * FROM admin_categories WHERE category='server' ORDER BY placement ASC");

$serverCatDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sqlTalks)) {
    $id = $row["id"];
    $title = $row["title"];
    $description = $row["description"];
    $helper = $row["helper"];
    $href = $row["href"];
    $img = $row["img"];
    $serverCatDisplayList .='
        <div class="col-sm-2 portfolio-item">
            <a href="' . $href . '" target="_blank">
                <img class="img-responsive" src="imgs/' . $img . '" alt="' . $helper . '">
            </a>
            <a href="' . $href . '" target="_blank"><h3>' . $title . '</a><br>
                <span class="muted-text">' . $description . '</span>
            </h3>
        </div>
    ';
}

// "Office" Category Items
$sqlTalks = mysql_query("SELECT * FROM admin_categories WHERE category='office' ORDER BY placement ASC");

$officeCatDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sqlTalks)) {
    $id = $row["id"];
    $title = $row["title"];
    $description = $row["description"];
    $helper = $row["helper"];
    $href = $row["href"];
    $img = $row["img"];
    $officeCatDisplayList .='
        <div class="col-sm-2 portfolio-item">
            <a href="' . $href . '" target="_blank">
                <img class="img-responsive" src="imgs/' . $img . '" alt="' . $helper . '">
            </a>
            <a href="' . $href . '"><h3>' . $title . '</a><br>
                <span class="muted-text">' . $description . '</span>
            </h3>
        </div>
    ';
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="ico/favicon.ico">

        <title>Resonance Design - Administration: Hello <?php echo escape($user->data()->username); ?></title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

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
        <div id="index">
	        <?php
	        // If user is currently in a session, send them to the home page
	        if(Session::exists('home')) {
	            echo "
	                <div class='container'>
	                    <div class='row'>
	                        <div class='col-lg-12 contentArea'>"
	                            . Session::flash('home') . 
	                        "</div>
	                    </div>
	                </div>
	            ";
	        }
	        $user = new User();
	        // User is logged in to the system
	        if($user->isLoggedIn()) {        
	            // If user is signed in, display the following HTML -->
	            include_once "includes/layout/signed_in_nav.php";
	            include_once "includes/layout/signed_in_content.index.php";
	            include_once "includes/layout/signed_in_footer.php";
	        } else { 
	            // Is user is not signed in, display the following HTML
	            include_once "includes/layout/signed_out_nav.php";
	            include_once "includes/layout/signed_out_content.index.php";
	            include_once "includes/layout/signed_out_footer.php";
	        }
	        ?>
	    </div>
        <!-- Load libraries -->
        <script src="libs/jquery-1.11.1.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>

        <!-- Load scripts -->
        <script src="scripts/main.js"></script>
    </body>
</html>