<?php echo $this->renderPartial('_template_begin', array(
  'activeMenu' => 'dashboard',
), true) ?>

<script>
  $( "#select-source" ).change(function() {
    alert( "Handler for .change() called." );
  });
</script>

<div class="content-wrapper">
<div style="margin-top: 20px; margin-bottom: 20px;" class='h2'>Make a Payment</div>
<form class="forms-sample" id="outgoingtransfer" method="post" action="<?=Yii::app()->createUrl('site/confirmpayment')?>">
<div class="row">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Source</h4>

            <div class="form-group">
              <select class="form-control form-control-lg" name="source" id="select-source">
                <option value="0">My Current Account (08233593) £ 4,109.30</option>
                <option value="1">My Savings (08233594) £ 10,109.30</option>
              </select>
            </div>

            <div class="card bg-gradient-warning text-white">
              <div class="card-body">
                <h5 class="font-weight-normal mb-3">070436 08233593</h5>
                <h3 class="font-weight-normal mb-4">My Current Account</h3>
                <p class="card-text">Balance: £ 4,109.30</p>
              </div>
            </div>

            <div class="card bg-gradient-warning text-white">
              <div class="card-body">
                <h5 class="font-weight-normal mb-3">070436 08233594</h5>
                <h3 class="font-weight-normal mb-4">My Savings</h3>
                <p class="card-text">Balance: £ 10,109.30</p>
              </div>
            </div>

        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Recipient <button style="float: right; margin-top: -5px; padding-left: 10px; padding-right: 10px;" type="submit" class="btn btn-success mdi mdi-plus"></button></h4>
            <div class="form-group">
              <select class="form-control form-control-lg" name="recipient">
                <option value="-1">...</option>
                <option value="0">Stella Johnson</option>
                <option value="1">David Grey</option>
              </select>
            </div>

            <div style="background: linear-gradient(to right, rgba(200, 230, 210, 0.9), rgba(245, 209, 100, 0.9));" class="card" id="recipient_choose">
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

            <div class="card bg-gradient-success text-white" id="recipient_stella">
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

            <div class="card bg-gradient-success text-white" id="recipient_david">
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

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Details</h4>
            <div class="card bg-gradient-info text-white">
              <div class="card-body">
                <div class="form-group" style="padding-top: 0.5rem;">
                  <label>Amount to transfer</label>
                  <div class="input-group">
                  <span style="width: 35px;" class="input-group-addon bg-primary text-white">£</span>
                  <input type="text" class="form-control" aria-label="Amount" placeholder="10.00" name="amount">
                  </div>
                </div>
                <div class="form-group" style="padding-top: 0.6rem; padding-bottom: 0.45rem;">
                  <label>Date</label>
                  <div class="input-group">
                    <span style="width: 35px; padding-left: 0.60rem;" class="input-group-addon bg-info bg-info" id="colored-addon1">
                      <i class="mdi mdi-calendar text-white"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="colored-addon1" value="Immediately" name="date" disabled>
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
          <button style="float: right;" type="submit" class="btn btn-lg btn-success">Next</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>