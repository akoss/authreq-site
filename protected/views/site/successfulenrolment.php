<?php echo $this->renderPartial('_template_begin', array(
  'activeMenu' => 'dashboard',
), true) ?>

<div class="content-wrapper">
<div style="margin-top: 20px; margin-bottom: 20px;" class='h2'>Enrolment Successful</div>
<form class="forms-sample" id="outgoingtransfer" method="post" action="<?=Yii::app()->createUrl('site/confirmpayment')?>">
<div class="row">


    <div class="col-12 grid-margin">
    </div>

    <div class="col-12 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-md-9 logininstructions" style="padding-top: 10px; padding-left: 0;"> 

                <h3 class="mb-5" style="color: #27ad60;"><i class="mdi mdi-check-circle" style="color: #27ad60;"></i> You have successfully linked your iPhone to your account.</h3> 
                <p>Your account is now protected by Authreq.</p>
                <p>You will receive a notification whenever someone tries to log in to your account, and you will have to approve each attempt - just like on this short clip.</p>
                <br>
                <h4>Log out and log in again to see Authreq in action.</h4>
                  <span class="float-right mt-4">
                      <a href="<?=Yii::app()->createUrl('site/logout')?>" class="mr-4 btn btn-lg btn-secondary" name="sign" value="1"><i class="mdi mdi-power text-black"></i>Log out now</a>
                      <a href="<?=Yii::app()->createUrl('site/dashboard')?>" class="btn btn-lg btn-success" name="sign" value="1"><i class="mdi mdi-home text-white"></i>Back to Dashboard</a>
                  </span>

              </div>
              <div class="col-md-3 pull-right" style="padding: 40px 20px 20px 20px;">
                <video style="width: 100%; float: right;" autoplay="autoplay" loop="loop" muted="muted" playsinline="playsinline">
                  <source src="<?=Yii::app()->request->baseUrl . '/css/';?>loop.mp4" type="video/mp4" />
                </video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>