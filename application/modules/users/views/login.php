<div id="form">
    <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <fieldset>
            <legend>使用者登入</legend>
            <div>
                <label for="username">使用者帳號</label>
                <?php echo form_input('username', set_value('username', '')); ?>
            </div>
            <div>
                <label for="password">使用者密碼</label>
                <?php echo form_password('password', set_value('password', '')); ?>
            </div>
        </fieldset>
        <div>
            <?php echo form_submit('submit', '登入', 'class="form_submit"'); ?>
            <?php echo anchor(site_url('users/change_password'), "忘記密碼？") ?>
        </div>
    </form>
</div>