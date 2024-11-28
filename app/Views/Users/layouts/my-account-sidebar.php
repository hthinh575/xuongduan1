<div class="col-lg-3">
    <div class="wrap-sidebar-account">
        <ul class="my-account-nav">
            <li><a href="<?= BASE_URL ?>?act=my-account" class="my-account-nav-item
            <?= $_GET['act'] == 'my-account' ? 'active' : '' ?>
            ">Bảng tài khoản</a></li>
            <li><a href="my-account-orders.html" class="my-account-nav-item">Orders</a></li>
            <li><a href="my-account-address.html" class="my-account-nav-item">Address</a></li>
            <li><a href="<?= BASE_URL ?>?act=account-detal" class="my-account-nav-item
            <?= $_GET['act'] == 'account-detal' ? 'active' : '' ?>
            ">Chi tiết tài khoản</a></li>
            <li><a href="my-account-wishlist.html" class="my-account-nav-item">Wishlist</a></li>
            <li><a href="<?= BASE_URL ?>?act=logout" class="my-account-nav-item">Đăng xuất</a></li>
        </ul>
    </div>
</div>