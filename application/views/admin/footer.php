<script src="<?php echo base_url().JS_PATH.'bootstrap-old.js'; ?>"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
        $(".j_ajax_method").click(function() {
            $.ajax({
                url : $(this).attr("alt-href"),
                success : function (response) {
                    $(".j_main").html(response);
                }
            })
        })
    });
</script>

</body>
</html>