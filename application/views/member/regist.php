<?php $this->load->view("common/header"); ?>
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body>
<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">请填写表单</h2>
        <input type="text" class="form-control" name="username" required autofocus <?php if (isset($username)) { echo "disabled='disabled' readonly='readonly' value='".$username."'" ;} ?>>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <input name="email" class="form-control" type="text" <?php if (isset($email)) { echo "disabled='disabled' readonly='readonly' value='".$email."'" ;} ?>>
        <input name="captcha_code" class="form-control" type="text"> <span><img id="captcha_img" onclick="change();" src="<?php echo site_url('captcha')?>" /></span>

        <input type="hidden" name="submitted" value="1">
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> 勿忘我
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
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