<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>分类列表</title>

    <style type="text/css">
    </style>
</head>

<body>
<h1>分类</h1>
<?php if (count($forums) > 0) {?>
    <?php foreach($forums as $forum) { ?>
       <div><a href="<?php echo site_url('forum/show/'.$forum->forum_id)?>"><?php echo $forum->forum_name ?></a></div>
    <? } ?>
<? } ?>

</body>

</html>