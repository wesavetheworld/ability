<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>创建文章</title>

    <style type="text/css">
    </style>
</head>

<body>
<form method="post">
    名称 : <input name="msg_subject" type="text" ><br>
    内容 : <textarea id="msg_text" name="msg_text"></textarea><br>
    <input type="hidden" name="submitted" value="1">
    <input type="submit" value="确定">
</form>
</body>
<script type="text/javascript" src="<?php echo base_url().EDITER_PATH.'/kindeditor.js'?>"></script>
<script type="text/javascript">
    KindEditor.ready(function(K) {
        window.editor = K.create('#msg_text');
    });
</script>
</html>