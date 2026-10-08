<?php
// đang có vấn đề
require_once 'model/product.php';

include 'view/header.php';

$products = getAllProducts();
?>
<h2>Danh sách sản phẩm</h2>
<p><a href="product_add.php">[+] Thêm sản phẩm mới</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>
                        <a href="product_edit.php?id=<?= $item['id'] ?>">Sửa</a> | 
                        <a href="product_delete.php?id=<?= $item['id'] ?>">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Chưa có sản phẩm nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'view/footer.php';?>

