<?PHP 
$to = "resonancedesign.org@gmail.com"; 
$subject = "Results from your Resonance Design e-mail form";
$headers = "From: Resonance Design";
$forward = 1;
$location = "http://www.resonancedesign.org/thanks.php";

$date = date ("l, F jS, Y"); 
$time = date ("h:i A"); 



$msg = "Below is the result of your e-mail form from resonancedesign.org It was submitted on $date at $time.\n\n"; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	foreach ($_POST as $key => $value) { 
		$msg .= ucfirst ($key) ." : ". $value . "\n"; 
	}
}
else {
	foreach ($_GET as $key => $value) { 
		$msg .= ucfirst ($key) ." : ". $value . "\n"; 
	}
}

mail($to, $subject, $msg, $headers); 
if ($forward == 1) { 
    header ("Location:$location"); 
} 
else { 
    echo "Thank you for your interest. We will get back to you as soon as possible."; 
} 

?>