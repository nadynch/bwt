<?php
require_once 'config/global.php';

if (isset($_GET["controller"])) {
    $controllerObj = loadController($_GET["controller"]);
} else {
    $controllerObj = loadController(CONTROLLER_DEFECT);
}
launchAction($controllerObj);
function loadController($controller)
{
    $strFileController = 'controller/conferencesContrgit oller.php';
    require_once $strFileController;
    $controllerObj = new conferencesController();
    return $controllerObj;
}
function launchAction($controllerObj)
kk
    if (isset($_GET["action"])) {
        $controllerObj->run($_GET["action"]);
    } else {
        $controllerObj->run(DEFECT_ACTION);
    }
}

