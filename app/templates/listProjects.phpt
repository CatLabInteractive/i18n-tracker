<?php $this->layout ('index.phpt'); ?>

<div class="projects">
	<h1>Projects</h1>

	<ul>
		<?php foreach ($projects as $project) { ?>
			<li>
				<a href="<?php echo $this->getURL ('translate/' . $project->getToken (), array ()); ?>">
					<?php echo $project->getToken (); ?>
				</a>
			</li>
		<?php } ?>
	</ul>
</div>