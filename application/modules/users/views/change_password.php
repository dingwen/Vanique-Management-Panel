<div id="form">
    <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <fieldset>
            <legend>重設密碼</legend>
            <div>
                <label for="username">帳號</label>
                <?php echo form_input('username', set_value('username', '')); ?>
            </div>
            <div>
                <label for="password">輸入新密碼</label>
                <?php echo form_password('password', set_value('password', '')); ?>
            </div>
            <div>
                <label for="confirm_password">確認新密碼</label>
                <?php echo form_password('confirm_password', set_value('confirm_password', '')); ?>
            </div>
        </fieldset>
        <div>
            <?php echo form_submit('submit', '修改', 'class="form_submit"'); ?>
        </div>
    </form>
</div>