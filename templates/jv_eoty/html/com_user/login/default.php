<?php // @version $Id: default.php 12352 2009-06-24 13:52:57Z ian $
defined( '_JEXEC' ) or die( 'Restricted access' );
 ?>
<?php if($this->params->get('show_page_title',1)) : ?>
<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
	<span><?php echo $this->params->get('page_title') ?></span>
</h2>
<?php endif; ?>

<?php echo $this->loadTemplate( $this->type ); ?>
