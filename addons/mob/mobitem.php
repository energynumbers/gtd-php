<?php
    require_once 'headerDB.inc.php';
    $values=array('itemId'=>$_REQUEST['itemId']);
    $values['filterquery']=' WHERE '.sqlparts('singleitem',$values);
    $result = query('selectitem',$values);
    if (!$result) die('item not found');
    $values=$result[0];
    $parents = query("selectparents",$values);
    $values['title']=makeclean($values['title']);
include_once 'mobhead.inc.php';
?>
<div>
<form action='processItems.php' method='post'>
<div>Next Action: <input type='checkbox' name='nextaction' disabled="disabled" <?php
  if ($values['nextaction']==='y') echo "checked='checked'";
?> ><br>
Completed:<input type='checkbox' name='action' value='complete' ><br>
<input type='submit' value='submit'>
<input type='hidden' name='itemId' value='<?php echo $values['itemId']; ?>'>
<input type='hidden' name='referrer' value='<?php echo htmlspecialchars($addon['urlprefix'],ENT_QUOTES); ?>moblist.php'>
</div>
</form>
<b>Deadline:</b> <?php echo $values['deadline'] ?><br>
<b>Description:</b> <?php echo $values['description'] ?><br>
<b>Desired Outcome:</b> <?php echo $values['desiredOutcome'] ?><br>
</div>
<?php mobfooter(); ?>