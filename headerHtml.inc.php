<?php
if (!isset($areUpdating)) require_once 'headerDB.inc.php';

if ($_SESSION['version']!==_GTD_VERSION && !isset($areUpdating) ) {
    $testver=query('getgtdphpversion');
    $tmp=array_pop($testver);
    $tmp2=array_pop($tmp);
    if (_GTD_VERSION === $tmp2 ) {
      $_SESSION['version']=_GTD_VERSION;
    } else {
      $msg= (empty($testver))
              ? "<p class='warning'>Your version of the database needs upgrading before we can continue.</p>"
              : "<p class='warning'>No gtd-php installation found: please check the database prefix in config.inc.php, and then install.</p>";
      $_SESSION['message']=array($msg); // remove warning about version not being found
      nextScreen('install.php');
      die;
    }
}

if (!headers_sent()) header("Content-Type: text/html; charset={$_SESSION['config']['charset']}");

if (empty($title)) $title= ($_SESSION['config']['title_suffix']) ? $pagename : '';

$extrajavascript = '';

if ($_SESSION['debug']['debug'] || defined('_DEBUG'))
	$extrajavascript .= "\n<script 
    /* <![CDATA[ */
    $(document).ready(function(){
        GTD.debugInit(\"{$_SESSION['debug']['key']}\");
    });
    /* ]]> */
    </script>";

$themejs="themes/{$_SESSION['theme']}/theme.js";
if (is_readable($themejs))
    $extrajavascript .= "\n<script src='$themejs'></script>";

/*-----------------------------------------------------------
    build HTML header
*/
if (empty($_SESSION['theme'])) $_SESSION['theme']='default';
$headertext=<<<HTML1
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset={$_SESSION['config']['charset']}" />
<title>{$_SESSION['config']['title']} $title</title>
<link rel="stylesheet" href="themes/{$_SESSION['theme']}/style.css">
<link rel="stylesheet" href="themes/{$_SESSION['theme']}/style_screen.css" media="screen">
<link rel="shortcut icon" href="./favicon.ico">
<script src='jquery.js'></script>
<script src="calendar.js"></script>
<script src="lang/calendar-en.js"></script>
<script src="gtdfuncs.js"></script>

{$extrajavascript}
HTML1;
//-----------------------------------------------------------
if (gtd_handleEvent(_GTD_ON_HEADER,$pagename)) echo $headertext;
/*
Documentation for included files:


theme main stylesheet
<link rel="stylesheet" href="themes/{$_SESSION['theme']}/style.css">

theme screen stylesheet
<link rel="stylesheet" href="themes/{$_SESSION['theme']}/style_screen.css"  media="screen">

main calendar program
<script src="calendar.js"></script>

language for the calendar
<script src="lang/calendar-en.js"></script>

sort tables, and other utilities
<script src="gtdfuncs.js"></script>

*/
?>
