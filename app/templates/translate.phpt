<?php $this->layout ('index.phpt'); ?>

<div class="projects">
	<h1><?php echo $project->getToken (); ?></h1>

	<table class="table">
		<?php foreach ($original as $entry) { ?>

			<tr>
				<td style="width: 50%;"><?php echo $entry->getText (); ?></td>
				<td>
					<textarea class="form-control" id="entry_<?php echo $entry->getId (); ?>" data-entry-id="<?php echo $entry->getId (); ?>"><?php

						$translation = $translated->getFromToken ($entry->getToken ());
						if ($translation) {
							echo $translation->getText ();
						}

					?></textarea>
				</td>
			</tr>

		<?php } ?>
	</table>
</div>