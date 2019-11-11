<?php

/* @var $this yii\web\View */

$this->title = 'Win the prize!';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2><?=$this->title; ?></h2>

                <form action="index.php" method="post" id="lottery-form">
                    <div id="title-row">
                        <h1>Push the button and win the result</h1>
                    </div>
                    <div id="button-row">
                        <input type="submit" name="getPrize" value="Push Me!">
                    </div>
                    <div id="menu-row">
                        This block will appears after the form will submit and a User wins a prize.
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
