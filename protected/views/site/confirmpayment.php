<?php echo $this->renderPartial('_template_begin', array(
  'activeMenu' => 'dashboard',
), true) ?>

<script>
  var update = function(){
      $("#card-source-current").hide();
      $("#card-source-savings").hide();
      var source = $("#select-source").val(); 
      if(source == 1) {
        $("#card-source-current").show();
      } else if(source == 2) {
        $("#card-source-savings").show();
      }

      $("#card-recipient-choose").hide();
      $("#card-recipient-stella").hide();
      $("#card-recipient-david").hide();
      var recipient = $("#select-recipient").val(); 
      if(recipient == 0) {
        $("#card-recipient-choose").show();
      } else if(recipient == 1) {
        $("#card-recipient-stella").show();
      } else if(recipient == 2) {
        $("#card-recipient-david").show();
      }
  }
  $(document).ready(function(){
    $( "#select-source" ).change(function() {
      update();
    });

    $( "#select-recipient" ).change(function() {
      update();
    });

    update();

    var $this = $("#nav-payment-item");
    $($this).parents('.nav-item').last().addClass('active');
    if ($($this).parents('.sub-menu').length) {
      $($this).closest('.collapse').addClass('show');
      $($this).addClass('active');
    }

    <?php if($sign && $signatureStatus == PaymentTransaction::SIGNATURE_STATUS_PUSH_SENT): ?>

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
    <?php endif;?>

    <?php if($signatureStatus == PaymentTransaction::SIGNATURE_STATUS_SMS_SENT || $signatureStatus == PaymentTransaction::SIGNATURE_STATUS_CARDREADER_SENT || $signatureStatus == PaymentTransaction::SIGNATURE_STATUS_TOTP_SENT):?>
      $(document).bind('keypress', function(e){
        if(e.keyCode == 13) { e.preventDefault(); $('#specialsubmit').trigger('click'); }
      });
    <?php endif;?>


  });
</script>

