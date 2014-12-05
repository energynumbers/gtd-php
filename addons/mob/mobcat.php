<?php
    require_once 'headerDB.inc.php';
    $values=array('type'=>'a');
    $values['filterquery']=' WHERE '.sqlparts('typefilter',$values)
        .' AND '.sqlparts('activeitems',$values)
        .' AND '.sqlparts('pendingitems',$values);
    if ($values['type']==='a' && $_SESSION['config']['contextsummary'])
        $values['filterquery'] .= " AND ".sqlparts("isNAonly",$values);
    $values['parentfilterquery']=' WHERE '.sqlparts("activeitems",$values)
                                .' AND '.sqlparts("pendingitems",$values);
    $contexts = query('countactionsbycontext',$values);
    if (!is_array($contexts)) die('no space contexts found');
		
    $title = 'List of categories';
		include_once 'mobhead.inc.php';
?><ul><?php
    foreach ($contexts as $cat)
        echo "<li><a href='",htmlspecialchars($addon['urlprefix'],ENT_QUOTES)
            ,"moblist.php&amp;contextId="
            ,(empty($cat['contextId']))?"null'>(none)":"{$cat['contextId']}'>"
            ,makeclean($cat['cname'])
            ," ({$cat['count']})</a></li>\n";
?></ul>
<?php mobfooter(); ?>