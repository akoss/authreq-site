<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <title>Purple Bank</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>node_modules/font-awesome/css/font-awesome.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=Yii::app()->request->baseUrl . '/template/';?>css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=Yii::app()->request->baseUrl . '/template/';?>images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-7 mx-auto">
            <div class="card-body px-1 py-4">
              <div class="row">
                <div class="col-12">
                <img height="28" style="margin-top: 4px; margin-left: 5px; float: right; margin-bottom: 20px;" src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logo.svg"/> 
                <h3 class="card-title text-left mb-3">Online Banking</h3>
                <img src=""/>
              </div>
              </div>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableAjaxValidation'=>false,
				)); ?>

              <form>
                <div class="form-group <?=($isCardreaderPending || $isCardreaderInvalid || $isSmsPending || $isPushPending) ? 'opthiddenonmobile' : ''?>">
        				<?php echo $form->labelEx($model,'username'); ?>
        				<?php echo $form->textField($model,'username', array('readonly'=>($isCardreaderPending || $isCardreaderInvalid || $isSmsPending || $isPushPending), 'class' => 'form-control p_input' . ($isCardreaderPending || $isCardreaderInvalid || $isSmsPending || $isPushPending ? " pushpendingdisabled" : ""))); ?>
        				<?php echo $form->error($model,'username'); ?>
                </div>
                <div class="form-group <?=($isCardreaderPending || $isCardreaderInvalid || $isSmsPending || $isPushPending) ? 'opthiddenonmobile' : ''?>">
        				<?php echo $form->labelEx($model,'password'); ?>
        				<?php echo $form->passwordField($model,'password', array('readonly'=>($isCardreaderPending || $isCardreaderInvalid || $isSmsPending || $isPushPending), 'class' => 'form-control p_input' . ($isCardreaderPending || $isCardreaderInvalid || $isSmsPending || $isPushPending ? " pushpendingdisabled" : ""))); ?>
        				<?php echo $form->error($model,'password'); ?>
				        </div>

                <?php
                // Fields for push-based TOTP
                ?>

                <?php if($isPushPending): ?>
                <div class="form-group">
                  <div class="container">
                    <div class="row">
                      <div class="col-8 col-md-9 logininstructions" style="padding-left: 0;"> 
                        <h4>We've sent a notification to your iPhone.</h4>
                        Please select Allow or open AuthReq to continue.<br><br>
                        <img style="width: 40px; margin: -9px;" src="<?=Yii::app()->request->baseUrl . '/css/';?>spinner.gif"><br><br>
                        <?php echo CHtml::button('Resend', array('id' => 'resendauthreq', 'class' => 'btn')); ?> &nbsp;&nbsp;&nbsp;
                        <?php echo CHtml::button('Cancel', array('id' => 'cancelauthreq', 'class' => 'btn')); ?>
                      </div>
                      <div class="col-4 col-md-3 pull-right" style="padding: 0 0 0 0;">
                        <video style="width: 100%; float: right;" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline">
                          <source src="<?=Yii::app()->request->baseUrl . '/css/';?>loop.mp4" type="video/mp4" />
                        </video>
                      </div>
                    </div>
                  </div>
                </div>
                <?php else:?>
                <?php if($isSmsPending): ?>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <strong>We have sent you a one-time key via SMS.</strong> <?php echo CHtml::button('Resend', array('id' => 'resendauthreq', 'class' => 'btn')); ?>
                </div>
                <?php else: ?>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                      </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <?php endif; ?>

                <?php
                // Fields for SMS-based TOTP
                ?>
                <?php if($isSmsPending):?>
                <div class="form-group">
                <?php echo $form->textField($model,'totp', array('class' => 'form-control p_input', 'placeholder' => '123456')); ?>
                </div>
                <?php endif;?>

                <?php if($isSmsInvalid):?>
                <div class="form-group">
                Incorrect one-time key
                </div>
                <?php endif;?>

                <?php
                // Fields for card reader based TOTP
                ?>
                <?php if($isCardreaderPending):?>
                <strong>1. Enter the last 4 digits of your long Purple Debit Card number<br></strong>
                <div class="form-group">
                <?php echo $form->textField($model,'cardno', array('class' => 'form-control p_input', 'placeholder' => '0000')); ?>
                </div>
                <strong>2. Insert your Purple Debit Card into the card reader.<br>
                3. Press the <mark class="bg-info text-white">Identify</mark> button when asked to 'Select Function'.<br>
                4. Enter your Purple Debit Card PIN number and press the <mark class="bg-success text-white">OK</mark> button.<br>
                5. Enter the passcode that is now displayed on your card reader.<br>
                </strong>
                <div class="form-group">
                <?php echo $form->textField($model,'totp', array('class' => 'form-control p_input', 'placeholder' => '1234 5678')); ?>
                </div>
                <?php endif;?>

                <?php if($isCardreaderInvalid):?>
                <div class="form-group">
                Incorrect card number or one-time key
                </div>
                <?php endif;?>


                <div class="text-center">
                  <?php echo CHtml::submitButton('Log In', array('class' => 'btn btn-primary btn-block enter-btn')); ?>
                </div>
                <?php endif;?>
              </form>
				<?php $this->endWidget(); ?>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
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
  <!-- inject:js -->
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>js/off-canvas.js"></script>
  <script src="<?=Yii::app()->request->baseUrl . '/template/';?>js/misc.js"></script>
  <!-- endinject -->
    <script>
    function doPoll(){
      $.getJSON('<?=$pollUrl?>', function(data) {
        console.log(data);
        if(data['success']) {
          $("#login-form").submit();
        }
      })
        .always(function() {
          setTimeout( function(){ 
            doPoll();
          }  , 2000 );
        });
    }

    $("#resendauthreq").click(function() {
      $.post("<?=$resendUrl?>", function( data ) {
        $("#login-form").submit();
      });
    });

    $("#cancelauthreq").click(function() {
      window.location.href="<?=$logoutUrl?>";
    });

    <?php if($isPushPending): ?>
    $(function() {
      doPoll();
    });
    <?php endif;?>
  </script>
</body>

</html>

</div><!-- form -->
