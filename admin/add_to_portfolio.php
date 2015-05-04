<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once ('core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
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

        <title>Resonance Design - Administration: Create Portfolio Piece</title>

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
        <div id="register">
        	<?php include_once 'includes/layout/signed_in_nav.php'; ?>
	        <div class="container-fluid">
	            <!-- Signed out content -->
	            <div class="row-fluid">
	                <div class="col-lg-12 contentArea">
	                    <h2 class="members-headers">Create Portfolio Entry <small>Use the form to add an item to the portfolio... .. .</small></h2>
	                    <div id="errorMsgs">
	                    	<!-- Display incorrect login error if one exists -->
		                    <h4 class="errorMsg" style="display:none;"><?php print $registeredDisplay; ?></h4>
		                    <!-- Display validation errors is any exist -->
		                    <h4 class="errorMsg" style="display:none;"><?php print $errorMsgsDisplay; ?></h4>
	                    </div>
	                    

	                    <!-- Start portfolio form -->
	                    <form id="portfolioForm" name="portfolioForm" class="form-horizontal" role="form" action="parsers/add_to_portfolio.php" method="post" enctype="multipart/form-data">
	                        <div class="form-group field">
	                            <label for="title" class="col-sm-2 control-label">Title</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="description" class="col-sm-2 control-label">Description</label>
	                            <div class="col-sm-10">
	                                <textarea name="description" id="description" rows="10" form="portfolioForm" class="form-control" ></textarea>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="href" class="col-sm-2 control-label">HREF</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="href" id="href" class="form-control" placeholder="HREF" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="external" class="col-sm-2 control-label">External</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="external" id="external" class="form-control" placeholder="External" value="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="alignment" class="col-sm-2 control-label">Alignment</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="alignment" id="alignment" class="form-control" placeholder="Alignment" value="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="placement" class="col-sm-2 control-label">Placement</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="placement" id="placement" class="form-control" placeholder="Placement" value="" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="category" class="col-sm-2 control-label">Category</label>
	                            <div class="col-sm-10">
	                            	<select name="category" id="category" class="form-control">
	                            		<option value="webdesign">Web Design</option>
	                            		<option value="printdesign">Graphic Design</option>
	                            		<option value="uxdesign">UX Design</option>
	                            	</select>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="img" class="col-sm-2 control-label">Image</label>
	                            <div class="col-sm-10">
	                                <input type="file" name="img" id="img">
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="col-sm-offset-2 col-sm-10">
	                                <button id="signUpBtn" type="submit" name="submit" class="btn btn-default">Create</button>
	                            </div>
	                        </div>
	                    </form>
	                    <!-- End portfolio form -->
	                </div>
	            </div>
	        </div>
	        <?php include_once 'includes/layout/signed_in_footer.php'; ?>
	    </div>
        <!-- Load libraries -->
        <script src="libs/jquery-1.11.1.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>

        <!-- Load scripts -->
        <script src="scripts/main.js"></script>
    </body>
</html>