<?php $this->layout ('index.phpt'); ?>

<div class="projects">
	<h1><?php echo $project->getToken (); ?></h1>

	<p>Select language to translate to.</p>
	<ul>
		<?php foreach ($languages as $language) { ?>
			<?php if ($language->getToken () === 'original') continue; ?>

			<li>
				<a href="<?php echo $this->getURL ('translate/' . $project->getToken () . '/' . $language->getToken (), array ()); ?>">
					<?php echo $language->getName (); ?>
				</a>
			</li>
		<?php } ?>
	</ul>
</div>