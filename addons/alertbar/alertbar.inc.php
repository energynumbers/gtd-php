<?php
$alertbar=array('type'=>'i');
$alertbar['filterquery']=' WHERE '.sqlparts('typefilter',$alertbar)
                       .' AND '.sqlparts('pendingitems',$alertbar);
$alertbar = query("counttype",$alertbar);
$alertbar= ($alertbar) ? $alertbar[0]['cnt'] : 0;
if($alertbar)
    echo "<div id='alertbar'><a href='listItems.php?type=i'>"
        ,$alertbar,' inbox item'
        ,($alertbar=='1')?'':'s'
        ,'</a></div>';