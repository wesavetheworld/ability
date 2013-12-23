<?php $this->load->view("common/header"); ?>

</head>
<body>

<div id="container">
    <!-- Fixed navbar -->
    <?php $this->load->view("common/nav"); ?>

    <div class="container">

        <div class="col-xs-12 col-sm-9">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">首页</a></li>
                <li><a href="<?php echo site_url('forum/show/'.$fid); ?>"><?php echo $forum->forum_name; ?></a></li>
                <li class="active"><?php echo $message->subject; ?></li>
            </ol>
            <?php if (!empty($message)) {?>
                <h2><?php echo $message->subject; ?></h2>
                <p><?php echo stripslashes($message->msg_text); ?></p>
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