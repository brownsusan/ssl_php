<?php
protector::protect();


if(
	empty($_POST['category'])
){
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}



$userId = $_SESSION['user']['userId'];
$title = $_POST['category'];

// this will eventually come from a database
$category_model = new categoryModel();
//This variable stores what is returned from the getNote function ($obj)
$category = $category_model -> createCategory($userId, $title);
//header does a redirect - changing the view back to notes
header('Location: '.$GLOBALS['web_root'].'?action=notes');