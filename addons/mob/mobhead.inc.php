<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title; ?></title>
<style>
.nextactionlink {font-weight:bold;}
ul {margin: 0; font-size:0.8em; list-style-type:none;padding-left:0;}
li {padding-top:3px;}
h3 {margin: 6px 0 0 0;}
.small {font-size:0.6em;}
#mobfooter a {font-size:0.6em;}
</style>
</head>
<body>
<?php include_once 'showMessage.inc.php';
function mobfooter() { 
  global $addon; ?>	
<div id='mobfooter'>
 <a href='<?php echo htmlspecialchars($addon['urlprefix'],ENT_QUOTES); ?>mobnow.php'>list due items</a>
 <a href='<?php echo htmlspecialchars($addon['urlprefix'],ENT_QUOTES); ?>mobcat.php'>list actions</a>
 <a href='<?php echo htmlspecialchars($addon['urlprefix'],ENT_QUOTES); ?>mobadd.php'>add inbox item</a>
</div>
</body>
</html>
<?php } ?>