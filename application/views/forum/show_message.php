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
                <div>
                    <span>作者 ：<?php echo $user_info->username; ?></span> |
                    <span>创建日期 ： <?php echo date('Y-m-d', strtotime($message->msg_date)); ?></span> |
                    <span>浏览次数 ： <?php echo $message->viewcount; ?></span>
                </div>
                <p><?php echo stripslashes($message->msg_text); ?></p>
            <?php } ?>

            <?php if (!empty ($comments)) { ?>
                <?php foreach($comments as $comment) { ?>
                    <?php $comment_user = $comment->get_comment_user_info();?>
                    <div class="well"><img src="<?php echo base_url().IMAGE_PATH.'avatars/'.($comment_user->avatar ?  $comment_user->id : 'default').'_small.jpg'; ?>"><?php echo $comment_user->username ;?> 说：<?php echo $comment->contect; ?></div>
                <?php } ?>
            <?php } ?>

            <?php if ($visitor) {?>
            <div class="well col-xs-11">

                <span class="col-xs-2"><img src="<?php echo base_url().IMAGE_PATH.'avatars/'.($visitor->avatar ?  $visitor->id : 'default').'.jpg'; ?>"></span>
                <span class="col-xs-10">
                    <textarea class="form-control" rows="3" id="j_comment_content"></textarea><br >
                    <button type="submit" class="btn btn-default j_comment">确定</button>
                </span>
            </div>
            <?php } else { ?>
                <a href="<?php echo site_url('member/logon'); ?>">请登录，然后评论</a>
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

    <script src="<?php echo base_url().JS_PATH.'jquery.min.js'; ?>"></script>
    <script src="<?php echo base_url().JS_PATH.'bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().JS_PATH.'comment.js'; ?>"></script>
    <script type="text/javascript">
        $('.j_comment').comment({
            url : "<?php echo site_url('commentmanage/add')?>",
            fid : <?php echo $fid; ?>,
            mid : <?php echo $msg_id; ?>,
            uid : <?php echo $user_info->id ; ?>,
            commentInput : '#j_comment_content',
            successCall : function (response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert(response.failDesc);
                    return false;
                }
            }
        })
    </script>
</div>

<?php $this->load->view('common/footer'); ?>