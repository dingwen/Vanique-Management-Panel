<div id="list">
    <h2>產品類別列表</h2>
    <h2>主類別</h2>
    <table id="main" class="datatable" style="width: 100%;">
        <thead>
            <tr>
                <th>類別</th>
                <th>代碼</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($main_categories) AND !empty($main_categories)): ?>
            <?php foreach($main_categories as $main_cate): ?>
            <tr id="<?php echo $main_cate['id']; ?>">
                <td><?php echo $main_cate['name']; ?></td>
                <td><?php echo $main_cate['code']; ?></td>
                <td>
                    <?php echo anchor('admin/categories/edit_main/'.$main_cate['id'], "edit"); ?>&nbsp;
                    <?php echo anchor('admin/categories/delete/'.$main_cate['id'], "delete", 'class="confirm"'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <br />
    <br />
    <br />
    <h2>子類別</h2>
    <table id="sub" class="datatable" style="width: 100%;">
        <thead>
            <tr>
                <th>類別</th>
                <th>代碼</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($sub_categories) AND !empty($sub_categories)): ?>
            <?php foreach($sub_categories AS $sub_cate): ?>
            <tr>
                <td><?php echo $sub_cate['name']; ?></td>
                <td><?php echo $sub_cate['code']; ?></td>
                <td>
                    <?php echo anchor('admin/categories/edit_sub/'.$sub_cate['id'], "edit"); ?>
                    <?php echo anchor('admin/categories/delete/'.$sub_cate['id'], "delete", 'class="confirm"'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>