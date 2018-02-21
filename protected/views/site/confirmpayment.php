<?php echo $this->renderPartial('_template_begin', array(
  'activeMenu' => 'dashboard',
), true) ?>

        <div class="content-wrapper">
          <div style="margin-top: 20px; margin-bottom: 20px;" class='h2'>Confirm Payment</div>
          <form class="forms-sample" id="outgoingtransfer" method="post" action="<?=Yii::app()->createUrl('site/confirmpayment')?>">
          <div class="row">
              <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Source</h4>

                      <input type="hidden" name="source" value="<?=htmlspecialchars($_POST['source'])?>">

                      <div class="card bg-gradient-warning text-white">
                        <div class="card-body">
                          <h5 class="font-weight-normal mb-3">070436 08233593</h5>
                          <h3 class="font-weight-normal mb-4">My Current Account</h3>
                          <p class="card-text">Balance: £ 4,109.30</p>
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recipient <button style="float: right; margin-top: -5px; padding-left: 10px; padding-right: 10px;" type="submit" class="btn btn-success mr-2 mdi mdi-plus"></button></h4>
                      <div class="form-group">
                        <select class="form-control form-control-lg" name="recipient">
                          <option>Stella Johnson</option>
                        </select>
                      </div>

                      <div class="card bg-gradient-success text-white">
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
                    <button style="float: right;" type="submit" class="btn btn-lg btn-success mr-2">Next</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>