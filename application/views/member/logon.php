<?php $this->load->view("common/header"); ?>
</head>

<body>
<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">请填写表单</h2>
        <input type="text" class="form-control" name="username" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <input type="hidden" name="submitted" value="1">
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> 勿忘我
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    </form>

</div> <!-- /container -->
</body>
</html>