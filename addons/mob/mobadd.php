<?php
    require_once 'ses.inc.php';
		$title = 'Add inbox item';
		include_once 'mobhead.inc.php';
?>
<form method='post' action='processItems.php'>
<div>
<input type='text' name='title'>
<textarea name='description' rows='5' cols=30></textarea><br>
<input type='hidden' name='type' value='i'>
<input type='hidden' name='action' value='create'>
<input type='hidden' name='referrer' value='<?php echo htmlspecialchars($addon['urlprefix'],ENT_QUOTES),'mobadd.php'; ?>'>
<input type='submit' value='submit'>
</div>
</form>
<?php mobfooter(); ?>