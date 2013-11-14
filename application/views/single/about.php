<?php $this->load->view("common/header"); ?>
<style type="text/css">
    body {
        min-height: 2000px;
        padding-top: 70px;
    }
</style>
</head>
<body>
<div id="container">
    <?php $this->load->view("common/nav"); ?>
    <div class="well well-lg">
        <div class="media">
            <a class="pull-left" href="#">
                <img class="img-circle media-object" width="100" height="100" src="<?php echo base_url().IMAGE_PATH.'authors/sihuayin.jpg'; ?>" alt="司华印">
            </a>
            <div class="media-body">
                <h4 class="media-heading">sihuayin</h4>
                <p>喜爱编程，喜爱一切很好地事物。略胖，但是为人祥和，对人友善。很想当个geek，可惜还有很多大事情等待着我。</p>
                <p>喜欢交朋友，也喜欢玩游戏。输得时候都责怪自己没有玩好，赢了的时候都是队友配合的好！</p>
                <p>哎呀！ 时间到了，我要拯救地球去了。</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>