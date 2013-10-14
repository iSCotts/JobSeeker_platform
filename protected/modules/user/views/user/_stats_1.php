<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('from_user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->fromUser)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('to_user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->toUser)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_post_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->jobPost)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('quality')); ?>:
	<?php echo GxHtml::encode($data->quality); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cost')); ?>:
	<?php echo GxHtml::encode($data->cost); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('expertise')); ?>:
	<?php echo GxHtml::encode($data->expertise); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('schedule')); ?>:
	<?php echo GxHtml::encode($data->schedule); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('response')); ?>:
	<?php echo GxHtml::encode($data->response); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('professionalism')); ?>:
	<?php echo GxHtml::encode($data->professionalism); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('review')); ?>:
	<?php echo GxHtml::encode($data->review); ?>

</div>