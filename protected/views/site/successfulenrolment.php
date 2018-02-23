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
        <h3 class="mb-5" style="color: #27ad60;"><i class="mdi mdi-check-circle" style="color: #27ad60;"></i> You have successfully linked your iPhone to your Purple Account.</h3> 
          <span class="float-right">
              <a href="<?=Yii::app()->createUrl('site/dashboard')?>" class="btn btn-lg btn-success" name="sign" value="1"><i class="mdi mdi-home text-white"></i>Back to Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>