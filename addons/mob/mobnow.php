<?php
$title = 'Due and imminent actions';
require_once 'headerDB.inc.php';
$values = array( 'isSomeday' => 'n' );
$prefix = $prefix=$_SESSION['prefix'];
$sql=
  "SELECT x.`itemId`,IF(x.`duedays`>0,1,0) AS `duecategory`,x.`duedays`,
      x.`nextaction`,x.`title`,x.`type`,x.`deadline`,y.`ptitle`
    FROM (
			SELECT
				its.`itemId`,its.`type`, its.`deadline`, its.`nextaction`,
				its.`tickledate`, its.`dateCompleted`, lu.`parentId`, i.`title`,
        DATEDIFF(CURDATE(),its.`deadline`) AS `duedays`
			FROM `{$prefix}itemstatus` AS `its`
			JOIN  `{$prefix}items` AS `i` USING (`itemId`)
			LEFT OUTER JOIN `{$prefix}lookup` AS `lu` USING (`itemId`)
			WHERE " . sqlparts( 'activeitems', $values )
	  . " AND its.`type` IN ('a','i','w','p') 
			  AND its.`deadline` IS NOT NULL 
        AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)>=its.`deadline` 
        AND " . sqlparts( 'pendingitems', $values )
    . " AND " . sqlparts( 'issomeday', $values )
    . " AND (its.`type` NOT IN ('a','w') OR its.`nextaction`='y')
		  ) AS x
			LEFT OUTER JOIN (
			SELECT
				its.`itemId` AS parentId, `isSomeday` AS pisSomeday,
				`tickledate` AS ptickledate,`dateCompleted` AS pdateCompleted,
				`title` AS ptitle
			FROM `{$prefix}itemstatus` AS its 
					JOIN `{$prefix}items` AS i USING (`itemId`)
		  ) as y USING(`parentId`)  WHERE ".sqlparts("liveparents",$values)
		."	GROUP BY `itemId`
				ORDER  BY `duecategory`,ABS(x.`duedays`),x.`type`,x.`deadline`";

$lastType = '';
$lastDueCat = '';
$dueCats = array( 0 => 'due in next 7 days', 1 => 'overdue' );
$res = query( $sql, $values );
if ( !is_array( $res ) )  return;
//---------------------------------------------------------------------------------------------
// end of processing - now do output

include_once 'mobhead.inc.php';
?>
<ul>
  <li><a href='<?php echo htmlspecialchars( $addon['urlprefix'], ENT_QUOTES ), 'mobcat.php'; ?>'>click for actions by context</a></li>
<?php foreach ( $res as $line ) {
	if ( $lastDueCat !== $line['duecategory'] ) { $lastDueCat = $line['duecategory']; ?>
  </ul>
	<h3><?php echo $dueCats[$line['duecategory']]; ?></h3>
	<ul>
	<?php } ?>
<li><span class='small'>[<?php
			if ($lastDueCat) {
				echo "{$line['duedays']} days overdue";
			} else {
				echo 'due ';
				switch ( $line['duedays'] ) {
					case '0': echo 'today'; break;
					case '-1': echo 'tomorrow'; break;
					default: echo 'in '.(-$line['duedays']). ' days'; break;
				}
			} ?>]</span> 
  <a href=<?php
			echo "'",htmlspecialchars( $addon['urlprefix'], ENT_QUOTES ), 
				"mobitem.php&amp;itemId={$line['itemId']}'";
			if ( 'y' === $line['nextaction'] ) echo ' class="nextactionlink" ';
		?>>
	  <?php echo $line['title']; ?></a> 
	<?php echo ( ( 'a' === $line['type'] ) ? '' : getTypes( $line['type'] ) ), ' (', $line['ptitle'] . ')';  ?>
</li>
<?php } ?>
</ul>
<?php mobfooter(); ?>
