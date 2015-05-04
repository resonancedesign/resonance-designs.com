<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once ('core/init.php');

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
// Create variables for backup error msgs if ajax fails and for successful registration
$registeredDisplay = "";
$errorMsgsDisplay = "";
if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 5,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 8
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'email' => array(
                'required' => true,
                'max' => 128
            ),
            'country' => array(
            	'required' => true
            ),
            'terms' => array(
            	'required' => true
            )
        ));
        if($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);
            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'country' => Input::get('country'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1
                ));
                $registeredDisplay .= "You have successfully created a new user. Please keep the login credentials in a safe location.";
            } catch(Exception $e) {
                die($e->getMessage());
            }
            $newDir = new NewDir('users/' . Input::get('username'));
            $newDir->createImageDirectory();
            $newDir->createThumbDirectory();
        } else {
            $errorMsgsDisplay .= "<ul id='errorList' class='errorList'>";
            foreach ($validation->errors() as $error) {
            	include ("includes/language/errors.php");
                $errorMsgsDisplay .= "<li class='errors'>$error</li>";
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

        <title>Resonance Design - Administration: Create User</title>

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
	                    <h2 class="members-headers">Create User <small>Create a user account... .. .</small></h2>
	                    <div id="errorMsgs">
	                    	<!-- Display incorrect login error if one exists -->
		                    <h4 class="errorMsg" style="display:none;"><?php print $registeredDisplay; ?></h4>
		                    <!-- Display validation errors is any exist -->
		                    <h4 class="errorMsg" style="display:none;"><?php print $errorMsgsDisplay; ?></h4>
	                    </div>
	                    

	                    <!-- Start register form -->
	                    <form id="registerForm" class="form-horizontal" role="form" action="" method="post">
	                        <div class="form-group field">
	                            <label for="username" class="col-sm-2 control-label">Username</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off" onblur="checkusername()" onkeyup="restrict('username')" maxlength="20">
	                                <span id="unamestatus"></span>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="password" class="col-sm-2 control-label">Password</label>
	                            <div class="col-sm-10">
	                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" onfocus="emptyElement('status')" maxlength="32">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="password_again" class="col-sm-2 control-label">Retype Password</label>
	                            <div class="col-sm-10">
	                                <input type="password" name="password_again" id="password_again" class="form-control" placeholder="Retype Password" autocomplete="off" onfocus="emptyElement('status')" maxlength="32">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="name" class="col-sm-2 control-label">Your Name</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="email" class="col-sm-2 control-label">Your Email</label>
	                            <div class="col-sm-10">
	                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="128">
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <label for="country" class="col-sm-2 control-label">Country</label>
	                            <div class="col-sm-10">
	                            	<select name="country" id="country" class="form-control" onfocus="emptyElement('status')">
	                            		<option value="United States of America">United States of America</option>
	                            		<?php include_once("template_country_list.php"); ?>
	                            	</select>
	                            </div>
	                        </div>
	                        <div class="form-group field">
	                            <div class="col-sm-offset-2 col-sm-10">
	                                <div class="checkbox">
	                                    <label for="terms">
	                                        <input type="checkbox" name="terms" id="terms">I agree to the <a href="#" id="openTerms">Terms Of Use</a>.
	                                    </label>
	                                    <div id="termsContent">
		      								<h4>Member System Terms Of Use</h4>
		      								<ol>
		      									<li>You could create whatever terms you wish</li>
		      									<li>This is just an example:</li>
		      									<li>You may not use this service to collect information on others for the purpose of spamming.</li>
		      								</ol>
		    							</div>
	                                </div>
	                            </div>
	                        </div>
	    					
	                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	                        <div class="form-group">
	                            <div class="col-sm-offset-2 col-sm-10">
	                                <button id="signUpBtn" type="submit" name="submit" class="btn btn-default">Register</button>
	                            </div>
	                            <span id="status"></span>
	                        </div>
	                    </form>
	                    <!-- End register form -->
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