<?php

    Assets::js([
        template_url('plugins/jquery/jquery-2.1.4.min.js', 'smarty'),
        template_url('js/app.js', 'smarty'),
        template_url('js/custom.js', 'smarty'),
        template_url('js/jquery.are-you-sure.js', 'smarty'),
        template_url('js/ays-beforeunload-shim.js', 'smarty'),
        template_url('js/auction.js', 'smarty'),
    ]);

    echo isset($js) ? $js : ''; // Place to pass data / plugable hook zone

    echo isset($footer) ? $footer : ''; // Place to pass data / plugable hook zone
?>

					<div class="panel panel-default">
						<div class="panel-body">

							<div class="row">

								<div class="col-md-6 col-sm-6 text-left">

									<h4><strong>Auction</strong> Details</h4>
									<ul class="list-unstyled">
										<li><strong>Auction ID:</strong> <?= $auction_id; ?></li>
										<li><strong>Discount Rate:</strong> <?= $discount_rate; ?>%</li>
										<li><strong>Expiry Date:</strong> <?= $auction_date; ?></li>
										<li><strong>Status:</strong> <?= $status; ?></li>
									</ul>

								</div>

							</div>

							<div class="table-responsive">
                                <h4><strong>Invoice</strong> Details</h4>
								<table class="table table-condensed nomargin">
									<thead>
										<tr>
											<th>Invoice No</th>
											<th>Supplier</th>
											<th>Invoice Date</th>
											<th>Expiry Date</th>
											<th style="text-align: right">Grand Totals</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: right">Discount</th>
										</tr>
									</thead>
									<tbody>
                                         <?= $inv_html; ?>
									</tbody>
								</table>
							</div>

							<hr class="nomargin-top" />

						</div>
					</div>


					<div class="panel panel-default text-right">
						<div class="panel-body">
                            <button id="btnBack1" name="btnBack1" type="submit" class="btn btn-3d btn-primary" style="width:90px;" onclick="location.href='/listauction';" >
                                <i id="icnSpinner" class="fa fa-angle-left"></i>Back   
                            </button>
						</div>
					</div>