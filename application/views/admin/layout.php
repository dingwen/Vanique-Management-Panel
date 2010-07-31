<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
        <title><?php echo $template['title']; ?></title>
        <?php echo $template['metadata']; ?>
        <?php if(isset($css) AND !empty($css)): ?>
            <?php foreach($css as $style): ?>
                <?php echo $style."\n"; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>
        <div id="wrapper">
            <?php echo $template['partials']['header']; ?>
			<?php echo $template['partials']['nav']; ?>
            <div id="auth_box">
                <label><?php echo $this->session->userdata('full_name'); ?></label>
                <?php echo anchor(site_url('users/logout'), '登出'); ?>
            </div>
            <div id="content_wrapper">
            <?php if (!empty($template['partials']['side_menu'])): ?>
                <div id="left_col">
                    <?php echo $template['partials']['side_menu']; ?>
                </div>
                <div id="right_col">
                    <?php $this->load->view('admin/result_messages'); ?>
                    <?php echo $template['body']; ?>
                </div>
            <?php else: ?>
                <div id="mid_col">
                    <?php $this->load->view('admin/result_messages'); ?>
                    <?php echo $template['body']; ?>
                </div>
            <?php endif; ?>
            </div>
            <?php echo $template['partials']['footer']; ?>
        </div>
    </body>
    <script type="text/javascript">
        var APPPATH_URI = "<?php echo APPPATH_URI;?>";
        var BASE_URL = "<?php echo base_url();?>";
        var BASE_URI = "<?php echo BASE_URI;?>";
        var ASSETS_URI = "<?php echo BASE_URI . 'application/assets/';?>";
    </script>
    <?php if(isset($js) AND !empty($js)): ?>
        <?php foreach($js as $script): ?>
            <?php echo $script."\n"; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if(isset($inline_js) AND !empty($inline_js)): ?>
    <?php echo $inline_js; ?>
    <?php endif; ?>
</html>