<?php $this->load->view("common/header"); ?>

</head>
<body>

    <div class="container">
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">请填写表单</h2>
            <input type="text" class="form-control" name="group_name" required autofocus>

            <label class="checkbox-inline">
                <input type="checkbox" name="permission[]" value="adminer"> 管理员
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="permission[]" value="forum"> 板块
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="permission[]" value="post"> 发布文章
            </label>
            <input type="hidden" name="submitted" value="1">

            <button class="btn btn-lg btn-primary btn-block" type="submit">OK</button>
        </form>
    </div>
</body>
</html>