<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>创建内容</title>

    <style type="text/css">
    </style>
</head>

<body>
<h1>FORUM LIST</h1>
<?php if (count($forums) > 0 && $fid > 0) { ?>

    <?php foreach($forums as $forum) { ?>
        <h2><?php echo $forum->forum_name; ?></h2>
        <p><?php echo $forum->discription; ?></p>

        <?php if (count($messages) > 0) { ?>
            <?php foreach($messages as $message) { ?>
                <?php if ($message->forum_id == $forum->forum_id) { ?>
                    <h4><a href="<?php echo site_url('forum/show/'.$forum->forum_id.'/'.$message->msg_id)?>"><?php echo $message->subject; ?></a></h4>
                <? } ?>
            <? } ?>
        <? } ?>
    <? } ?>

<?php } ?>

</body>

</html>