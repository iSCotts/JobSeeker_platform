<?php $this->pageTitle='Home'; ?>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h1>
<style>
    .pic{
        display:block; position:relative; margin:18px auto;
        border:5px solid goldenrod;
    }
    #page img {
         background:gold; box-shadow: inset 20px 0 50px #d80;       
    }
    .ib{
        display:inline-block;
    }
    .w {
        width:60%
    }
    #page ul{
        list-style:none;color:#444;
    }
</style>
<img class="column pic" src="images/The%20Communitytb.png" width="231"/>
<div class="column pic w">
    ARE YOU A PAINTER, CLEANER, ELECTRICIAN OR HAVE OTHER CASUAL SKILLS?
    <div>MARKET YOURSELF & FIND A JOB!</div>
    <ul>
        <li>Apply for a job in an area you can reach</li>
        <li>Post pictures of your previous jobs</li>
        <li>Rate your employers</li>
    </ul>
</div>
<div class="column pic w">
    DO YOU HAVE A PROJECT AND ARE LOOKING TO HIRE?
    <div>FIND A CASUAL WORKER NEAR YOU!</div>
    <ul>
        <li>Post  a project</li>
        <li>Find a casual worker near you</li>
        <li>Rate the work done on your project</li>
    </ul>
</div>
MOST POPULAR SKILLS:<br/>
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

<div class="clear"></div>