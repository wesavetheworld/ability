<?php $this->load->view("common/header"); ?>
    <style type="text/css">
        body {
            min-height: 2000px;
            padding-top: 70px;
        }
    </style>
</head>
<body>

<div id="container">
    <!-- Fixed navbar -->
    <?php $this->load->view("common/nav"); ?>

    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h1>引导用户教程</h1>

        </div>
        <div class="row">
            <?php if (count($forums) > 0) { ?>
                <?php foreach($forums as $forum) { ?>
                    <div class="col-sm-6 col-md-3">
                        <a href="<?php echo site_url('forum/show/'.$forum->forum_id);?>" class="thumbnail">
                            <img src="<?php echo base_url().IMAGE_PATH.'category/'.$forum->image;?>" alt="<?php echo $forum->forum_name; ?>">
                        </a>
                    </div>
                <? } ?>
            <? } ?>
        </div>
    </div> <!-- /container -->

    <script src="<?php echo JS_PATH.'jquery.min.js'; ?>"></script>
    <script src="<?php echo JS_PATH.'bootstrap.min.js'; ?>"></script>
</div>

</body>
</html>