<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="<?php echo $company_url ?>" target="_blank"><?php echo $company_name ?></a>.</strong> All rights reserved.
    <div class="pull-right hidden-xs"><strong>Version</strong> 1.0</div>
</footer>
        </div>
    <?php foreach ($jsBottom as $src): ?>
    <script src="<?php echo $src; ?>" type="text/javascript"></script>
    <?php endforeach ?>
</body>
</html>