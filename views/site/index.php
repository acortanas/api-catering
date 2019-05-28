<?php
//  ==========  LAST MODIFIED   :   2019-05-27  ==========

/* @var $this yii\web\View */

    $this->title = 'Catering Lists';

    $readjson = file_get_contents('http://localhost/rest-api/catering/data/lists.json');
    $restaurants = json_decode($readjson, true);

    $restaurants = $restaurants["restaurants"];
    // echo $restaurants[0]["restaurant"]["name"];
    // echo $restaurants[0]["restaurant"]["location"]["address"];
?>
<!-- <div class="site-index">

    <div class="jumbotron">
        <h1>Catering Lists</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>



    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div> -->


<!-- ==========  ADDED BY AJENG  ========== -->
<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1>Catering Lists</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <!-- SHOW CONTENTS AS CARD -->
        <?php foreach ($restaurants as $row) : ?>
        <div class="col md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title"><?= $row["restaurant"]["name"]; ?></h4>
                    <p class="card-text"><?= $row["restaurant"]["location"]["address"]; ?></p>
                    <p class="card-text"><?= "Cuisines : ", $row["restaurant"]["cuisines"]; ?></p>
                    <p class="card-text"><?= "Average cost for two : ", $row["restaurant"]["currency"], " ", $row["restaurant"]["average_cost_for_two"]; ?></p>
                    <a href="<?= $row["restaurant"]["photos_url"]; ?>" class="btn btn-primary">See Photos</a>
                    <a href="<?= $row["restaurant"]["url"]; ?>" class="btn btn-primary">See Details</a>
                    <hr>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- ==========  END OF EDIT  ========== -->