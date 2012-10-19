<?php
require_once('models/Controllers.php');
require_once('models/front.php');

require_once('models/view.php');

require_once('controllers/index.php');

$front = FrontController::getInstance();
$front->route();
$front->run();