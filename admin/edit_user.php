<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once ('core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('authorized.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			),
			'email' => array(
				'required' => true,
				'min' => 6,
				'max' => 128
			)
		));
		if($validation->passed()) {
			try {
				$user->update(array(
					'name' => Input::get('name'),
					'email' => Input::get('email'),
					'bio' => Input::get('bio')
				));
				Session::flash('home', 'Your details have been updated.');
				Redirect::to('authorized.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
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

        <title>Resonance Design - Administration: Edit User</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/jquiry-ui.min.css" rel="stylesheet">

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
       	<div id="update">
       		<?php include_once 'includes/layout/signed_in_nav.php'; ?>
	        <div class="container-fluid contentArea">
	            <div class="row-fluid">
	            	<div class="col-lg-12">
	            		<ul class="nav nav-tabs" id="editProfileTabs">
	            			<li class="active"><a href="#genInfo" data-toggle="tab" role="tab">General Info</a></li>
	            			<li><a href="#profilePic" data-toggle="tab" role="tab">Profile Pic</a></li>
	            			<li><a href="#bannerPic" data-toggle="tab" role="tab">Banner Pic</a></li>
	            		</ul>
	                    <div class="tab-content">
	                    	<div id="genInfo" class="tab-pane fade active in">
		                    	<h2 class="members-headers">Update<small>Modify the fields below then save to apply changes... .. .</small></h2>
		                    	<!-- Display incorrect login error if one exists -->
		                    	<?php // print "<h4 class='errorMsg'>$loginFailDisplay</h4>"; ?>
		                    	<!-- Display validation errors is any exist -->
		                    	<?php // print "<h4 class='errorMsg'>$errorMsgsDisplay</h4>"; ?>
			                    <form id="updateForm" class="form-horizontal" role="form" action="" method="post">
			                        <div class="form-group field">
			                            <label for="name" class="col-sm-2 control-label">Your Name</label>
			                            <div class="col-sm-10">
			                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" autocomplete="off" value="<?php echo escape($user->data()->name); ?>">
			                            </div>
			                        </div>
			                        <div class="form-group field">
			                            <label for="email" class="col-sm-2 control-label">Your Email</label>
			                            <div class="col-sm-10">
			                                <input type="text" name="email" id="email" class="form-control" placeholder="Password" autocomplete="off" value="<?php echo escape($user->data()->email); ?>">
			                            </div>
			                        </div>
			                        <div class="form-group field">
			                            <label for="bio" class="col-sm-2 control-label">Your Bio</label>
			                            <div class="col-sm-10">
			                                <textarea name="bio" id="bio" rows="10" form="updateForm" class="form-control" ><?php echo escape($user->data()->bio); ?></textarea>
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <div class="col-sm-offset-2 col-sm-10">
			                                <button id="submit" type="submit" name="submit" class="btn btn-default">Update</button>
			                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			                            </div>
			                        </div>
			                    </form>
			                </div>
			                <div id="profilePic" class="tab-pane fade">
			                	<h2 class="members-headers">Profile Pic<small>Browse your computer for an image file then upload to update your profile pic... .. .</small></h2>
		                    	<!-- Display incorrect login error if one exists -->
		                    	<?php // print "<h4 class='errorMsg'>$loginFailDisplay</h4>"; ?>
		                    	<!-- Display validation errors is any exist -->
		                    	<?php // print "<h4 class='errorMsg'>$errorMsgsDisplay</h4>"; ?>
			                    <form id="picForm" class="form-horizontal" role="form" action="parsers/profile_pic.php" method="post" enctype="multipart/form-data">
			                        <div class="form-group field">
			                            <label for="profile_pic" class="col-sm-2 control-label">Profile Pic</label>
			                            <div class="col-sm-10">
			                                <input type="file" name="profile_pic" id="profile_pic" value="<?php echo escape($user->data()->profile_pic); ?>">
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <div class="col-sm-offset-2 col-sm-10">
			                                <button id="submit" type="submit" name="submit" class="btn btn-default">Change Pic</button>
			                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			                                <input type="hidden" name="username" value="<?php escape($user->data()->username); ?>">
			                            </div>
			                        </div>
			                    </form>
			                </div>
			                <div id="bannerPic" class="tab-pane fade">
			                	<h2 class="members-headers">Banner Pic<small>Browse your computer for an image file then upload to update your banner pic... .. .</small></h2>
		                    	<!-- Display incorrect login error if one exists -->
		                    	<?php // print "<h4 class='errorMsg'>$loginFailDisplay</h4>"; ?>
		                    	<!-- Display validation errors is any exist -->
		                    	<?php // print "<h4 class='errorMsg'>$errorMsgsDisplay</h4>"; ?>
			                    <form id="bannerForm" class="form-horizontal" role="form" action="parsers/banner_pic.php" method="post" enctype="multipart/form-data">
			                        <div class="form-group field">
			                            <label for="banner_pic" class="col-sm-2 control-label">Banner Pic</label>
			                            <div class="col-sm-10">
			                                <input type="file" name="banner_pic" id="banner_pic" value="<?php echo escape($user->data()->banner_pic); ?>">
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <div class="col-sm-offset-2 col-sm-10">
			                                <button id="submit" type="submit" name="submit" class="btn btn-default">Change Banner</button>
			                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			                                <input type="hidden" name="username" value="<?php escape($user->data()->username); ?>">
			                            </div>
			                        </div>
			                    </form>
			                </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <?php include_once 'includes/layout/signed_in_footer.php' ?>
	    </div>
	    
        <!-- Load libraries -->
        <script src="libs/jquery-1.11.1.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>

        <!-- Load scripts -->
		<script src="scripts/main.js"></script>
	</body>
</html>