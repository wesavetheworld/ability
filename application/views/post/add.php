<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>新增技能</title>

    <style type="text/css">
    </style>
</head>

<body>
<form method="post" action="<?php echo site_url('post/add')?>">
    标题 : <input name="title" type="text" ><br>
    内容   : <textarea name="content"></textarea><br>
    <input type="hidden" name="submitted" value="1">
    <input type="submit" value="确定">
</form>
</body>
</html>