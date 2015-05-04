<?php
require_once ('core/init.php');

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$href = $_POST['href'];
$external = $_POST['external'];
$alignment = $_POST['alignment'];
$data_src = $_POST['data_src'];
$placement = $_POST['placement'];
$category = $_POST['category'];

$query = mysqli_query($connectMe, "UPDATE portfolio SET title='$title', description='$description', href='$href', external='$external', alignment='$alignment', data_src='$data_src', placement='$placement', category='$category' WHERE id='$id'") or die (mysqli_error($connectMe));

function GetImageExtension($imagetype) {
	if(empty($imagetype)) return false;
	switch ($imagetype) {
		case 'image/bmp': return '.bmp';
		case 'image/gif': return '.gif';
		case 'image/jpeg': return '.jpg';
		case 'image/png': return '.png';
		default: return false;
	}
}

if (!empty($_FILES['img']['name'])) {
	$file_name = $_FILES['img']['name'];
	$temp_name = $_FILES['img']['tmp_name'];
	$imgtype = $_FILES['img']['type'];
	$ext = GetImageExtension($imgtype);
	$imagename = $_FILES['img']['name'];
	$target_path = '../../imgs/'.$category.'/'.$imagename;

	if (move_uploaded_file($temp_name, $target_path)) {
		$query = mysqli_query($connectMe, "UPDATE portfolio SET img='$imagename' WHERE id='$id'") or die (mysqli_error($connectMe));
		Redirect::to('../pic_updated.php');
	} else {
		Redirect::to('../upload_error.php');
		// exit("Error while uploading image on the server.");
	}
}
Redirect::to('../pic_updated.php');
?>