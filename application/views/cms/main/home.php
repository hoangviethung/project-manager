<!-- begin .app-main -->
<div class="app-main">

    <!-- begin .main-heading -->
    <header class="main-heading shadow-2dp">
        <!-- begin dashhead -->
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h6 class="dashhead-subtitle">
                    La Jew / Thống Kê
                </h6>
                <h3 class="dashhead-title">Thống Kê</h3>
            </div>

            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item">
                    Sản phẩm / Thống Kê
                </div>
            </div>
        </div>
        <!-- END: dashhead -->
    </header>
    <!-- END: .main-heading -->

    <!-- begin .main-content -->
    <div class="main-content bg-clouds">

        <!-- begin .container-fluid -->
        <div class="container-fluid p-t-15">
            <div class="box b-a">

                <div class="box-body">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <h3 class=m-b-15>Thống Kê Sản Phẩm</h3>
                        </div>
                        <div class="col-md-3">
                            <div class="product-report-item">
                                <div class="product-report-wrap">
                                    <div class="product-report-icon bg-primary">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <h3 class="product-report-title">
                                        Tổng Sản Phẩm
                                    </h3>
                                    <p class="product-report-info" id='all-product-count'>
                                        <?php echo count($products); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="product-report-item">
                                <div class="product-report-wrap">
                                    <div class="product-report-icon bg-success">
                                        <i class="fas fa-cart-plus"></i>
                                    </div>
                                    <h3 class="product-report-title">
                                        Sản Phẩm Mới
                                    </h3>
                                    <p class="product-report-info" id='new-product-count'>
                                        <?php echo count($new_products); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="product-report-item">
                                <div class="product-report-wrap">
                                    <div class="product-report-icon bg-danger">
                                        <i class="fas fa-cart-arrow-down"></i>
                                    </div>
                                    <h3 class="product-report-title">
                                        Sản Phẩm Sale
                                    </h3>
                                    <p class="product-report-info" id='sale-product-count'>
                                        <?php echo count($sale_products); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>Thống Kê Đơn Hàng</h3>
                        </div>
                        <div class="col-md-12">
                            <ul class="nav nav-tabs chart_tab" id="myTab" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link active" id="last_7_days-tab" data-toggle="tab" href="#last_7_days" role="tab" aria-controls="last_7_days" aria-selected="true">7 ngày gần nhất</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="last_30_days-tab" data-toggle="tab" href="#last_30_days" role="tab" aria-controls="last_30_days" aria-selected="false">30 ngày gần nhất</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="last_year-tab" data-toggle="tab" href="#last_year_tab" role="tab" aria-controls="last_year_tab" aria-selected="false">12 tháng gần nhất</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade in active" id="last_7_days" role="tabpanel" aria-labelledby="last_7_days-tab">
                                    <div class="chart-container">
                                        <canvas id="last_7"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="last_30_days" role="tabpanel" aria-labelledby="last_30_days-tab">
                                    <div class="chart-container">
                                        <canvas id="last_30"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="last_year_tab" role="tabpanel" aria-labelledby="last_year-tab">
                                    <div class="chart-container">
                                        <canvas id="last_year"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- END: .container-fluid -->
            <!-- 
	</div> -->
            <!-- END: .main-content -->

        </div>
    </div>
    <!-- END: .app-main -->

    <script>
        var ChartData_7 = <?php echo json_encode($chart_data['last_7_days']); ?>;
        var ChartData_30 = <?php echo json_encode($chart_data['last_30_days']); ?>;
        var ChartData_year = <?php echo json_encode($chart_data['last_year']); ?>;


        function animateValue(id, start, end, duration) {
            // assumes integer values for start and end

            var obj = document.getElementById(id);
            var range = end - start;
            // no timer shorter than 50ms (not really visible any way)
            var minTimer = 50;
            // calc step time to show all interediate values
            var stepTime = Math.abs(Math.floor(duration / range));

            // never go below minTimer
            stepTime = Math.max(stepTime, minTimer);

            // get current time and calculate desired end time
            var startTime = new Date().getTime();
            var endTime = startTime + duration;
            var timer;

            function run() {
                var now = new Date().getTime();
                var remaining = Math.max((endTime - now) / duration, 0);
                var value = Math.round(end - (remaining * range));
                obj.innerHTML = value;
                if (value == end) {
                    clearInterval(timer);
                }
            }

            timer = setInterval(run, stepTime);
            run();
        }

        animateValue("all-product-count", 0, <?php echo count($products); ?>, 1000);
        animateValue("new-product-count", 0, <?php echo count($new_products); ?>, 1000);
        animateValue("sale-product-count", 0, <?php echo count($sale_products); ?>, 1000);
    </script>