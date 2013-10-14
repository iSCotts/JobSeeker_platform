<?php foreach($response as $response): ?>
    <div class="comment">
    <div class="author">
        <?php echo $response->sender->email; ?>:
    </div>
    <div class="time">
        on <?php echo date('F j, Y \a\t h:i a',strtotime($response->time_sent)); ?>
    </div>
    <div class="content">
        <?php echo nl2br(CHtml::encode($response->message)); ?>
    </div>
    <hr>
    </div><!-- comment -->
<?php endforeach; ?>