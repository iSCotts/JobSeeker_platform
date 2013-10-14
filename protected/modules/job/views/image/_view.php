<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('image')); ?>:
	<?php echo GxHtml::encode($data->image); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('file_name')); ?>:
	<?php echo GxHtml::encode($data->file_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('file_type')); ?>:
	<?php echo GxHtml::encode($data->file_type); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_post_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->jobPost)); ?>
	<br />

</div>