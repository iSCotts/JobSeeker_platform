<?php if($data->is_read!=1): ?>
<div class="well alert alert-block alert-info">
<?php else: ?> 
<div class="well alert alert-block">
<?php endif;
    //$data->time_sent = date('i', time()) - date('i', strtotime($data->time_sent));*/
?>

    <h4><?php echo GxHtml::link(ucwords(str_replace('_',' ',$data->notificationType)), array('view', 'id' => $data->id)); ?>!</h4>

	<?php echo GxHtml::encode($data->getAttributeLabel('receiver_id')); ?>:
		<?php echo $data->receiver->profile->firstname; ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_post_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->jobPost)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('time_sent')); ?>:
	<?php echo GxHtml::encode($data->time_sent); ?>
	<br />

</div>