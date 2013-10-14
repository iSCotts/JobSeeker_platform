<?php if($data->getUnread()): ?>
<div class="well alert alert-block alert-info">
<?php else: ?> 
<div class="well alert alert-block">
<?php endif; ?>

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->title), array('view', 'id' => $data->id)); ?>
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