<?php echo $this->renderPartial('_template_begin_apple_approval', array(
  'activeMenu' => 'dashboard',
), true) ?>

<?php
$user_id = isset(Yii::app()->user) ? Yii::app()->user->id : null; 
if(isset($user_id)) {
  $user = User::model()->findByPk($user_id);
}
if(isset($user)) {
  $authmethod = $user->getAuthMethod(); 
} else {
  $authmethod = null;
}
?>

        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex mt-5 align-items-top">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face16.jpg" class="img-sm rounded-circle mr-3" alt="image">
                    <div class="mb-0 flex-grow">
                      <p class="font-weight-bold mr-2 mb-0">Welcome to the Sample Service for Authreq</p>
                      <p>You've successfully logged in. 

                      <?php if($authmethod != User::AUTH_METHOD_AUTHREQ):?>
                      To start using Authreq, install Authreq and link it to your account.
                      <?php else: ?>
                      Your account is protected by Authreq. 
                      <?php endif; ?>
                      </p>

                      <a class="btn btn-lg btn-primary" href="<?=Yii::app()->createUrl('site/enrol')?>">
                        <?php if($authmethod != User::AUTH_METHOD_AUTHREQ):?>
                        Link account with Authreq
                      <?php else: ?>
                        Move to another device
                      <?php endif; ?>
                      </a>
                      <br><br>

                    </div>
                    <div class="ml-auto">
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-6 pr-1">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_4.jpg" class="mw-100 w-100 rounded" alt="image">
                    </div>
                    <div class="col-6 pl-1">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_3.jpg" class="mw-100 w-100 rounded" alt="image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php echo $this->renderPartial('_template_end_apple_approval', array(
  'activeMenu' => 'dashboard',
), true) ?>