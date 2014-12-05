<?php
    require_once 'headerDB.inc.php';
    $values['contextId']= (empty($_REQUEST['contextId'])) ? 0 : $_REQUEST['contextId'];
    $values['type']= (empty($_REQUEST['type'])) ? 'a' : $_REQUEST['type'];

    $values['parentfilterquery'] = " WHERE ".sqlparts("activeitems",$values)
            .' AND '.sqlparts("pendingitems",$values);

    $values['filterquery'] = $values['extravarsfilterquery'] = '';
    
    $values['childfilterquery'] = " WHERE ".sqlparts("typefilter",$values)
                                 ." AND ".sqlparts("activeitems",$values)
                                 ." AND ".sqlparts("pendingitems",$values);
    
    if ($values['type']==='a' && $_SESSION['config']['contextsummary'])
        $values['childfilterquery'] .= " AND ".sqlparts("isNAonly",$values);
        
    if ($values['contextId'])
        $values['childfilterquery'] .= " AND ".sqlparts("contextfilter",$values);

    $items = query('getitemsandparent',$values);
    if (!$items) die('no items found');
    $contextname=$items[0]['cname'];
    $tot=count($items);

    $title = "$tot Next Actions for $contextname";
    include_once 'mobhead.inc.php'
?><ul><?php
    foreach ($items as $act)
        echo "<li><a href='",htmlspecialchars($addon['urlprefix'],ENT_QUOTES)
            ,"mobitem.php&amp;itemId={$act['itemId']}'>"
            .makeclean($act['title'])."</a> ("
            .makeclean(str_replace($_SESSION['config']['separator'],', ',$act['ptitle'])).")</li>\n";
?></ul>
<?php mobfooter(); ?>