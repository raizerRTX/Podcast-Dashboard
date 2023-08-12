<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Podcast | Dashboard  </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=base_url('app/Views/dashboard/assets/img/favicon/favicon.ico')?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/assets/vendor/fonts/boxicons.css')?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/assets/vendor/css/core.css')?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/assets/vendor/css/theme-default.css')?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/assets/css/demo.css')?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')?>" />
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/assets/vendor/libs/apex-charts/apex-charts.css')?>" />
    <link rel="stylesheet" href="<?=base_url('app/Views/dashboard/libs/calendar/dist/calendar-gc.min.css')?>" />

    <!-- Page CSS -->
    <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?=base_url("app/Views/dashboard/assets/css/index.css")?>" rel="stylesheet">

    <!-- Helpers -->
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/js/helpers.js')?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=base_url('app/Views/dashboard/assets/js/config.js')?>"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                    id = "search"
                  />
                </div>
              </div>
              <!-- /Search -->

            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row h-100">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="<?=base_url('app/Views/dashboard/assets/img/icons/unicons/pods.png')?>"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Cacao Pods</span>
                          <h3 class="card-title mb-2" id="pods_dashboard"><?=number_format($total_pods)?></h3>
                          <small class="text-warning fw-semibold" id="pods_prcnt">--%</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="<?=base_url('app/Views/dashboard/assets/img/icons/unicons/beans.jpg')?>"
                                alt="Credit Card"
                                class="rounded img-fluid"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Beans</span>
                          <h3 class="card-title mb-2" id="beans_dashboard"><?=number_format($total_beans)?></h3>
                          <small class="text-warning fw-semibold" id="beans_prcnt">--%</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 order-3 order-md-2" id="weight-widget">
                  <div class="row d-flex flex-row">
                    <div id="w1" class="col-6 mb-4 w-25">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="<?=base_url('app/Views/dashboard/assets/img/icons/unicons/pods.png')?>" alt="img" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Weight</span>
                          <h3 class="card-title text-nowrap mb-2" id="pods_weight">0</h3>
                          <small class="text-warning fw-semibold" id="pods_w_prcnt">--%</small>
                        </div>
                      </div>
                    </div>
                    <div id="w2" class="col-6 mb-4 w-25">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="<?=base_url('app/Views/dashboard/assets/img/icons/unicons/beans.jpg')?>" alt="img" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Weight</span>
                          <h3 class="card-title text-nowrap mb-2" id="beans_weight">0</h3>
                          <small class="text-warning fw-semibold" id="beans_w_prcnt">--%</small>
                        </div>
                      </div>
                    </div>
                    <div id="w3" class="col-6 mb-4 w-50">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="w-100 d-flex flex-sm-column w-auto flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Converter</h5>
                              </div>
                              <div class="mt-sm-auto ms-2 w-100">
                                <div class="input-group input-group-sm mb-3">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">Cacao Beans Weight</span>
                                  <input type="number" class="form-control" id="input_weight" placeholder="in kg" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                  <span class="input-group-text">&#8369</span>
                                  <input disabled type="text" id="resultField" class="form-control" placeholder="0.00" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <button id="calculate" class="btn btn-primary btn-sm" type="button">Calculate</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Combined Total -->
                <div id="combined_total_panel" class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4 w-100">
                  <div class="card h-100">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3"><b>Combined Total Statistics</b></h5>
                        <div id="combinedTotalChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button data-hash = "<?=csrf_hash()?>" 
                                data-token = "<?=csrf_token()?>"
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="ct_button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                
                              </button>
                              <div id = "ct_items" class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mt-3" id="cGrowthChart"></div>
                        <div class="text-center fw-semibold pt-3 mt-2">Overview</div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Combined Total -->
              </div>
              <!-- Pods statistics -->
              <div id="cacao_pods_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3"><b>Cacao Pods Statistics</b></h5>
                        <div id="podsStatistics" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button data-hash = "<?=csrf_hash()?>" 
                                data-token = "<?=csrf_token()?>"
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="v_button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                
                              </button>
                              <div id="cvs_items" class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId1"></div>
                            </div>
                          </div>
                        </div>
                        <div id="podsGrowthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">Overview</div>
                      </div>
                    </div>
                </div>
              </div>
              <!-- /Pods statistics -->

              <!-- Beans Statitistics -->
              <div id="cacao_beans_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3"><b>Cacao Beans Statistics</b></h5>
                        <div id="beansStatistics" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button data-hash = "<?=csrf_hash()?>" 
                                data-token = "<?=csrf_token()?>"
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="beans_button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                
                              </button>
                              <div id="b_items" class="dropdown-menu dropdown-menu-end" aria-labelledby="beans_growth_report"></div>
                            </div>
                          </div>
                        </div>
                        <div id="beansGrowthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">Overview</div>
                      </div>
                    </div>
                </div>
              </div>
              <!-- / Beans Statistics -->
              
              <!-- Calendar -->
              <div id="calendar_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                  <div class="row row-bordered g-0">
                    <div class="col-md-8">
                      <h5 class="card-header m-0 me-2 pb-3"><b>Cacao Harvest Calendar</b></h5>
                    </div>
                    <hr>
                  </div>
                  <div class="container-fluid overflow-auto">
                    <div id="calendar">
                    </div>
                  </div>
                  <br>
                </div>
              </div>
              <!-- / Calendar -->

              <!-- Analytics Table -->
              <div id="analytics_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                  <div class="row row-bordered g-0">
                    <div class="col-md-8">
                      <h5 class="card-header m-0 me-2 pb-3"><b>Tree Data Analytics</b></h5>
                    </div>
                    <hr>
                  </div>
                  <div class="container-fluid overflow-auto">
                    <table class="dataTable table-stripe text-center display responsive" cellspacing="0" id="myTable">
                      <thead>
                          <tr>
                              <th class="text-center">Tree ID</th>
                              <th class="text-center">Tree Variety</th>
                              <th class="text-center">Surveyor</th>
                              <th class="text-center">Date Surveyed</th>
                              <th class="text-center">Latitude</th>
                              <th class="text-center">Longtitude</th>
                              <th class="text-center">Last Fertilize Date</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                  <br>
                </div>
              </div>
              <!-- / Analytics Table -->

              <!-- Tree Status Table -->
              <div id="status_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                  <div class="row row-bordered g-0">
                    <div class="col-md-8">
                      <h5 class="card-header m-0 me-2 pb-3"><b>Tree Status Management</b></h5>
                    </div>
                    <hr>
                  </div>
                  <div class="container-fluid overflow-auto">
                    <table class="dataTable table-stripe text-center display responsive" cellspacing="0" id="statusTable">
                      <thead>
                          <tr>
                              <th class="text-center">Tree ID</th>
                              <th class="text-center">Tree Variety</th>
                              <th class="text-center">Last Modified Date</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                  <br>
                </div>
              </div>
              <!-- / Tree Status Table -->

              <!-- Forecast Table -->
              <div id="forecast_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                  <div class="row row-bordered g-0">
                    <div class="col-md-8">
                      <h5 class="card-header m-0 me-2 pb-3"><b>Tree Yield Data Forecast</b></h5>
                    </div>
                    <hr>
                  </div>
                  <div class="container-fluid d-flex flex-row">
                    <div class="container me-3 w-75 card">
                      <div id="yieldGraph" class="px-2"></div>
                    </div>
                    <div class="container overflow-auto card">
                      <br>
                      <br>
                      <table class="dataTable table-stripe text-center display responsive" cellspacing="0" id="forecast_tbl">
                        <thead>
                            <tr>
                                <th class="text-center">Tree ID</th>
                                <th class="text-center">Tree Variety</th>
                                <th class="text-center">Expected Yield - Pods</th>
                                <th class="text-center">Expected Yield - Beans</th>
                                <th class="text-center">Estimated Weight - Beans</th>
                                <th class="text-center">Expected Harvest Date</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <br>
                </div>
              </div>
              <!-- / Forecast Table -->

              <!-- Tree Management -->
                <div id="management_panel" class="col-12 w-100 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3"><b>Daily Harvest Manager</b></h5>
                      </div>
                      <hr>
                    </div>
                    <div class="container-fluid">
                      <table class="table table-stripe text-center display responsive" id = "tree_management" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Harvester</th>
                                <th class="text-center">Assigned Tree ID</th>
                                <th class="text-center">Last Fertilized Date</th>
                                <!-- <th class="text-center">Estimated Harvest Date</th> -->
                                <th class="text-center">Expected Yield</th>
                                <th class="text-center">Tree Variety</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                    <hr>
                  </div>
                </div>
              <!-- / Tree Management -->
              <div class="container-fluid w-100 d-flex d-inline-block align-items-center justify-content-end">
                <button type="button" id="generate_report_btn" class="btn btn-primary">Generate Report</button>
              </div>

              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  <p>&copy;<b>2023 RaizerRTX </b> | Joshua Prensica</p>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/libs/jquery/jquery.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/libs/popper/popper.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/js/bootstrap.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/js/menu.js')?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/vendor/libs/apex-charts/apexcharts.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/libs/calendar/dist/calendar-gc.min.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/libs/row-merger/dist/row-merge-bundle.min.js')?>"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main JS -->
    <script src="<?=base_url('app/Views/dashboard/assets/js/main.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/js/global.js')?>"></script>
    <script src="<?=base_url('app/Views/dashboard/assets/js/data-config.js')?>"></script>

     <!-- Page JS -->
     <script src="<?=base_url('app/Views/dashboard/assets/js/dashboards-analytics.js')?>"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Inline JS --> 
    <script>
        $(document).ready(function(e) {
            var beansPercentage = <?=$beans_percentage?>;
            var podsPercentage = <?=$pods_percentage?>;
            var beansWeight = <?=$beans_w?>;
            var beansWeightPercentage = <?=$beans_w_percentage?>;
            var podsWeight = <?=$pods_w?>;
            var podsWeightPercentage = <?=$pods_w_percentage?>;

            if (beansPercentage > 0) {
                $("#beans_prcnt").removeClass("text-warning");
                $("#beans_prcnt").addClass("text-success");
                $("#beans_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + beansPercentage + `%`);
            } else if (beansPercentage < 0) {
                $("#beans_prcnt").removeClass("text-warning");
                $("#beans_prcnt").addClass("text-danger");
                $("#beans_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + beansPercentage + `%`);
            } else {
                $("#beans_prcnt").html(`--%`);
            }

            if (podsPercentage > 0) {
                $("#pods_prcnt").removeClass("text-warning");
                $("#pods_prcnt").addClass("text-success");
                $("#pods_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + podsPercentage + `%`);
            } else if (podsPercentage < 0) {
                $("#pods_prcnt").removeClass("text-warning");
                $("#pods_prcnt").addClass("text-danger");
                $("#pods_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + podsPercentage + `%`);
            } else {
                $("#pods_prcnt").html(`--%`);
            }

            if (beansWeightPercentage > 0) {
                $("#beans_w_prcnt").removeClass("text-warning");
                $("#beans_w_prcnt").addClass("text-success");
                $("#beans_w_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + beansWeightPercentage + `%`);
            } else if (beansWeightPercentage < 0) {
                $("#beans_w_prcnt").removeClass("text-warning");
                $("#beans_w_prcnt").addClass("text-danger");
                $("#beans_w_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + beansWeightPercentage + `%`);
            } else {
                $("#beans_w_prcnt").html(`--%`);
            }

            if (podsWeightPercentage > 0) {
                $("#pods_w_prcnt").removeClass("text-warning");
                $("#pods_w_prcnt").addClass("text-success");
                $("#pods_w_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + podsWeightPercentage + `%`);
            } else if (podsWeightPercentage < 0) {
                $("#pods_w_prcnt").removeClass("text-warning");
                $("#pods_w_prcnt").addClass("text-danger");
                $("#pods_w_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + podsWeightPercentage + `%`);
            } else {
                $("#pods_w_prcnt").html(`--%`);
            }

            if (beansWeight < 1000) {
                $("#beans_weight").html(beansWeight + " g.");
            } else if (beansWeight < 1000000 && beansWeight > 1000) {
                var newWeight = beansWeight * 0.001;
                $("#beans_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " kg.");
            } else if (beansWeight > 1000000) {
                var newWeight = beansWeight * 0.0001;
                $("#beans_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " T.");
            }

            if (podsWeight < 1000) {
                $("#pods_weight").html(podsWeight + " g.");
            } else if (podsWeight < 1000000 && podsWeight > 1000) {
                var newWeight = podsWeight * 0.001;
                $("#pods_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " kg.");
            } else if (podsWeight > 1000000) {
                var newWeight = podsWeight * 0.001;
                $("#pods_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " T.");
            } 
        });
    </script>
  </body>
</html>
