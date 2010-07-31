<div id="form">
    <h2>新增廠商/供應商</h2>
    <p class="form_note">欄位旁有（<span class="required">*</span>）標記，為必須填寫。</p>
    <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <fieldset>
            <legend>基本資料</legend>
            <div>
                <label for="name">名稱</label>
                <?php echo form_input('name', set_value('name', $product->name), 'class="long"'); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label for="code">編號</label>
                <?php echo form_input('code', set_value('code', $product->code)); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label for="fill_date">填表日期</label>
                <?php echo form_input('fill_date', set_value('fill_date', $product->fill_date), 'class="date_mask"'); ?>
                <span class="required">*</span>
                <p class="format_note">年-月-日 ex. 1989-12-08</p>
            </div>
            <div>
                <label for="note">備註</label>
                <?php
                    $option = array(
                        'name' => 'note',
                        'value' => set_value('note', $product->note),
                        'rows' => "8",
                        'cols' => "40"
                    );
                    echo form_textarea($option);
                ?>
            </div>
        </fieldset>
        <div>
            <?php echo form_submit('submit', '送出資料', 'class="form_submit"'); ?>
            <?php echo anchor(site_url('admin/suppliers'), '取消', 'class="form_cancel"'); ?>
        </div>
    </form>
</div>