<?php
require_once ('core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
$id = $_POST['id'];
$sqlCommand = "SELECT * FROM portfolio WHERE id='$id' LIMIT 1"; 
$query = mysqli_query($connectMe, $sqlCommand) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) { 
    $id = $row["id"];
	$title = $row["title"];
	$description = $row["description"];
	$href = $row["href"];
	$external = $row["external"];
	$alignment = $row["alignment"];
	$data_src = $row["data_src"];
	$placement = $row["placement"];
	$category = $row["category"];
	$img = $row["img"];
} 
mysqli_free_result($query); 
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
	                    <h2 class="members-headers">Edit Portfolio Entry <small>Use the form to edit this portfolio item... .. .</small></h2>
	                    <!-- Start portfolio form -->
	                    <form id="portfolioForm" name="portfolioForm" class="form-horizontal" role="form" action="parsers/edit_portfolio.php" method="post" enctype="multipart/form-data">
	                        <div class="form-group field">
	                            <label for="title" class="col-sm-2 control-label">Title</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="<?php echo escape($title); ?>" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="description" class="col-sm-2 control-label">Description</label>
	                            <div class="col-sm-10">
	                                <textarea name="description" id="description" rows="10" form="portfolioForm" class="form-control" ><?php echo escape($description); ?></textarea>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="href" class="col-sm-2 control-label">HREF</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="href" id="href" class="form-control" placeholder="HREF" value="<?php echo escape($href); ?>" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="external" class="col-sm-2 control-label">External</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="external" id="external" class="form-control" placeholder="External" value="<?php echo escape($external); ?>" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="alignment" class="col-sm-2 control-label">Alignment</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="alignment" id="alignment" class="form-control" placeholder="Alignment" value="<?php echo escape($alignment); ?>" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="data_src" class="col-sm-2 control-label">Data Src</label>
	                            <div class="col-sm-10">
	                                <select name="data_src" id="data_src" class="form-control">
	                            		<option value="holder.js/140x140" selected="selected">holder.js/140x140</option>
	                            	</select>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="placement" class="col-sm-2 control-label">Placement</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="placement" id="placement" class="form-control" placeholder="Placement" value="<?php echo escape($placement); ?>" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="category" class="col-sm-2 control-label">Category</label>
	                            <div class="col-sm-10">
	                            	<select name="category" id="category" class="form-control">
	                            		<?php if($category = 'webdesign') { ?>
											<option value="webdesign" selected="selected">Web Design</option>
		                            		<option value="printdesign">Print Design</option>
		                            		<option value="uxdesign">UX Design</option>
	                            		<?php } elseif ($category = 'printdesign') { ?>
	                            			<option value="webdesign">Web Design</option>
		                            		<option value="printdesign" selected="selected">Print Design</option>
		                            		<option value="uxdesign">UX Design</option>
	                            		<?php } else { ?>
											<option value="webdesign">Web Design</option>
		                            		<option value="printdesign">Graphic Design</option>
		                            		<option value="uxdesign" selected="selected">UX Design</option>
	                            		<?php } ?>
	                            	</select>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="current_img" class="col-sm-2 control-label">Current Image</label>
	                            <div class="col-sm-10">
	                            	<img class="img-responsive img-thumbnail" src="../imgs/<?php echo escape($category); ?>/<?php echo escape($img); ?>" alt="<?php echo escape($title); ?>">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="img" class="col-sm-2 control-label">Replace Image</label>
	                            <div class="col-sm-10">
	                                <input type="file" name="img" id="img">
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="col-sm-offset-2 col-sm-10">
	                            	<input type="hidden" name="id" id="id" value="<?php echo escape($id); ?>">
	                                <button id="signUpBtn" type="submit" name="submit" class="btn btn-default">Update</button>
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