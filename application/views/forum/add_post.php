<?php $this->load->view("common/header"); ?>
</head>

<body>
<div id="container">
    <?php $this->load->view("common/nav");?>
    <div class="col-xs-12 col-sm-9">
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="msg_subject" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                    <div class="col-xs-7">
                        <input type="text" name="msg_subject" class="form-control" id="msg_subject" placeholder="请输入标题">
                    </div>
                    <div class="col-xs-3">
                        <select class="form-control" name="forum_id">
                            <option value="0">请选择板块</option>
                            <?php foreach($forums as $forum ) { ?>
                                <option value="<?php echo $forum->forum_id; ?>"> <?php echo $forum->forum_name; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="msg_text" class="col-sm-2 control-label">内容</label>
                <div class="col-sm-10">
                    <textarea id="msg_text" class="form-control" rows="5" name="msg_text"></textarea>
                </div>
            </div>
            <input type="hidden" name="submitted" value="1">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">确定</button>
                </div>
            </div>
        </form>

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
</div>
<script type="text/javascript" src="<?php echo base_url().EDITER_PATH.'/kindeditor.js'?>"></script>
<script type="text/javascript">
    KindEditor.ready(function(K) {
        window.editor = K.create('#msg_text');
    });
</script>

</body>

</html>
