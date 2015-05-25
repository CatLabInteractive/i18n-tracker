<?php $this->layout ('index.phpt'); ?>

<div class="projects">
	<h1><?php echo $project->getToken (); ?></h1>

	<table class="table">
		<?php foreach ($original as $entry) { ?>

			<tr>
				<td style="width: 50%;"><?php echo $entry->getText (); ?></td>
				<td>
					<?php
						$translation = $translated->touchFromOriginal ($entry);
						if ($translation) {
						foreach ($translation->getVariations () as $variation) { ?>
						<textarea
							placeholder="<?php echo $variation->getDescription (); ?>"
							class="form-control resource" id="entry_<?php echo $entry->getId (); ?>_<?php echo $variation->getId (); ?>"
							data-entry-id="<?php echo $entry->getId (); ?>"
							data-variation-id="<?php echo $variation->getId (); ?>"><?php
								echo $variation->getText ();
						?></textarea>
					<?php } } ?>
				</td>
			</tr>

		<?php } ?>
	</table>
</div>

<script>
	$(document).ready (function () {

		$('textarea.resource').change (function () {

			var id = $(this).attr ('data-entry-id');
			var variation = $(this).attr ('data-variation-id');
			var value = $(this).val ();

			$.ajax ({
				'url' : '/translate/<?php echo $project->getToken (); ?>/<?php echo $language->getToken (); ?>/' + id + '/' + variation,
				'method' : 'post',
				'data' : JSON.stringify ({ 'value' : value }),
				'dataType' : 'json',
				'contentType' : "application/json"
			});

		});

	});
</script>