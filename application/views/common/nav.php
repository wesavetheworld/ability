<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url();?>">Ant Foot</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url(); ?>">首页</a></li>
                <li><a href="<?php echo site_url('single/about'); ?>">关于作者</a></li>
                <li><a href="#contact">联系我</a></li>
                <!--
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                -->
            </ul>
            <?php if ($this->sessionmanage->get_user_id() > 0) {
                $user_info = ($this->sessionmanage->get_user_info());
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="#"><?php echo $user_info; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li role="presentation"><a role="menuitem" href="<?php echo site_url('member'); ?>">个人中心</a></li>
                            <li role="presentation"><a role="menuitem" href="<?php echo site_url('forum/add_post/')?>">发布内容</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('member/logout'); ?>">退出</a></li>
                </ul>
            <?php } else {?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo site_url('member/logon'); ?>">登录</a></li>
                    <li><a href="<?php echo site_url('member/signin'); ?>">注册</a></li>
                </ul>
            <?php } ?>


        </div><!--/.nav-collapse -->
    </div>
</div>