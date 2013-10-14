<div class="view">
	<?php echo GxHtml::link('<h2>Account ID: '.GxHtml::encode($data->id).'</h2>', array('view', 'id' => $data->id)); ?>
	<br />

	<b><?php echo GxHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	R <?php echo GxHtml::encode($data->balance); ?>
	<br />
	<b><?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<br />

</div>