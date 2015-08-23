<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="<?php echo $company_url ?>" target="_blank"><?php echo $company_name ?></a>.</strong> All rights reserved.
    <div class="pull-right hidden-xs"><strong>Version</strong> 1.0</div>
</footer>
        </div>
    <?php foreach ($jsBottom as $src): ?>
    <script src="<?php echo $src; ?>" type="text/javascript"></script>
    <?php endforeach ?>
    <script>
    $(document).on('change', 'select#current_clinic', function() {
        var switch_clinic = $(this).val();
        $('#body_loading').show();
        $.ajax({
            url: base_url + 'ajax/switch_clinic/' + switch_clinic,
            success: function(response) {
                // Add alert/notification here
                $('#body_loading').hide();
            },
            complete: function(xhr, textStatus) {
                $('#body_loading').hide();
            }
        });
    });
    </script>
<div class="overlay" id="body_loading" style="display:none"><i class="fa fa-refresh fa-spin"></i></div>

</body>
</html>