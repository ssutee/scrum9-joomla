<?php // @version $Id: default.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');
?>
<?php if($this->params->get('show_page_title',1)) : ?>
<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
	<span><?php echo $this->escape($this->params->get('page_title')) ?></span>
</h2>
<?php endif; ?>
<h1>
	<?php echo JText::_('Welcome!'); ?>
</h1>

<div class="contentdescription">
	<?php echo $this->params->get('welcome_desc', JText::_( 'WELCOME_DESC' ));; ?>
</div>
