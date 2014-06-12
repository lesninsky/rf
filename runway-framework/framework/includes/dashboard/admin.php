<div id="wpbody">
	<div id="wpbody-content">

		<div class="about-wrap">

			<h1>
				<?php echo __('Welcome to Runway', 'framework'); ?>
				<span class="version"><?php
$framework = wp_get_theme( 'runway-framework' );
if ( $framework->exists() )
	echo 'Version '. $framework->Version;
?></span>
			</h1>

			<div class="about-text"><?php echo __('A better way to create WordPress themes. Runway is a powerful development environment for making awesome themes', 'framework'); ?>.</div>

			<div class="runway-badge"><br></div>

			<div class="clear"></div>

			<?php // include_once 'views/introduction.php'; ?>

			<h2 class="nav-tab-wrapper tab-controlls">
				<a data-tabrel="#getting-started" href="#getting-started" class="nav-tab nav-tab-active"><?php echo __('Getting Started', 'framework'); ?></a><a data-tabrel="#support" href="#support" class="nav-tab"><?php echo __('Help', 'framework'); ?> &amp; <?php echo __('Support', 'framework'); ?></a><a data-tabrel="#release-notes" href="#release-notes" class="nav-tab"><?php echo __('Release Notes', 'framework'); ?></a><a data-tabrel="#contribute" href="#contribute" class="nav-tab"><?php echo __('Contribute', 'framework'); ?></a>
			</h2>

			<div id="getting-started" class="tab tab-active">
				<?php include_once 'views/getting-started.php'; ?>
			</div>
			<div id="support" class="tab">
				<?php include_once 'views/support.php'; ?>
			</div>
			<div id="release-notes" class="tab">
				<?php include_once 'views/release-notes.php'; ?>
			</div>
			<div id="contribute" class="tab">
				<?php include_once 'views/contribute.php'; ?>
			</div>

			<div class="clear"></div>
		</div><!-- about-wrap -->


		<div class="clear"></div>
	</div><!-- wpbody-content -->

	<div class="clear"></div>
</div> <!-- id="wpbody" -->




<script type="text/javascript">
	jQuery(function () {

		var $ = jQuery;

		$('.tab-controlls a').click(function () {

			if(!$(this).hasClass('nav-tab-active')) {
				$('.tab-controlls a').removeClass('nav-tab-active');
				$(this).addClass('nav-tab-active');
				$('.tab-active').removeClass('tab-active');
				$($(this).data('tabrel')).addClass('tab-active');
			}

			return false;
		});

	});
</script>
