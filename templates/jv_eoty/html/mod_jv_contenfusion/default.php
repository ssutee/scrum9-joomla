<?php 
/**
* @version 1.5.x
* @package JoomVision Project
* @email webmaster@joomvision.com
* @copyright (C) 2008 http://www.JoomVision.com. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$total_slide = count($list_slidecontent);

JHTML::_('stylesheet','jvcontentfusion_css.php?id='.$module->id.'&amp;slide='.$params->get('slide').'&amp;height='.trim($params->get('height')).'&amp;width='.trim($params->get('width')).'&amp;total='.$total_slide,'modules/mod_jv_contenfusion/assets/css/');

if($total_slide != 0) {
?>

<div class="scrollablewrap<?php echo $module->id; ?>">
	<?php if($params->get('slide')) : ?>
	<span id="jvcf_<?php echo $module->id; ?>_previous" class="prev"></span>
	<span id="jvcf_<?php echo $module->id; ?>_next" class="next"></span>
	<?php endif; ?>
	<div class="scrollable<?php echo $module->id; ?>">
			<div class="mask<?php echo $module->id; ?>">
				<ul id="jvcf_<?php echo $module->id; ?>_content">
				<?php foreach($list_slidecontent as $slide) {
					$title = trim(strip_tags(htmlspecialchars(addcslashes($slide->title,"'"), ENT_QUOTES)));
					$introtext = trim(strip_tags(htmlspecialchars(addcslashes($slide->introtext,"'"), ENT_QUOTES)));
				?>
					<li class="jvcf_<?php echo $module->id; ?>_item">
						<?php if($params->get('tooltips')) : ?>
						<a href="<?php echo $slide->link; ?>" class="jv-contenfusion" rel="{'title':'<?php echo $title; ?>','content':'<?php echo $introtext; ?>'}"><img src="<?php echo $slide->thumb; ?>" class="full" alt="<?php echo $slide->title; ?>" /></a>
						<?php else : ?>
						<a href="<?php echo $slide->link; ?>"><img src="<?php echo $slide->thumb; ?>" class="full" alt="<?php echo $slide->title; ?>" /></a>
						<?php endif; ?>
					</li>
				<?php } ?>
				</ul>
			</div>
	</div>
	<script type="text/javascript">
	window.addEvent("load", function() { 
		<?php if($params->get('slide')) : ?>
		new iCarousel("jvcf_<?php echo $module->id; ?>_content", {  
			idPrevious: "jvcf_<?php echo $module->id; ?>_previous",  
			idNext: "jvcf_<?php echo $module->id; ?>_next",  
			idToggle: "undefined",  
			item: {  
				klass: "jvcf_<?php echo $module->id; ?>_item",  
				size: <?php echo ($params->get('thumbsize')+11); ?>  
			},  
			animation: {
				duration: 250,
				amount: <?php echo (int)$params->get('amount',1); ?>,
				rotate: {
					type: "manual",
					interval: <?php echo (int)$params->get('timming'); ?>,
					onMouseOver: "stop"
				}
			}
		});
		<?php endif; ?>
		<?php if($params->get('tooltips')) : ?>
		new jvClass({
			tooltip	: {
				selector : '.jv-contenfusion'
			}
		});
		<?php endif; ?>
	}); 
	</script>
</div>
<?php } ?>