<?php $this->load->view("common/header"); ?>

</head>
<body>

<div id="container">
    <!-- Fixed navbar -->
    <?php $this->load->view("common/nav"); ?>

    <div class="container">
        <div class="jumbotron">
            <h1>引导用户教程</h1>
        </div>
    <div class="col-xs-12 col-sm-9">

            <?php if (count($forums) > 0) { ?>
                <?php foreach($forums as $forum) { ?>
                    <div class="media">
                        <a href="<?php echo site_url('forum/show/'.$forum->forum_id.'/'.$forum->msg_id);?>" class="pull-left">
                            <img class="media-object" src="<?php echo base_url().IMAGE_PATH.'category/'.$forum->image;?>" alt="<?php echo $forum->forum_name; ?>">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="<?php echo site_url('forum/show/'.$forum->forum_id.'/'.$forum->msg_id);?>"><?php echo $forum->subject; ?></a></h4>
                            <p>时间 : <?php echo $forum->msg_date; ?>  分类 : <?php echo $forum->forum_name; ?> </p>
                            <?php echo $forum->msg_text; ?>
                        </div>
                    </div>
                <? } ?>
            <? } ?>
    </div>

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <a href="#" class="list-group-item active">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
                <a href="#" class="list-group-item">Link</a>
            </div>
        </div><!--/span-->
    </div> <!-- /container -->

    <script src="<?php echo JS_PATH.'jquery.min.js'; ?>"></script>
    <script src="<?php echo JS_PATH.'bootstrap.min.js'; ?>"></script>
</div>

</body>
</html>