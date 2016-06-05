<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->params["siteTitle"];
?>
<div class="site-index">

    <div class="jumbotron">
        <h2><?=Yii::$app->params["siteTitle"]?></h2>

        <p class="lead">New Born Service plan</p>

    </div>

    <div class="body-content">
        <h3><strong>User Infomation</strong></h3>
        <hr>
    <?php
    if (isset(Yii::$app->user->identity->username) && Yii::$app->user->identity->username!=""){
        echo '<h4>UserID: ',Yii::$app->user->identity->username ,'</h4>';
        echo '<h4>Hospcode: ',Yii::$app->user->identity->hcode,'</h4>';
        echo '<h4>Name: ',Yii::$app->user->identity->prename.Yii::$app->user->identity->fname.' '.Yii::$app->user->identity->lname,'</h4>';
        echo '<h4>Position: ',Yii::$app->user->identity->position,Yii::$app->user->identity->position_level ,'</h4>';
        echo '<h4>email: ',Yii::$app->user->identity->email,'</h4>';
        echo '<h4>Mobile: ',Yii::$app->user->identity->mobile ,'</h4>';
    } else {
        echo '<h4>Unauthorize User</h4>';
    }

        //[id] => 2
        //[prov] => 40
        //[userlevel] => 1
        //[tel] =>
    ?>
    </div>
</div>
