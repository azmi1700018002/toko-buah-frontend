<?php include('../helpers/token_session.php'); ?>
<?php include('../includes/header.php'); ?>

<main style="margin-top: 58px">
    <div class="container pt-4">
        <section>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Posts</h4>
                                        <p class="mb-0">Monthly blog posts</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">18,000</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Comments</h4>
                                        <p class="mb-0">Monthly blog posts</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">84,695</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0 me-4">$76,456.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Monthly Sales Amount</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-heart text-danger fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0 me-4">$36,000.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Cost</h4>
                                        <p class="mb-0">Monthly Cost</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-wallet text-success fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-4">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0 text-center"><strong>Sales</strong></h5>
                </div>
                <div class="card-body">
                    <canvas class="my-4 w-100" id="myChart" height="380"></canvas>
                </div>
            </div>
        </section>
    </div>
</main>
<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<script type="text/javascript" src="../assets/js/admin.js"></script>
</body>


</html>