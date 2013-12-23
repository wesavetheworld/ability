

    <div class="header">

        <h1 class="page-title">Users</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="<?php echo site_url('admin')?>">首页</a> <span class="divider">/</span></li>
        <li class="active">用户列表</li>
    </ul>

    <div class="container-fluid">
        <div class="row-fluid">

            <div class="btn-toolbar">
                <button class="btn btn-primary"><i class="icon-plus"></i> New User</button>
                <button class="btn">Import</button>
                <button class="btn">Export</button>
                <div class="btn-group">
                </div>
            </div>
            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th style="width: 26px;"></th>
                    </tr>
                    </thead>
                    <tbody class="j_users">


                    </tbody>
                </table>
            </div>
            <script src="<?php echo base_url().JS_PATH.'jquery.simplePagination.js'; ?>"></script>
            <script type="text/javascript">
                var getPageData = function (data) {
                    $.ajax({
                        url : "<?php echo site_url('admin/ajax/users/')?>",
                        data : data,
                        dataType : 'json',
                        success : function (response) {
                            $('.j_users').html("");
                            var resLength = response.length;
                            for (var i = 0; i < resLength; i ++) {
                                var str = '<tr>';
                                str += '<td>' + response[i].id + '</td>';
                                str += '<td>' + response[i].username + '</td>';
                                str += '<td>' + response[i].email + '</td>';
                                str += '<td>' + ((response[i].is_active > 0) ? "已激活" : "未激活") + '</td>';
                                str += '<td>';
                                str += '<a href="user.html"><i class="icon-pencil"></i></a>';
                                str += '<a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>';
                                str += '</td>';
                                str += '</tr>';

                                $('.j_users').append(str);
                            }
                        }
                    })
                };
                $(function() {
                    $(".pagination").pagination({
                        items: <?php echo $user_count; ?>,
                        itemsOnPage: 10,
                        cssStyle: 'light-theme',
                        onPageClick : function (pageNumber, event) {
                            getPageData('start='+pageNumber+'&step=10');
                        },
                        onInit : function() {
                            getPageData('start=1&step=10');
                        }
                    });
                });
            </script>
            <div class="pagination">

            </div>

            <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete Confirmation</h3>
                </div>
                <div class="modal-body">
                    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>



            <footer>
                <hr>
                <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>


                <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
            </footer>

        </div>
    </div>

