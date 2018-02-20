<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Bank - Home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/jquery-bar-rating/dist/themes/css-stars.css">
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=Yii::app()->request->baseUrl . '/template/';?>images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?=Yii::app()->createUrl('site/dashboard')?>"><img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="<?=Yii::app()->createUrl('site/dashboard')?>"><img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="search-field ml-4 d-none d-md-block">
          <form class="d-flex align-items-stretch h-100" action="#">
            <div class="input-group">
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search">
              <div class="input-group-btn">
                <button type="button" class="btn bg-transparent dropdown-toggle px-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-earth"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">Today</a>
                  <a class="dropdown-item" href="#">This week</a>
                  <a class="dropdown-item" href="#">This month</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Month and older</a>
                </div>
              </div>
              <div class="input-group-addon bg-transparent border-0 search-button">
                <button type="submit" class="btn btn-sm bg-transparent px-0">
                  <i class="mdi mdi-magnify"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-email-outline"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <h6 class="p-3 mb-0">Messages</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                  <p class="text-gray mb-0">
                    1 Minutes ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                  <p class="text-gray mb-0">
                    15 Minutes ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                  <p class="text-gray mb-0">
                    18 Minutes ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">4 new messages</h6>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">Notifications</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                  <p class="text-gray ellipsis mb-0">
                    Just a reminder that you have an event today
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-settings"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                  <p class="text-gray ellipsis mb-0">
                    Update dashboard
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-link-variant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                  <p class="text-gray ellipsis mb-0">
                    New admin wow!
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face1.jpg" alt="image">
              <span class="d-none d-lg-inline">Daniel Russiel</span>
            </a>
            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?=$logoutUrl?>">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Signout
              </a>
            </div>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="<?=$logoutUrl?>">
              <i class="mdi mdi-power"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="<?=Yii::app()->createUrl('site/dashboard')?>">
                <span class="menu-title">Dashboard</span>
                <span class="menu-sub-title">( 2 new )</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Accounts</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Payments</span>
                <i class="mdi mdi-transfer menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Payment History</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Make Single Payment</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Recurring Payments</a></li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Loans</span>
                <i class="mdi mdi-bank menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="menu-title">Settings</span>
                <i class="mdi mdi-settings menu-icon"></i>
              </a>
            </li>
          </ul>

        </nav>
        <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-warning text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">My Current Account</h4>
                  <h1 class="font-weight-normal mb-4">£ 4,109.30</h2>
                  <p class="card-text">Purple Power - 070436 08233593</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">My Credit Card</h4>
                  <h2 class="font-weight-normal mb-4">-£ 401.30</h2>
                  <p class="card-text">Pay until <?=date("M d, Y", strtotime("today + 3 days"))?> </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">My Savings</h4>
                  <h2 class="font-weight-normal mb-4">£ 10,109.30</h2>
                  <p class="card-text">Purple Saver 2018</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Transactions</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                          </th>
                          <th>
                          </th>
                          <th>
                            Payee
                          </th>
                          <th style="text-align: right;">
                            Amount
                          </th>
                          <th>
                            
                          </th>
                          <th>
                            Category
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Transaction Type
                          </th>
                          <th style="width: 30px;">
                            Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/jamies.png" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Jamie's Italian
                          </td>
                          <td style="text-align: right;">
                            £ 44.00
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-hamburger menu-icon"></i>
                          </td>
                          <td>
                            Dining Out
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("today"))?>
                          </td>
                          <td>
                            Apple Pay
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/tesco.gif" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Tesco
                          </td>
                          <td style="text-align: right;">
                            £ 18.51
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-shopping menu-icon"></i>
                          </td>
                          <td>
                            Groceries
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("today"))?>
                          </td>
                          <td>
                            Debit Card
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/mcdonalds.png" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            McDonald's
                          </td>
                          <td style="text-align: right;">
                            £ 5.00
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-hamburger menu-icon"></i>
                          </td>
                          <td>
                            Dining Out
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("today"))?>
                          </td>
                          <td>
                            Debit Card
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-left text-success icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face2.jpg" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Stella Johnson
                          </td>
                          <td style="text-align: right;">
                            £ 100.00
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">

                          </td>
                          <td>
                            
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("yesterday"))?>
                          </td>
                          <td>
                            Transfer
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/vodafone.png" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Vodafone
                          </td>
                          <td style="text-align: right;">
                            £ 84.39
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-phone menu-icon"></i>
                          </td>
                          <td>
                            Communication
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("yesterday"))?>
                          </td>
                          <td>
                            Direct Debit
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/tesco.gif" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Tesco
                          </td>
                          <td style="text-align: right;">
                            £ 10.39
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-shopping menu-icon"></i>
                          </td>
                          <td>
                            Groceries
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("yesterday"))?>
                          </td>
                          <td>
                            Apple Pay
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td colspan=9 style="margin-right: 20px; text-align: right;"><a href="#">View all transactions</a></td></tr>
                        <!--- 
                        <tr>
                          <td>
                            5670
                          </td>
                          <td>
                            High loading time
                          </td>
                          <td class="py-1">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face2.jpg" class="mr-2" alt="image">
                            Stella Johnson
                          </td>
                          <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>
                          </td>
                          <td>
                            Dec 12, 2017
                          </td>
                          <td>
                            WD-12346
                          </td>
                          <td>
                            <i class="mdi mdi-arrow-up text-danger icon-sm mr-1"></i>High
                          </td>
                        </tr>
                        <tr>
                          <td>
                            5671
                          </td>
                          <td>
                            Website down for one week
                          </td>
                          <td class="py-1">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face3.jpg" class="mr-2" alt="image">
                            Marina Michel
                          </td>
                          <td>
                            <label class="badge badge-gradient-secondary">ON HOLD</label>
                          </td>
                          <td>
                            Dec 16, 2017
                          </td>
                          <td>
                            WD-12347
                          </td>
                          <td>
                            <i class="mdi mdi-arrow-up text-success icon-sm mr-1"></i>Low
                          </td>
                        </tr>
                        <tr>
                          <td>
                            5672
                          </td>
                          <td>
                            Loosing control on server
                          </td>
                          <td class="py-1">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face4.jpg" class="mr-2" alt="image">
                            John Doe
                          </td>
                          <td>
                            <label class="badge badge-gradient-success">DONE</label>
                          </td>
                          <td>
                            Dec 3, 2017
                          </td>
                          <td>
                            WD-12348
                          </td>
                          <td>
                            <i class="mdi mdi-arrow-up text-warning icon-sm mr-1"></i>Medium
                          </td>
                        </tr>
                      -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Spendings and Savings</h4>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">Spending Categories</h4>
                  <canvas id="pieChart" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Updates</h4>
                  <div class="d-flex">
                    <div class="d-flex align-items-center mr-4 text-muted">
                      <i class="mdi mdi-account icon-sm mr-2"></i>
                      <span>jack Menqu</span>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                      <i class="mdi mdi-calendar-blank icon-sm mr-2"></i>
                      <span>October 3rd, 2018</span>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-6 pr-1">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_1.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_4.jpg" class="mw-100 w-100 rounded" alt="image">
                    </div>
                    <div class="col-6 pl-1">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_2.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_3.jpg" class="mw-100 w-100 rounded" alt="image">
                    </div>
                  </div>
                  <div class="d-flex mt-5 align-items-top">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face3.jpg" class="img-sm rounded-circle mr-3" alt="image">
                    <div class="mb-0 flex-grow">
                      <p class="font-weight-bold mr-2 mb-0">Jack Manque</p>
                      <p>This is amazing! We have moved to a brand new branch office in
                        Glasgow with a lot more space.
                        We will miss our old office but we are very excited about our new space.</p>
                    </div>
                    <div class="ml-auto">
                      <i class="mdi mdi-heart-outline text-muted"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Template from <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">University of Glasgow - School of Computing Science - Akos Szente <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/chart.js/dist/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>js/off-canvas.js"></script>
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
