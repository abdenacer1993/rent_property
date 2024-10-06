<?php
if($_FILES['fileToUpload']['name'] !='')
{
	$test = explode(".", $_FILES['fileToUpload']['name']);
	$extension = end($test);
	$name = rand(1, 900000) . '.' . $extension;
	$location = "./img/imglocale/".$name;
	move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $location);
	echo '<img src="'.$location.'" height="200" width="200" class="img-thumbnail"/>';
}

?>