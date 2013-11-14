<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>新增技能</title>

    <style type="text/css">
    </style>
</head>

<body>
<ul>
    <?php foreach($posts as $post) { ?>
    <li><a href="<?php echo site_url('post/show').'/'.$post->id; ?>"><?php echo $post->post_title?></a></li>
    <?php } ?>
</ul>
</body>
</html>