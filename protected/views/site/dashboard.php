<?php echo $this->renderPartial('_template_begin', array(
  'activeMenu' => 'dashboard',
), true) ?>

        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-warning text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">My Current Account</h4>
                  <h1 class="font-weight-normal mb-4">£ 4,109.30</h2>
                  <p class="card-text">Purple Power - 070436 08233593</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">My Credit Card</h4>
                  <h2 class="font-weight-normal mb-4">-£ 401.30</h2>
                  <p class="card-text">Pay until <?=date("M d, Y", strtotime("today + 3 days"))?> </p>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success text-white">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">My Savings</h4>
                  <h2 class="font-weight-normal mb-4">£ 10,109.30</h2>
                  <p class="card-text">Purple Saver 2018</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Transactions</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                          </th>
                          <th>
                          </th>
                          <th>
                            Payee
                          </th>
                          <th style="text-align: right;">
                            Amount
                          </th>
                          <th>
                            
                          </th>
                          <th>
                            Category
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Transaction Type
                          </th>
                          <th style="width: 30px;">
                            Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/jamies.png" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Jamie's Italian
                          </td>
                          <td style="text-align: right;">
                            £ 44.00
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-hamburger menu-icon"></i>
                          </td>
                          <td>
                            Dining Out
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("today"))?>
                          </td>
                          <td>
                            Apple Pay
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/tesco.gif" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Tesco
                          </td>
                          <td style="text-align: right;">
                            £ 18.51
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-shopping menu-icon"></i>
                          </td>
                          <td>
                            Groceries
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("today"))?>
                          </td>
                          <td>
                            Debit Card
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/mcdonalds.png" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            McDonald's
                          </td>
                          <td style="text-align: right;">
                            £ 5.00
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-hamburger menu-icon"></i>
                          </td>
                          <td>
                            Dining Out
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("today"))?>
                          </td>
                          <td>
                            Debit Card
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-left text-success icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face2.jpg" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Stella Johnson
                          </td>
                          <td style="text-align: right;">
                            £ 100.00
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">

                          </td>
                          <td>
                            
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("yesterday"))?>
                          </td>
                          <td>
                            Transfer
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/vodafone.png" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Vodafone
                          </td>
                          <td style="text-align: right;">
                            £ 84.39
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-phone menu-icon"></i>
                          </td>
                          <td>
                            Communication
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("yesterday"))?>
                          </td>
                          <td>
                            Direct Debit
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td style="width: 10px; text-align: right;">
                            <i class="mdi mdi-arrow-right text-danger icon-sm mr-1"></i>
                          </td>
                          <td style="width: 10px; text-align: right;">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/logos/tesco.gif" class="mr-2" alt="image">
                          </td>
                          <td class="py-1">
                            Tesco
                          </td>
                          <td style="text-align: right;">
                            £ 10.39
                          </td>
                          <td style="width: 10px; margin: 0; padding: 0; text-align: right;">
                            <i class="mdi mdi-shopping menu-icon"></i>
                          </td>
                          <td>
                            Groceries
                          </td>
                          <td>
                            <?=date("M d, Y", strtotime("yesterday"))?>
                          </td>
                          <td>
                            Apple Pay
                          </td>
                          <td style="width: 30px;">
                            <label class="badge badge-gradient-success">Settled</label>
                          </td>
                        </tr>
                        <tr>
                          <td colspan=9 style="margin-right: 20px; text-align: right;"><a href="#">View all transactions</a></td></tr>
                        <!--- 
                        <tr>
                          <td>
                            5670
                          </td>
                          <td>
                            High loading time
                          </td>
                          <td class="py-1">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face2.jpg" class="mr-2" alt="image">
                            Stella Johnson
                          </td>
                          <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>
                          </td>
                          <td>
                            Dec 12, 2017
                          </td>
                          <td>
                            WD-12346
                          </td>
                          <td>
                            <i class="mdi mdi-arrow-up text-danger icon-sm mr-1"></i>High
                          </td>
                        </tr>
                        <tr>
                          <td>
                            5671
                          </td>
                          <td>
                            Website down for one week
                          </td>
                          <td class="py-1">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face3.jpg" class="mr-2" alt="image">
                            Marina Michel
                          </td>
                          <td>
                            <label class="badge badge-gradient-secondary">ON HOLD</label>
                          </td>
                          <td>
                            Dec 16, 2017
                          </td>
                          <td>
                            WD-12347
                          </td>
                          <td>
                            <i class="mdi mdi-arrow-up text-success icon-sm mr-1"></i>Low
                          </td>
                        </tr>
                        <tr>
                          <td>
                            5672
                          </td>
                          <td>
                            Loosing control on server
                          </td>
                          <td class="py-1">
                            <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face4.jpg" class="mr-2" alt="image">
                            John Doe
                          </td>
                          <td>
                            <label class="badge badge-gradient-success">DONE</label>
                          </td>
                          <td>
                            Dec 3, 2017
                          </td>
                          <td>
                            WD-12348
                          </td>
                          <td>
                            <i class="mdi mdi-arrow-up text-warning icon-sm mr-1"></i>Medium
                          </td>
                        </tr>
                      -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Spendings and Savings</h4>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex flex-column">
                  <h4 class="card-title">Spending Categories</h4>
                  <canvas id="pieChart" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Updates</h4>
                  <div class="d-flex">
                    <div class="d-flex align-items-center mr-4 text-muted">
                      <i class="mdi mdi-account icon-sm mr-2"></i>
                      <span>jack Menqu</span>
                    </div>
                    <div class="d-flex align-items-center text-muted">
                      <i class="mdi mdi-calendar-blank icon-sm mr-2"></i>
                      <span>October 3rd, 2018</span>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-6 pr-1">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_1.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_4.jpg" class="mw-100 w-100 rounded" alt="image">
                    </div>
                    <div class="col-6 pl-1">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_2.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                      <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/dashboard/img_3.jpg" class="mw-100 w-100 rounded" alt="image">
                    </div>
                  </div>
                  <div class="d-flex mt-5 align-items-top">
                    <img src="<?=Yii::app()->request->baseUrl . '/template/';?>images/faces/face3.jpg" class="img-sm rounded-circle mr-3" alt="image">
                    <div class="mb-0 flex-grow">
                      <p class="font-weight-bold mr-2 mb-0">Jack Manque</p>
                      <p>This is amazing! We have moved to a brand new branch office in
                        Glasgow with a lot more space.
                        We will miss our old office but we are very excited about our new space.</p>
                    </div>
                    <div class="ml-auto">
                      <i class="mdi mdi-heart-outline text-muted"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<?php echo $this->renderPartial('_template_end', array(
  'activeMenu' => 'dashboard',
), true) ?>