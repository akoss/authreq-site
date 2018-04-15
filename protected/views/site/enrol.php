<?php echo $this->renderPartial('_template_begin', array(
  'activeMenu' => 'dashboard',
), true) ?>

<script>
    function doPoll(){
      $.getJSON('<?=$pollUrl?>', function(data) {
        console.log(data);
        if(data['success']) {
            window.location.href="<?=$successUrl?>";
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
</script>

<div class="content-wrapper">
<div style="margin-top: 20px; margin-bottom: 20px;" class='h2'>Enrol Device</div>
<form class="forms-sample" id="outgoingtransfer" method="post" action="<?=Yii::app()->createUrl('site/confirmpayment')?>">
<div class="row">
    <div class="col-12 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <p>Authreq makes your account more secure by sending you a notification whenever you try to log in. You'll need to approve all login attempts on your iPhone.</p>

          <p>To start using Authreq, get it from the App Store.</p>
          <a href="#"><img style="margin-left: 10px;" width="150" src="<?=Yii::app()->request->baseUrl . '/css/';?>appstore.png" alt="Authreq on the App Store"/></a>
          <br><br>

          <h4 class="mb-4">Then, visit this page using your iPhone and tap here: </h4>
          <a href="<?=$enrolmentUrl?>"><img style="margin-left: 10px;" width="150" src="<?=Yii::app()->request->baseUrl . '/css/';?>enrol.png" alt="Enrol on iPhone"/></a>
          <br><br><br>

          <h4 class="mb-4">Or simply scan this image with your iPhone's camera:</h4>
          <img src="<?=$qrurl?>" style="max-width: 100%;"/>
          <h4 class="mt-4"></h4>

          <p>Authreq will automatically open. Choose <i>'Enrol to Purple Bank'</i> and tap on <i>'Allow'</i> to link your account to your iPhone.</p>
        </div>
      </div>
    </div>
    

    <div class="col-12 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <button id="backbutton" style="float: left;" type="submit" class="btn btn-lg btn-secondary" formaction="<?=Yii::app()->createUrl('site/payment')?>">Back</button>
          <span class="float-right">
              Waiting for iPhone...
              <img style="width: 40px;" src="<?=Yii::app()->request->baseUrl . '/css/';?>spinner.gif">
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>