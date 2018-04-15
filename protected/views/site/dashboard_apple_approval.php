<?php echo $this->renderPartial('_template_begin_apple_approval', array(
  'activeMenu' => 'dashboard',
), true) ?>

        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex mt-5 align-items-top">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face16.jpg" class="img-sm rounded-circle mr-3" alt="image">
                    <div class="mb-0 flex-grow">
                      <p class="font-weight-bold mr-2 mb-0">Welcome to Authreq Sample Service Provider</p>
                      <p>You've successfully logged in. To link a device to this account, select your user name in the upper-right corner and choose Protect Account With Authreq.</p>
                    </div>
                    <div class="ml-auto">
                      <i class="mdi mdi-heart-outline text-muted"></i>
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