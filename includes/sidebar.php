<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
            <a href="dashboard.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php'){ echo 'active'; } ?>"
                aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
            </a>
            <a href="home.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'home.php'){ echo 'active'; } ?>">
                <i class="fas fa-home fa-fw me-3"></i><span>Home</span>
            </a>
            <a href="about.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'about.php'){ echo 'active'; } ?>">
                <i class="fas fa-chart-line fa-fw me-3"></i><span>About</span>
            </a>
            <a href="product.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'product.php'){ echo 'active'; } ?>">
                <i class="fas fa-cart-plus fa-fw me-3"></i><span>Product</span>
            </a>
            <a href="new-arrival.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'new-arrival.php'){ echo 'active'; } ?>">
                <i class="fa fa-cart-arrow-down fa-fw me-3"></i><span>New Arrival</span>
            </a>
            <a href="best-seller.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'best-seller.php'){ echo 'active'; } ?>">
                <i class="fa fa-caret-square-o-up fa-fw me-3"></i><span>Best Seller</span>
            </a>
            <a href="testimoni.php"
                class="list-group-item list-group-item-action py-2 ripple <?php if(basename($_SERVER['PHP_SELF']) == 'testimoni.php'){ echo 'active'; } ?>">
                <i class="fa fa-comments fa-fw me-3"></i><span>Testimoni</span>
            </a>
        </div>
    </div>
</nav>