<div class="content-wrapper">
<div style="margin-top: 20px; margin-bottom: 20px;" class='h2'>Confirm Details</div>
<form class="forms-sample" id="outgoingtransfer" method="post" action="<?=Yii::app()->createUrl('site/confirmpayment')?>">
<div class="row">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin <?=$sign ? "opthiddenonmobile" : ""?>">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Source</h4>

            <div class="form-group">
              <select class="form-control form-control-lg d-none" name="source" id="select-source">
                <option value="1" <?=($source == 1) ? "selected" : ""?>>My Current Account (08233593) £ 4,109.30</option>
                <option value="2" <?=($source == 2) ? "selected" : ""?>>My Savings (08233594) £ 10,109.30</option>
              </select>

            </div>

            <div class="card bg-gradient-warning text-white" id="card-source-current" style="display: none;">
              <div class="card-body">
                <h5 class="font-weight-normal mb-3">070436 08233593</h5>
                <h3 class="font-weight-normal mb-4">My Current Account</h3>
                <p class="card-text">Balance: £ 4,109.30</p>
              </div>
            </div>

            <div class="card bg-gradient-warning text-white" id="card-source-savings" style="display: none;">
              <div class="card-body">
                <h5 class="font-weight-normal mb-3">070436 08233594</h5>
                <h3 class="font-weight-normal mb-4">My Savings</h3>
                <p class="card-text">Balance: £ 10,109.30</p>
              </div>
            </div>

        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin <?=$sign ? "opthiddenonmobile" : ""?>">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Recipient</h4>
            <div class="form-group">
              <select class="form-control form-control-lg d-none" name="recipient" id="select-recipient">
                <option value="0" <?=($recipient == 0) ? "selected" : ""?>>...</option>
                <option value="1" <?=($recipient == 1) ? "selected" : ""?>>Stella Johnson</option>
                <option value="2" <?=($recipient == 2) ? "selected" : ""?>>David Grey</option>
              </select>
            </div>

            <div style="background: linear-gradient(to right, rgba(200, 230, 210, 0.9), rgba(245, 209, 100, 0.9)); display: none;" class="card" id="card-recipient-choose">
              <div class="card-body" style="padding-right: 1.3rem;">
                <table>
                  <tr>
                    <td width="100%">
                      <h5 class="font-weight-normal mb-3">&nbsp;</h5>
                    </td>
                    <td width="40" align="right" valign="top">

                    </td>
                  </tr>
                </table>
                <h3 class="font-weight-normal mb-4">&nbsp;</h3>
                <p class="card-text">&nbsp;</p>
              </div>
            </div>

            <div class="card bg-gradient-success text-white" id="card-recipient-stella" style="display: none;">
              <div class="card-body" style="padding-right: 1.3rem;">
                <table>
                  <tr>
                    <td width="100%">
                      <h5 class="font-weight-normal mb-3">070436 71809176</h5>
                    </td>
                    <td width="40" align="right" valign="top">
                      <img style="margin-top: -8px; border-radius: 100%; width: 40px;" src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face2.jpg" alt="image">
                    </td>
                  </tr>
                </table>
                <h3 class="font-weight-normal mb-4">Stella Johnson</h3>
                <p class="card-text">Last action: £65.50 on <?=date("M d, Y", strtotime("today - 8 days"))?></p>
              </div>
            </div>

            <div class="card bg-gradient-success text-white" id="card-recipient-david" style="display: none;">
              <div class="card-body" style="padding-right: 1.3rem;">
                <table>
                  <tr>
                    <td width="100%">
                      <h5 class="font-weight-normal mb-3">070110 74560192</h5>
                    </td>
                    <td width="40" align="right" valign="top">
                      <img style="margin-top: -8px; border-radius: 100%; width: 40px;" src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face3.jpg" alt="image">
                    </td>
                  </tr>
                </table>
                <h3 class="font-weight-normal mb-4">David Grey</h3>
                <p class="card-text">Last action: £120.00 on <?=date("M d, Y", strtotime("today - 15 days"))?></p>
              </div>
            </div>

        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin <?=$sign ? "opthiddenonmobile" : ""?>">
      <div class="card">
        <div class="card-body">
            <div class="card bg-gradient-info text-white">
              <div class="card-body" style="padding-top: 1.60rem; padding-bottom: 0.75rem;">
                <div class="form-group" style="padding-top: 0;">
                  <label>Amount to transfer</label>
                  <div class="input-group">
                  <span style="width: 35px;" class="input-group-addon bg-primary text-white">£</span>
                  <input type="text" class="form-control" aria-label="Amount" placeholder="10.00" name="amount" <?=!empty($amount) ? 'value="' . htmlspecialchars(number_format($amount,2)) . '"' : "" ?> readonly>
                  </div>
                </div>
                <div class="form-group" style="padding-top: 0.25rem; padding-bottom: 0.35rem;">
                  <label>Date</label>
                  <div class="input-group">
                    <span style="width: 35px; padding-left: 0.60rem;" class="input-group-addon bg-info bg-info" id="colored-addon1">
                      <i class="mdi mdi-calendar text-white"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="01/02/2018" aria-label="Date" aria-describedby="colored-addon1" value="Immediately" name="date" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label>Remarks</label>
                  <div class="input-group">
                    <span style="width: 35px; padding-left: 0.60rem;" class="input-group-addon bg-info bg-info" id="colored-addon1">
                      <i class="mdi mdi-comment text-white"></i>
                    </span>
                    <input type="text" class="form-control" aria-label="Remarks" placeholder="Remark" name="remarks" value="<?=htmlspecialchars($remarks)?>" readonly>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

    <div class="col-12 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <button id="backbutton" style="float: left; margin-bottom: 20px;" type="submit" class="btn btn-lg btn-secondary" formaction="<?=Yii::app()->createUrl('site/payment')?>">Back</button>
          <div class="float-right" style="text-align: right;">
            <?php if($sign): ?>
              <?php if($signatureStatus == PaymentTransaction::SIGNATURE_STATUS_PUSH_SENT): ?>
                <table>
                  <tr>
                    <td align="right">
                      <h5 class="mb-0">We've sent a notification to your iPhone.</h5>
                    </td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Review details then select Allow to start the transfer.
                    </td>
                    <td>
                      <img style="width: 40px;" src="<?=Yii::app()->request->baseUrl . '/css/';?>spinner.gif">
                    </td>
                  </tr>
                </table>
              <?php elseif($signatureStatus == PaymentTransaction::SIGNATURE_STATUS_SMS_SENT || $signatureStatus == PaymentTransaction::SIGNATURE_STATUS_TOTP_SENT): ?>

                <table class="float-right">
                  <tr>
                    <td>
                      <?php if($signatureStatus == PaymentTransaction::SIGNATURE_STATUS_SMS_SENT): ?>
                        <h5 class="mb-0" style="margin-right: 20px;">Type the SMS one-time key we've sent to start the transfer.</h5>
                      <?php else:?>
                      <h5 class="mb-0" style="margin-right: 20px;">Type the current one-time key to start the transfer.</h5>
                      <?php endif;?>
                    </td>
                    <td>
                      <div class="input-group">
                        <span style="width: 35px; padding-left: 0.60rem;" class="input-group-addon bg-info bg-info" id="colored-addon1">
                          <i class="mdi mdi-key text-white"></i>
                        </span>
                        <input type="text" class="form-control" aria-label="One-time key" placeholder="123456" name="smskey">
                      </div>
                    </td>
                    <td>
                      <input type="hidden" name="paymenttransaction_id" value="<?=$paymenttransaction_id?>"/>
                      <?php if($signatureStatus == PaymentTransaction::SIGNATURE_STATUS_SMS_SENT): ?>
                      <button type="submit" class="btn btn-success" name="signwithsms" value="1" id="specialsubmit"><i class="mdi mdi-lock text-white"></i>Sign</button>
                      <?php else:?>
                      <button type="submit" class="btn btn-success" name="signwithtotp" value="1" id="specialsubmit"><i class="mdi mdi-lock text-white"></i>Sign</button>
                      <?php endif;?>
                    </td>
                  </tr>
                </table>

              <?php elseif($signatureStatus == PaymentTransaction::SIGNATURE_STATUS_CARDREADER_SENT): ?>
                <input type="hidden" name="paymenttransaction_id" value="<?=$paymenttransaction_id?>"/>

                <table class="float-right">
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-2">1. Enter the last 4 digits of your long Purple Debit Card number</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td width="150" align="right">
                      <div class="input-group mb-3 mt-0" style="margin-top: -1rem; width: 100px;">
                        <span style="width: 35px; padding-left: 0.60rem;" class="input-group-addon bg-info bg-info" id="colored-addon1">
                          <i class="mdi mdi-credit-card text-white"></i>
                        </span>
                        <input type="text" class="form-control" aria-label="Cardnumber" placeholder="0000" name="cardnumber">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-3">2. Insert your Purple Debit Card into the card reader.</h5>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-3">3. Press the <mark class="bg-info text-white">Sign</mark> button when asked to 'Select Function'.</h5>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-3">4. Enter your Purple Debit Card PIN number and press <mark class="bg-success text-white">OK</mark>.</h5>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-3">4. Enter <span style="font-family:'Lucida Console', monospace"><?=isset($cardreader_nonce) ? $cardreader_nonce : "" ?></span> for reference number and press <mark class="bg-success text-white">OK</mark>.</h5>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-3">4. Enter <span style="font-family:'Lucida Console', monospace"><?=!empty($amount) ? htmlspecialchars(number_format($amount,2)): "" ?></span> for amount and press <mark class="bg-success text-white">OK</mark>.</h5>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <h5 class="mb-2">5. Enter the passcode that is now displayed on your card reader.</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td width="150" align="right">
                      <div class="input-group mb-4 mt-0" style="margin-top: -1rem; width: 150px;">
                        <span style="width: 35px; padding-left: 0.60rem;" class="input-group-addon bg-info bg-info" id="colored-addon1">
                          <i class="mdi mdi-credit-card text-white"></i>
                        </span>
                        <input type="text" class="form-control" aria-label="Authkey" placeholder="1234 5678" name="authkey">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right">
                      <button type="submit" class="btn btn-success" name="signwithcard" value="1" id="specialsubmit"><i class="mdi mdi-lock text-white"></i>Sign</button>
                    </td>
                  </tr>
                </table>
              <?php endif;?>
            <?php else: ?>
              <h5 style="margin-top: 13px; margin-right: 15px; display: inline;">Please sure that everything is correct before proceeding.</h5>
              <button type="submit" class="btn btn-lg btn-success" name="sign" value="1"><i class="mdi mdi-lock text-white"></i>Sign</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>