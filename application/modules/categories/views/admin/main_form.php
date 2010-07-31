<div id="form">
    <h2>新增主類別</h2>
    <p class="form_note">欄位旁有（<span class="required">*</span>）標記，為必須填寫。</p>
    <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <fieldset>
            <legend>主類別資料</legend>
            <div>
                <label for="name">名稱</label>
                <?php echo form_input('name', set_value('name', $category->name)); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label for="code">代碼</label>
                <?php echo form_input('code', set_value('code', $category->code)); ?>
                <span class="required">*</span>
            </div>
        </fieldset>
        <div>
            <?php echo form_submit('submit', '送出資料', 'class="form_submit"'); ?>
            <?php echo anchor(site_url('admin/categories'), '取消', 'class="form_cancel"'); ?>
        </div>
    </form>
</div>