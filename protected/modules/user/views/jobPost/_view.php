<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('skill_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->skill)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('Desc')); ?>:
	<?php echo GxHtml::encode($data->Desc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('budget')); ?>:
	<?php echo GxHtml::encode($data->budget); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('negotiable')); ?>:
	<?php echo GxHtml::encode($data->negotiable); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('response_cut_date')); ?>:
	<?php echo GxHtml::encode($data->response_cut_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hours_per_day')); ?>:
	<?php echo GxHtml::encode($data->hours_per_day); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_start_date')); ?>:
	<?php echo GxHtml::encode($data->job_start_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_end_date')); ?>:
	<?php echo GxHtml::encode($data->job_end_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('close_applications')); ?>:
	<?php echo GxHtml::encode($data->close_applications); ?>
	<br />
	*/ ?>

</div>