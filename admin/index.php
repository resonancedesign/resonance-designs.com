<?php
// Initialize the application
require_once 'core/init.php';
// Initialize the user class to see if they are logged in
$user = new User();
// Check if the user is logged in
if($user->isLoggedIn()) {
    // Send them to the index page if they are
    Redirect::to('authorized.php');
}
// Create variables to display errors
$loginFailDisplay = "";
$errorMsgsDisplay = "";
// If the form has been submitted
if (Input::exists()) {
    // Check for a session token
	if (Token::check(Input::get('token'))) {
        // If token exists, validate the form values
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));
        // If validation passes
		if ($validation->passed()) {
            // Create a new, user class
			$user = new User();
            // If user requested to be remembered, create a cookie
			$remember = (Input::get('remember') === 'on') ? true : false;
            // Attempt to find username and matching password in the database
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);
            // If username and password combo exists in database, log the user in
			if($login) {
                // On successful login we direct the user to the home page
				Redirect::to('index.php');
            // If username and password combo does not exist in database
			} else {
                // Format the display for incorrect login error
                $loginFailDisplay .= "<p>Sorry, you entered an invalid username and/or password.</p>";
			}
        // If validation does not pass
		} else {
            // Format the display for the validation errors
            $errorMsgsDisplay .= "<ul class='errorList'>";
			foreach ($validation->errors() as $error) {
                $errorMsgsDisplay .= "<li>$error</li>";
			}
            $errorMsgsDisplay .= "</ul>";
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

        <title>Member System - Log In</title>

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
    	<div id="login">
    		<?php include_once 'includes/layout/signed_out_nav.php'; ?>
	        <div class="container-fluid">
	            <!-- Signed out content -->
	            <div class="row-fluid">
	                <div class="col-lg-12 contentArea">
	                    <h2 class="members-headers">Log In <small>Please log in to continue... .. .</small></h2>
	                    <!-- Display incorrect login error if one exists -->
	                    <?php print "<h4 class='errorMsg'>$loginFailDisplay</h4>"; ?>
	                    <!-- Display validation errors is any exist -->
	                    <?php print "<h4 class='errorMsg'>$errorMsgsDisplay</h4>"; ?>
	                    <form id="loginForm" class="form-horizontal" role="form" action="" method="post">
	                        <div class="form-group field">
	                            <label for="username" class="col-sm-2 control-label">Username</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="password" class="col-sm-2 control-label">Password</label>
	                            <div class="col-sm-10">
	                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <div class="col-sm-offset-2 col-sm-10">
	                                <div class="checkbox">
	                                    <label for="remember">
	                                        <input type="checkbox" name="remember" id="remember"> Remember me
	                                    </label>
	                                </div>
	                            </div>
	                        </div>
	                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	                        <div class="form-group">
	                            <div class="col-sm-offset-2 col-sm-10">
	                                <button id="submit" type="submit" name="submit" class="btn btn-default">Sign In</button>
	                            </div>
	                        </div>
	                        <div class="col-sm-offset-2 col-sm-10 forgot">
	                            <a href="forgot-password.php">Forgot password</a> - <a href="forgot-username.php">Forgot username</a>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	        <div id="login-footer">
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
		                                <li class="login-footer"><a href='login.php'>Log In</a></li>
		                                <li class="register-footer"><a href='register.php'>Register</a></li>
		                            </ul>
		                        </div>
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