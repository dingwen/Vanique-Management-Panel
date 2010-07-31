<div id="form">
    <h2>新增廠商/供應商</h2>
    <p class="form_note">欄位旁有（<span class="required">*</span>）標記，為必須填寫。</p>
    <form action="<?php echo site_url(uri_string()); ?>" method="post">
        <fieldset>
            <legend>基本資料</legend>
            <div>
                <label for="name">名稱</label>
                <?php echo form_input('name', set_value('name', $supplier->name), 'class="long"'); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label for="code">代碼</label>
                <?php echo form_input('code', set_value('code', $supplier->code)); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label for="fill_date">填表日期</label>
                <?php echo form_input('fill_date', set_value('fill_date', $supplier->fill_date), 'class="date_mask"'); ?>
                <span class="required">*</span>
                <p class="format_note">年-月-日 ex. 1989-12-08</p>
            </div>
            <div>
                <label for="note">備註</label>
                <?php
                    $option = array(
                        'name' => 'note',
                        'value' => set_value('note', $supplier->note),
                        'rows' => "8",
                        'cols' => "40"
                    );
                    echo form_textarea($option);
                ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>聯絡方式</legend>
            <div>
                <label for="contact">聯絡人</label>
                <?php echo form_input('contact', set_value('contact', $supplier->contact)); ?>
                <span class="required">*</span>
            </div>
            <div>
                <label for="contact">公司/廠商網址</label>
                <?php echo form_input('website', set_value('website', $supplier->website), 'class=middle'); ?>
            </div>
            <div>
                <label for="phone">電話</label>
                <?php echo form_input('phone', set_value('phone', $supplier->phone)); ?>
            </div>
            <div>
                <label for="phone">手機</label>
                <?php echo form_input('cell', set_value('cell', $supplier->cell)); ?>
            </div>
            <div>
                <label for="fax">傳真</label>
                <?php echo form_input('fax', set_value('fax', $supplier->fax)); ?>
            </div>
            <div>
                <label for="email">Email</label>
                <?php echo form_input('email', set_value('email', $supplier->email), 'class="long"'); ?>
            </div>
            <div>
                <label for="qq_account">QQ帳號</label>
                <?php echo form_input('qq_account', set_value('qq_account', $supplier->qq_account)); ?>
            </div>
            <div>
                <label for="ali_wangwang">阿里旺旺</label>
                <?php echo form_input('ali_wangwang', set_value('ali_wangwang', $supplier->ali_wangwang)); ?>
            </div>
            <div>
                <label for="taobao">淘寶</label>
                <?php echo form_input('taobao', set_value('taobao', $supplier->taobao)); ?>
            </div>
            <div>
                <label for="msn_account">MSN帳號</label>
                <?php echo form_input('msn_account', set_value('msn_account', $supplier->msn_account), 'class="long"'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>聯絡地址</legend>
            <div>
                <label for="address">地址</label>
                <?php echo form_input('address', set_value('address', $supplier->address), 'class="long"'); ?>
            </div>
            <div>
                <label for="village">村/里</label>
                <?php echo form_input('village', set_value('village', $supplier->village)); ?>
            </div>
            <div>
                <label for="district">區</label>
                <?php echo form_input('district', set_value('district', $supplier->district)); ?>
            </div>
            <div>
                <label for="township">鄉/鎮</label>
                <?php echo form_input('township', set_value('township', $supplier->township)); ?>
            </div>
            <div>
                <label for="city">縣/市</label>
                <?php echo form_input('city', set_value('city', $supplier->city)); ?>
            </div>
            <div>
                <label for="region">省</label>
                <?php echo form_input('region', set_value('region', $supplier->region)); ?>
            </div>
            <div>
                <label for="country">國家</label>
                <?php echo form_input('country', set_value('country', $supplier->country)); ?>
            </div>
            <div>
                <label for="postcode">郵遞區號</label>
                <?php echo form_input('postcode', set_value('postcode', $supplier->postcode)); ?>
            </div>
        </fieldset>
        <div>
            <?php echo form_submit('submit', '送出資料', 'class="form_submit"'); ?>
            <?php echo anchor(site_url('admin/suppliers'), '取消', 'class="form_cancel"'); ?>
        </div>
    </form>
</div>