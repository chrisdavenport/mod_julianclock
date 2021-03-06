<?php
/**
 * @package julianclock for Joomla 3.0
 * @version 1.2
 * @author Troy T. Hall (http://jowwow.me)
 * @copyright (C) 2013 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/* we need some basic parameters */
$moduleTitle = $module->title;
$moduleTitle = strtolower($moduleTitle);
$moduleTitle = preg_replace('/[^a-z0-9]/i', '_', $moduleTitle);
$moduleSuffix = $params->get('moduleclass_sfx');
?>
<!-- BEGIN LAYOUT -->

<div class="<?php
echo "julianclock_" . $moduleTitle . '"';
if ($moduleSuffix) {
	echo 'class=" ' . $moduleSuffix . '">';
} else {
	echo ">";
}
?>
	 </div>
	 <!-- END LAYOUT -->
	 <!-- formula derived from https://en.wikipedia.org/wiki/Julian_day -->
	 <script type="text/javascript" >

	 function getJulian_<?php echo $moduleTitle; ?>()
	 {
	 var now = new Date();
	 var day = now.getUTCDate();
	 var month = now.getUTCMonth()+1;
	 var year = now.getUTCFullYear();
	 var hours = now.getUTCHours();
	 var minutes = now.getUTCMinutes();
	 var seconds = now.getUTCSeconds();
	 var a = Math.floor((14 - month) / 12);
	 var y = year + 4800 - a;
	 var m = month + (12 * a) - 3;
	 var JDN = day + Math.floor(((153 * m) + 2) / 5) + (365 * y) + Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;
	 var JulianDate = JDN + ((hours - 12) / 24) + (minutes / 1440) + (seconds/86400);

	 if(<?php echo $params->get('positionText'); ?> == 1) {
	 jQuery(".julianclock_<?php echo $moduleTitle; ?>").html(JulianDate).prepend('<?php echo $params->get('clockText'); ?> ');
	 } else	 {
	 jQuery(".julianclock_<?php echo $moduleTitle; ?>").html(JulianDate).append(' <?php echo $params->get('clockText'); ?>');
	 }
	 }

	 // Update the time display
	 jQuery(document).ready(function ()
	 {
	 setInterval(getJulian_<?php echo $moduleTitle; ?>, <?php echo $params->get('updateInterval'); ?>);
	 });

</script>