<?php $this->layout ('index.phpt'); ?>

<div class="projects">
	<h1><?php echo $project->getToken (); ?></h1>

	<table class="table">
		<?php foreach ($original as $entry) { ?>

			<tr>
				<td><?php echo $entry->getText (); ?></td>
			</tr>

		<?php } ?>
	</table>
</div>