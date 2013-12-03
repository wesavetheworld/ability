<?php $this->load->view("common/header"); ?>
</head>

<body>
<div id="container">
    <?php $this->load->view("common/nav"); ?>
    <div class="container">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">用户中心</div>
            <div class="panel-body">
                <div class="well">
                    <div class="page-header" style="margin: 0 0 10px 0;">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="#">个人信息</a></li>
                            <li><a href="#">阿赫</a></li>
                            <li><a href="#">其他</a></li>
                        </ul>
                    </div>


                    <form class="form-horizontal" role="form">
                        <div class="col-xs-12 col-sm-8">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">账号：</label>
                                <div class="col-sm-10">
                                    <label class=" control-label"><?php echo $username ;?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">邮箱：</label>
                                <div class="col-sm-10">
                                    <label class=" control-label"><?php echo $email ;?></label>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <p></p>
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img id="photo" class="media-object" src="<?php echo AVATAR_IMAGE; ?>" />
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">头像设置</h4>
                                    <p>支持 jpg、gif、png 等格式的图片</p>
                                    <button type="button" class="upload_img btn btn-primary">上传图片</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>


        </div>

    </div>

</div>

</body>
<script type="text/javascript" src="<?php echo base_url().JS_PATH.'jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().JS_PATH.'jquery.imgareaselect.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().JS_PATH.'jquery-upload.js'?>"></script>
<script type="text/javascript">
    jQuery(function($){
        $('.upload_img').fineUploader({
            request: {
                endpoint: '<?php echo site_url("upload/avatar/")?>',
                inputName : 'userfile'
            },
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                sizeLimit: 512000
            },
            text : {
                uploadButton: '<button type="button" class="upload_img btn btn-primary">上传图片</button>'
            },
            template : '<div class="qq-uploader clearfix">' +
                '<pre class="qq-upload-drop-area"><span></span></pre>' +
                '<div class="qq-upload-button btn btn-success">{uploadButtonText}</div>' +
                '<div class="tips">5M, jpg, png, jpeg</div>'+
                '<span class="qq-drop-processing"><span></span>'+
                '<span class="qq-drop-processing-spinner"></span></span>'+
                '</div>'+
                '<div><ul class="qq-upload-list"></ul></div>',
            multiple: false

        }).on('complete', function(id, name, responseJSON, xhr) {
                $("img#photo").attr('src','<?php echo base_url().IMAGE_PATH."avatars/"?>'+xhr.file_name);
            });
    });

</script>
</html>