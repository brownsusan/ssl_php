<?php

protector::protect();

// create the view model so we can use it to load views
$viewModel = new viewModel();

// create an object (assosiative array) to pass to the header view
$data = $_SESSION['user'];

$viewModel -> getView('views/template/app-header.php', $data);
$viewModel -> getView('views/account/body.php', $data);
$viewModel -> getView('views/template/foot.php');


