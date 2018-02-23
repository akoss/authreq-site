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
          <h4 class="mb-4">Scan this image with your iPhone's camera to enrol.</h4>
          <img src="<?=$qrurl?>"/>
          <h4 class="mt-4"></h4>
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