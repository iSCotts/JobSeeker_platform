<?php $this->pageTitle='Home'; ?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h1>
<style>
    div, b {
        display:block !important;
    }
    b {
        text-align:center;
        font-weight:bold;
        color:goldenrod
    }
    b:first-child {
        text-align:left;
        color:#000
    }
    .pic{
        display:block; position:relative; margin:18px auto;
        border:5px solid #333;width:28%;
    }
    #page img {
         background:gold; box-shadow: inset 20px 0 50px #d80;       
    }
    .ib{
        display:inline-block;
    }
    .w {
        padding:10px;
        float:right;
        width:60%
    }
    #page ul{
        list-style:none; color:#444;
    }
</style>
<img class="column pic" src="images/The%20Communitytb.png" width="231"/>
<div class="column pic w">
    <b>ARE YOU A PAINTER, CLEANER, ELECTRICIAN OR HAVE OTHER CASUAL SKILLS?</b>
    <b>MARKET YOURSELF & FIND A JOB!</b>
    <ul>
        <li>Apply for a job in an area you can reach</li>
        <li>Post pictures of your previous jobs</li>
        <li>Rate your employers</li>
    </ul>
</div>
<div class="column pic w">
    <b>DO YOU HAVE A PROJECT AND ARE LOOKING TO HIRE?</b>
    <b>FIND A CASUAL WORKER NEAR YOU!</b>
    <ul>
        <li>Post  a project</li>
        <li>Find a casual worker near you</li>
        <li>Rate the work done on your project</li>
    </ul>
</div>
<div class="column clear" style="width:auto">
<b>MOST POPULAR SKILLS:</b>
<ul class="ib">
    <li>Electrician</li>
    <li>Welder</li>
    <li>Cleaner</li>
    <li>Plumber</li>
</ul>
<ul class="ib">
    <li>Painter</li>
    <li>Laundry washer</li>
    <li>Carpenter</li>
    <li>Gardener</li>
</ul>
</div>
<div class="clear"></div>
