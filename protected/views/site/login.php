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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <div class="card-body px-5 py-5">
              <div class="row">
                <div class="col-12">
                <img height="28" style="margin-top: 4px; margin-left: 5px; float: right;" src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logo.svg"/> 
                <h3 class="card-title text-left mb-3">Online Banking</h3>
                <img src=""/>
              </div>
              </div>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableAjaxValidation'=>true,
				)); ?>

              <form>
                <div class="form-group">
        				<?php echo $form->labelEx($model,'username'); ?>
        				<?php echo $form->textField($model,'username', array('class' => 'form-control p_input' . ($isPushPending ? " pushpendingdisabled" : ""))); ?>
        				<?php echo $form->error($model,'username'); ?>
                </div>
                <div class="form-group">
        				<?php echo $form->labelEx($model,'password'); ?>
        				<?php echo $form->passwordField($model,'password', array('class' => 'form-control p_input' . ($isPushPending ? " pushpendingdisabled" : ""))); ?>
        				<?php echo $form->error($model,'password'); ?>
				        </div>
                <?php if($isPushPending): ?>
                <div class="form-group">
                  <table width="100%"><tr><td>
                    <h4>We've sent a notification to your iPhone.</h4>
                    Please select Allow or open AuthReq to continue.<br><br>
                    <img style="width: 40px; margin: -9px;" src="<?=Yii::app()->request->baseUrl . '/css/';?>spinner.gif"><br><br>
                    <?php echo CHtml::button('Resend', array('id' => 'resendauthreq', 'class' => 'btn')); ?>
                    <?php echo CHtml::button('Cancel', array('id' => 'cancelauthreq', 'class' => 'btn')); ?>
                  </td><td align="right" style="padding: 20px 0 20px 20px;">
                    <video autoplay="autoplay" loop="loop">
                      <source src="<?=Yii::app()->request->baseUrl . '/css/';?>loop.mp4" type="video/mp4" />
                    </video>
                  </td></tr></table>
                </div>
                <?php else:?>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember my username
                      </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary btn-block enter-btn')); ?>
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
  <?php if($isPushPending): ?>
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
    $(function() {
      doPoll();
    });

    $("#resendauthreq").click(function() {
      $.post("<?=$resendUrl?>", function( data ) {
        $("#login-form").submit();
      });
    });

    $("#cancelauthreq").click(function() {
      window.location.href="<?=$logoutUrl?>";
    });
  </script>
  <?php endif;?>
</body>

</html>

</div><!-- form -->
