<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Bank</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/icheck/skins/all.css" />
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/select2/dist/css/select2.min.css" />
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css" />
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/jquery-bar-rating/dist/themes/css-stars.css">
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=Yii::app()->request->baseUrl . '/template/';?>images/favicon.png" />
</head>

<body>
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
              </div>
              <div class="input-group-addon bg-transparent border-0 search-button">
                <button type="submit" class="btn btn-sm bg-transparent px-0" disabled>
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
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logo-mini.svg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject ellipsis mb-1 font-weight-normal">0% APR on EE phones</h6>
                  <p class="text-gray mb-0">
                    2 days ago
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See older messages</h6>
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
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-assistant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Monthly report is ready</h6>
                  <p class="text-gray ellipsis mb-0">
                    Settings
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
                  <h6 class="preview-subject font-weight-normal mb-1">New Direct Debit added</h6>
                  <p class="text-gray ellipsis mb-0">
                    Recurring Payments
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

              <?php
                $user_id = isset(Yii::app()->user) ? Yii::app()->user->id : null; 
                if(isset($user_id)) {
                  $user = User::model()->findByPk($user_id);
                }

                if(isset($user) && !empty($user->name)) {
                  $name = $user->name;
                } else {
                  $name = "Unknown User";
                }

                if(isset($user) && !empty($user->profilepic)) {
                  $profilepic = $user->profilepic;
                } else {
                  $profilepic = "faces-clipart/pic-1.png";
                }

                $authString = "Unknown";
                if(isset($user)) {
                  $authmethod = $user->getAuthMethod(); 
                  if($authmethod == User::AUTH_METHOD_AUTHREQ) {
                    $authString = "AuthReq Enabled <br>(" . htmlspecialchars($user->sms_phone_no) . ")";
                  }
                  else if($authmethod == User::AUTH_METHOD_SMS) {
                    $authString = "SMS-based 2FA <br>(" . htmlspecialchars($user->sms_phone_no) . ")";
                  }
                  else if($authmethod == User::AUTH_METHOD_CARDREADER) {
                    $authString = "Card Reader <br>(" . htmlspecialchars($user->cardreader_last4) . ")";
                  }
                  else if($authmethod == User::AUTH_METHOD_NONE) {
                    $authString = "2FA Disabled";
                  }
                }
              ?>

              <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/<?=htmlspecialchars($profilepic)?>" alt="image">
              <span class="d-none d-lg-inline"><?=htmlspecialchars($name)?></span>
            </a>
            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
              <a class="dropdown-item text-muted" style="pointer-events: none;" href="#">
                <?=$authString?>
              </a>
              <a class="dropdown-item" href="<?=Yii::app()->createUrl('site/enrol')?>">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                Enrol Device
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?=Yii::app()->createUrl('site/logout')?>">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Log out
              </a>
            </div>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="<?=Yii::app()->createUrl('site/logout')?>">
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
                <!-- <span class="menu-sub-title">( 2 new )</span> -->
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
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic" id="nav-payments">
                <span class="menu-title">Payments</span>
                <i class="mdi mdi-transfer menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">Payment History</a></li>
                  <li class="nav-item"> <a id="nav-payment-item" class="nav-link" href="<?=Yii::app()->createUrl('site/payment')?>">Make a Payment</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Recurring Payments</a></li>
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