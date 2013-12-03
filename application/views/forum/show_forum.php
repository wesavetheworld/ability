<?php $this->load->view("common/header"); ?>

</head>
<body>

<div id="container">
    <!-- Fixed navbar -->
    <?php $this->load->view("common/nav"); ?>

    <div class="container">

        <div class="col-xs-12 col-sm-9">
            <?php if(!empty($forum)) { ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php echo base_url().IMAGE_PATH.'category/'.$forum->image; ?>" alt="<?php echo $forum->forum_name; ?>">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $forum->forum_name; ?></h4>
                        <?php echo $forum->discription; ?>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($messages)) { ?>
                <?php foreach($messages as $msg) { ?>
                    <div class="well"><a href="<?php echo site_url('forum/show/'.$fid.'/'.$msg->msg_id);?>"><?php echo $msg->subject; ?></a></div>
                <?php } ?>
            <?php } ?>
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