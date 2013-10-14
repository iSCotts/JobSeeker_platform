<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('message')); ?>:
	<?php echo GxHtml::encode($data->message); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sender_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->sender)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('receiver_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->receiver)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('time_sent')); ?>:
	<?php echo GxHtml::encode($data->time_sent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('updated_message_time')); ?>:
	<?php echo GxHtml::encode($data->updated_message_time); ?>
	<br />

</div>