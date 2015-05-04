<?php
include_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'existing_password' => array(
				'required' => true,
				'min' => 6
			),
			'new_password' => array(
				'required' => true,
				'min' => 6
			),
			'new_password_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'new_password'
			)
		));
		if($validation->passed()) {
			if(Hash::make(Input::get('existing_password'), $user->data()->salt) !== $user->data()->password) {
				echo "Your current password is wrong.";
			} else {
				try {
					$salt = Hash::salt(32);
					$user->update(array(
						'password' => Hash::make(Input::get('new_password'), $salt),
						'salt' => $salt
					));
					Session::flash('home', 'Your password has been changed!');
					Redirect::to('index.php');
				} catch(Exception $e) {
					die($e->getMessage());
				}
				
			}
		} else {
			foreach ($validation->errors() as $error) {
				echo $error, "<br>";
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

        <title>Member System - Profile</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Customized styling -->
        <link href="css/stylized.css" rel="stylesheet">
    </head>
    <body>
       	<div id="userpass">
       		<?php include_once 'includes/layout/signed_in_nav.php'; ?>
	        <div class="container-fluid contentArea">
	            <div class="row-fluid">
	            	<div class="col-lg-12">
	                    <h2 class="members-headers">Change Password<small>Fill in the form below to change your password... .. .</small></h2>
	                    <!-- Display incorrect login error if one exists -->
	                    <?php // print "<h4 class='errorMsg'>$loginFailDisplay</h4>"; ?>
	                    <!-- Display validation errors is any exist -->
	                    <?php // print "<h4 class='errorMsg'>$errorMsgsDisplay</h4>"; ?>

						<form id="passwordForm" class="form-horizontal" role="form" action="" method="post">
	                        <div class="form-group field">
	                            <label for="existing_password" class="col-sm-2 control-label">Current Password</label>
	                            <div class="col-sm-10">
	                                <input type="password" name="existing_password" id="existing_password" class="form-control" placeholder="Current Password" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="new_password" class="col-sm-2 control-label">New Password</label>
	                            <div class="col-sm-10">
	                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="new_password_again" class="col-sm-2 control-label">New Password Again</label>
	                            <div class="col-sm-10">
	                                <input type="password" name="new_password_again" id="new_password_again" class="form-control" placeholder="New Password Again" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <div class="col-sm-offset-2 col-sm-10">
	                                <button id="submit" type="submit" name="submit" class="btn btn-default">Change</button>
	                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	                            </div>
	                        </div>
	                        <div class="col-sm-offset-2 col-sm-10 forgot">
	                            <a href="forgot-password.php">Forgot password</a> - <a href="forgot-username.php">Forgot username</a>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div id="userpass-footer">
        	<div class='navbar-wrapper'>
	            <div class='container-fluid'>
	                <div id='main-nav' class='navbar-fluid navbar-inverse navbar-fixed-bottom' role='navigation'>
	                    <div class='container-fluid'>
	                        <div class='navbar-header'>
	                            <div id='logoText'>Member<span class='logoText-smaller'>System</span></div>
	                        </div>
	                        <div class="txt-vert-cntr">
	                            <div class="pull-right"><a href="#">Back to top</a></div>
	                            <div class="pull-right copyright">&copy; 2014 Resonance Design</div>
	                        </div>
	                        <div class='navbar-collapse collapse'>
	                            <ul class='nav navbar-nav'>
	                                <li class="profile-footer"><a href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a></li>
			                        <li class="update-footer"><a href="update.php">Update</a></li>
			                        <li class="userpass-footer"><a href="userpass.php">Change password</a></li>
			                        <li class="logout-footer"><a href="logout.php">Log out</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- Load libraries -->
        <script src="libs/jquery-1.11.1.min.js"></script>
        <script src="libs/bootstrap.min.js"></script>

        <!-- Load scripts -->
        <script src="scripts/main.js"></script>
	</body>
</html>