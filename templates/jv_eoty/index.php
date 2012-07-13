<?php
/**
 * @copyright	Copyright (C) 2008 - 2009 JoomVision.com. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once (dirname(__FILE__).DS.'jv_tools.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>
<link rel="stylesheet" href="<?php echo $jvTools->baseurl(); ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $jvTools->baseurl(); ?>templates/system/css/general.css" type="text/css" />
	<?php if($gzip == "true") : ?>
    <link rel="stylesheet" href="<?php echo $jvTools->templateurl(); ?>css/template.css.php" type="text/css" />
	<?php else: ?>
    <link rel="stylesheet" href="<?php echo $jvTools->templateurl(); ?>css/default.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $jvTools->templateurl(); ?>css/template.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $jvTools->templateurl(); ?>css/typo.css" type="text/css" />
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo $jvTools->parse_jvcolor_cookie(); ?>" type="text/css" />
	<script type="text/javascript">
		var baseurl = "<?php echo $jvTools->baseurl(); ?>";
		var jvpathcolor = '<?php echo $jvTools->templateurl(); ?>css/colors/';
		var tmplurl = '<?php echo $jvTools->templateurl();?>';
		var CurrentFontSize = parseInt('<?php echo $jvTools->getParam('jv_font');?>');
	</script>
	<script type="text/javascript" src="<?php echo $jvTools->templateurl() ?>js/jv.script.js"></script>
	<!--[if lte IE 6]>
	<link rel="stylesheet" href="<?php echo $jvTools->templateurl(); ?>css/ie6.css" type="text/css" />
	<script type="text/javascript" src="<?php echo $jvTools->templateurl() ?>js/ie_png.js"></script>
	<script type="text/javascript">
	window.addEvent ('load', function() {
	   ie_png.fix('.png');
	});
	</script>
	<![endif]-->
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="<?php echo $jvTools->templateurl(); ?>/css/ie7.css" type="text/css" />
	<![endif]-->
</head>

<body id="bd" class="fs<?php echo $jvTools->getParam('jv_font'); ?> <?php echo $jvTools->getParam('jv_display'); ?> <?php echo $jvTools->getParam('jv_display_style'); ?>">

<div id="jv-wrapper">

	<?php if($this->countModules('top1')||$this->countModules('top2')) : ?>
	<div id="jv-top">
		<div class="jv-wrapper" style="width: <?php echo $jv_width; ?>px;">
			<?php if($this->countModules('top1')) : ?>
			<div id="jv-topleft"><jdoc:include type="modules" name="top1" /></div>
			<?php endif; ?>
			<?php if($this->countModules('top2')) : ?>
			<div id="jv-topright"><jdoc:include type="modules" name="top2" /></div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

	<!-- BEGIN: HEADER -->
	<div id="jv-header">
		<div class="jv-wrapper">
			<div id="jv-header-inner">
				<?php if($showTools) : ?>
				<div id="jv-tools">
					<?php $jvTools->getChangeColor($jvTools->getParam('jv_font')); ?>
				</div>
				<?php endif; ?>
				<div id="jv-logo">
					<a id="jv-logo-a" class="png" href="index.php" title="<?php echo $jvTools->sitename(); ?>"><span><?php echo $jvTools->sitename(); ?></span></a>
				</div>
				<?php if($this->countModules('banner')) : ?>
				<div id="jv-banner">
					<jdoc:include type="modules" name="banner" />
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- END: HEADER -->

	<div id="jv-mainmenu" >
		<div class="jv-wrapper">
			<div id="jv-mainmenu-inner">
				<?php $menu->show(); ?>
			</div>
		</div>
	</div>

	<div id="jv-containerwrap" class="clearfix">
		<div class="jv-wrapper">
			<div id="jv-container">

				<div id="jv-main<?php echo $jv_width; ?>" class="clearfix <?php echo $jv_layout; ?>">

				<?php
				$spotlight = array ('user1','user2','user3','user4');
				$consl = $jvTools->calSpotlight($spotlight,$jvTools->isOP()?100:100,'%');
				if( $consl) :
				?>
				<div id="jv-userwrap3" class="clearfix">
					<div class="jv-wrapper">
						<div id="jv-userwrap3-inner">
							<?php if($this->countModules('user1')) : ?>
							<div id="jv-user1" class="jv-user jv-box<?php echo $consl['user1']['class']; ?>" style="width: <?php echo $consl['user1']['width']; ?>;">
								<div class="jv-box-inside">
									<jdoc:include type="modules" name="user1" style="jvxhtml" />
								</div>
							</div>
							<?php endif; ?>
							
							<?php if($this->countModules('user2')) : ?>
							<div id="jv-user2" class="jv-user jv-box<?php echo $consl['user2']['class']; ?>" style="width: <?php echo $consl['user2']['width']; ?>;">
								<div class="jv-box-inside">
									<jdoc:include type="modules" name="user2" style="jvxhtml" />
								</div>
							</div>
							<?php endif; ?>
							
							<?php if($this->countModules('user3')) : ?>
							<div id="jv-user3" class="jv-user jv-box<?php echo $consl['user3']['class']; ?>" style="width: <?php echo $consl['user3']['width']; ?>;">
								<div class="jv-box-inside">
									<jdoc:include type="modules" name="user3" style="jvxhtml" />
								</div>
							</div>
							<?php endif; ?>
							
							<?php if($this->countModules('user4')) : ?>
							<div id="jv-user4" class="jv-user jv-box<?php echo $consl['user4']['class']; ?>" style="width: <?php echo $consl['user4']['width']; ?>;">
								<div class="jv-box-inside">
									<jdoc:include type="modules" name="user4" style="jvxhtml" />
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>  

					<div id="jv-main-dot" class="clearfix">

						<div id="jv-contentwrap">

							<?php if($this->countModules('slideshow')) : ?>
							<div id="jv-slideshow">
								<jdoc:include type="modules" name="slideshow" style="jvxhtml" />
							</div>
							<?php endif; ?>

							<?php if($this->countModules('highlight')) : ?>
							<div id="jv-highlight">
								<jdoc:include type="modules" name="highlight" style="jvxhtml" />
							</div>
							<?php endif; ?>

							<div id="jv-content">

								<?php if($this->countModules('left')) : ?>
								<div id="jv-left">
									<jdoc:include type="modules" name="left" style="jvxhtml" />
								</div>
								<?php endif; ?>

								<div id="jv-content-pad">
									<div id="jv-content-inner">
										<?php if($this->countModules('user5')) : ?>
										<div id="jv-slideshow">
											<jdoc:include type="modules" name="user5" style="jvxhtml" />
										</div>
										<?php endif; ?>
										
										<jdoc:include type="message" />
										<jdoc:include type="component" />

										<?php if($this->countModules('user6')) : ?>
										<div id="jv-slideshow">
											<jdoc:include type="modules" name="user6" style="jvxhtml" />
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>

						</div>

						<?php if($this->countModules('right')) : ?>
						<div id="jv-right">
							<jdoc:include type="modules" name="right" style="jvxhtml" />
						</div>
						<?php endif; ?>

					</div>

				</div>

			</div>
		</div>
	</div>

	<?php
		$spotlight = array ('user7','user8','user9');
		$botsl = $jvTools->calSpotlight ($spotlight,$jvTools->isOP()?100:99,'%');
		if( $botsl ) :
	?>
		<div id="jv-userwrap1" class="clearfix">
			<div class="jv-wrapper">
				<?php if($this->countModules('user7')) : ?>
					<div id="jv-user7" class="jv-user jv-box<?php echo $botsl['user7']['class']; ?>" style="width: <?php echo $botsl['user7']['width']; ?>;">
						<div class="jv-box-inside">
							<jdoc:include type="modules" name="user7" style="jvxhtml" />
						</div>
					</div>
				<?php endif; ?>
				<?php if($this->countModules('user8')) : ?>
					<div id="jv-user8" class="jv-user jv-box<?php echo $botsl['user8']['class']; ?>" style="width: <?php echo $botsl['user8']['width']; ?>;">
						<div class="jv-box-inside">
							<jdoc:include type="modules" name="user8" style="jvxhtml" />
						</div>
					</div>
				<?php endif; ?>
				<?php if($this->countModules('user9')) : ?>
					<div id="jv-user9" class="jv-user jv-box<?php echo $botsl['user9']['class']; ?>" style="width: <?php echo $botsl['user9']['width']; ?>;">
						<div class="jv-box-inside">
							<jdoc:include type="modules" name="user9" style="jvxhtml" />
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>


	<!-- BEGIN: FOOTER -->
	<div id="jv-footerwrap">
		<div class="jv-wrapper">

			<div id="jv-footer">
				<jdoc:include type="modules" name="footer" />
			</div>

			<div class="clearfix">
				<div id="jv-copyright">
					Copyright &copy; 2008 - <?php echo date(Y); ?> <a title="Joomla Templates" href="http://www.joomlavision.com">Joomla Templates</a>  by <a href="http://www.joomlavision.com" title="Joomla Templates Club">JoomlaVision</a>. All rights reserved.
				</div>
				<div id="jv-inset">
					<jdoc:include type="modules" name="inset" />
				</div>
			</div>

		</div>
	</div>

</div>
<jdoc:include type="modules" name="debug" />
</body>
</html>
