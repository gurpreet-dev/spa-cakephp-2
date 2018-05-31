<div id="layout">
    <div id="store-browse">
        <div class="facets row" id="facets">
            <div class="breadcrumb-container small-8 medium-5 columns">
                <h6 class="heading-metadata"><span>Order Detail</span></h6>
            </div>
               <?php 
              $x=$this->Session->flash(); echo $x;  
          ?> 
            <div class="small-12 columns">
                <hr class="facets__bottom-border">
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns"> 
				<div class="table_history table_show">
					<div class="order_track">
						<div class="order_head">
							<h5>Order Tracking</h5>
						</div>
						<div class="order_progress">
							<div class="step <?php if($datahistory['Order']['status']== 0){ echo "active"; }?>">
								<label>Payment Pending</label>
								<div class="border-line"></div>
							</div>
							<div class="step <?php if($datahistory['Order']['status']== 1){ echo "active"; }?>">
								<label>Placed</label>
								<div class="border-line"></div>
							</div>
							<div class="step <?php if($datahistory['Order']['status']== 2){ echo "active"; }?>">
								<label>Confirmed</label>
								<div class="border-line"></div>
							</div>
							<div class="step <?php if($datahistory['Order']['status']== 3){ echo "active"; }?>">
								<label>Cancelled</label>
								<div class="border-line"></div>
							</div>
							<div class="step <?php if($datahistory['Order']['status']== 4){ echo "active"; }?>">
								<label>Delivered</label>
								<div class="border-line"></div>
							</div>
                                                        <div class="step <?php if($datahistory['Order']['status']== 5){ echo "active"; }?>">
								<label>Pending</label> 
								<div class="border-line"></div>
							</div>
						</div>
					</div>
					<div class="order_head">
						<h5>Order Detail</h5>
					</div>
					<table>
						<tbody>
							<tr>
								<td>
									<table>
										<thead>
											<tr>
												<th>Order ID</th>
												<th>Order Date/Time</th>
												<th>Amount Paid</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><a href="#"><?php echo $datahistory['Order']['id']; ?></a></td>
												<td><span class="date"><?php echo $datahistory['Order']['created']; ?></td>
												<td><span class="curreny">$</span><span class="amount"><?php echo $datahistory['Order']['total']; ?></span></td>
											</tr>
			
										</tbody>
									</table>
								</td>
								<td>
									<div class="col_center">
										<h2><?php echo $datahistory['Order']['first_name']." ".$datahistory['Order']['last_name']; ?></h2>
										<p><span>Mobile</span> <?php echo $datahistory['Order']['phone']; ?></p>
										<address>Address. :- <?php echo $datahistory['Order']['shipping_address']; ?><br />
										<?php echo $datahistory['Order']['shipping_city']; ?><br />
                                                                                <?php echo $datahistory['Order']['shipping_zip']; ?><br />
										</address>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="order_head">
						<h5>Order Items</h5>
					</div>
					<table>
						<thead>
							<tr>
								<th>Item Name</th>
								<th>Quantity</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
                                                     <?php foreach ($datahistory['OrderItem'] as $item): ?>
							<tr>
								<td><?php echo $item['name']; ?></td>
								<td><?php echo $item['quantity']; ?> X <?php echo $item['price']; ?></td>
								<td><span class="curreny">$</span> <span class="amount"><?php echo $item['quantity']*$item['price']; ?></span></td>
							</tr>
                                                       <?php endforeach; ?>    
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>     