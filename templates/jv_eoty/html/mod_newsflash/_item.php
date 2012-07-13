<?php // @version $Id: _item.php 12349 2009-06-24 13:37:19Z ian $
defined('_JEXEC') or die('Restricted access');
?>

<?php if ($params->get('item_title')) : ?>
<h4 class="jv-flashh4 png">
	<?php if ($params->get('link_titles') && (isset($item->linkOn))) : ?>
	<a href="<?php echo JRoute::_($item->linkOn); ?>" class="contentpagetitle<?php echo $params->get('moduleclass_sfx'); ?>">
		<span class="jv-flashspan png"><span class="png"><?php echo $item->title; ?></span></span>
	</a>
	<?php else : ?>
	<span class="jv-flashspan">
		<span><?php echo $item->title; ?></span>
	</span>
	<?php endif; ?>
</h4>
<?php endif; ?>
<div class="jv-flashcontent">
<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent;
echo JFilterOutput::ampReplace($item->text);

$itemparams=new JParameter($item->attribs);
$readmoretxt=$itemparams->get('readmore',JText::_('Read more text'));
if (isset($item->linkOn) && $item->readmore && $params->get('readmore')) : ?>
<a href="<?php echo $item->linkOn; ?>" class="readon png">
	<?php echo $readmoretxt; ?></a>
<?php endif; ?>
<span class="article_separator">&nbsp;</span>
</div>