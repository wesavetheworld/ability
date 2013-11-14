<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>会员登录</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().CSS_PATH.'imgareaselect-default.css'; ?>" />
    <style type="text/css">
    </style>
</head>

<body>
    <div>
        <p><img id="photo" src="<?php echo AVATAR_IMAGE; ?>" /></p>
        <p><?php echo $username ;?></p>
        <p><?php echo $email; ?></p>
    </div>
</body>
<script type="text/javascript" src="<?php echo base_url().JS_PATH.'jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().JS_PATH.'jquery.imgareaselect.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('img#photo').imgAreaSelect({
            handles: true,
            onSelectEnd: function () {alert("done!")}
        });
    });
</script>
</html>