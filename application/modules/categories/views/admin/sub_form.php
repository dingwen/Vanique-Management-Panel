<div id="form">
    <h2>新增子類別</h2>
    <p class="form_note">欄位旁有（<span class="required">*</span>）標記，為必須填寫。</p>
    <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <fieldset>
            <legend>子類別資料</legend>
            <div>
                <label>主類別名稱</label>
                <?php echo form_dropdown('main_id', $category->main_categories, set_value('main_id', $category->main_id)); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label>子類別名稱</label>
                <?php echo form_input('name', set_value('name', $category->name)); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label>代碼</label>
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