<?php $this->load->view("common/header"); ?>
<style>
    .form-signin {
        max-width: 550px;
        padding: 15px;
        margin: 0 auto;
    }
</style>
</head>

<body>
<div class="container">

    <?php if (count($errors) > 0) { ?>
        <?php foreach($errors as $error) {?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

    <?php } ?>


    <form class="form-signin" role="form" method="post">
        <h2 class="form-signin-heading">请填写表单</h2>
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" required>
            </div>
        </div>
        <div class="form-group">
            <label for="passwordagain" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" name="passwordagain" class="form-control" id="passwordagain" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail3" required placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="catpcha" class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="captcha_code" id="catpcha" required>
            </div>
            <div class="col-sm-5">
                <span class="control-label"><img src="<?php echo site_url('captcha')?>" /> <a href="">换一张</a></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> 记住我
                        <input type="hidden" name="submitted" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>
    </form>

</div> <!-- /container -->
</body>
<script>
    function change () {
        var img = document.getElementById("captcha_img");
        img.src = "<?php echo site_url('captcha')?>" + "?d=" + (new Date).getTime();
    }
</script>
</html>