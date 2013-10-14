<?php
        header('Content-Type: ' . $model->file_type);
        print $model->image; 
        exit(); //the actual image
?>
