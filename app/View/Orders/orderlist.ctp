<div id="layout">
    <div id="store-browse">
        <div class="facets row" id="facets">
            <div class="breadcrumb-container small-8 medium-5 columns">
                <h6 class="heading-metadata"><span>Order History</span></h6>
            </div>
            <div id="facet-selection-container" class="small-4 medium-7 columns">
			    <ul class="inline-list" id="filter-list">
			        <li class="facet-list__wrapper">
                                     <form method="POST">  
			            <input type="text" name="orderid" placeholder="Search By Order ID">
			            <input type="submit" value="Search">
                                     </form>   
			        </li>
			    </ul> 
			</div>
            <div class="small-12 columns">
                <hr class="facets__bottom-border">
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
				<div class="table_history"> 
					<table>
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Order Date/Time</th>
								<th>Shop Name</th>
								<th>Status</th>
								<th>Sub Total</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
                                                     <?php
                                                        $datalist = $fdata?$fdata:$data;
                                                          if(!empty($datalist)){   
                                                           foreach($datalist as $list):  ?>
							<tr>
								<td><a href="<?php echo $this->webroot."orders/orderhistry/".$list['Order']['id']; ?>"><?php echo $list['Order']['id']; ?></a></td>
								<td><span class="date"><?php echo $list['Order']['created']; ?></span></td>
								<td><?php echo $list['Restaurant']['name']; ?></td> 
								<td><?php if($list['Order']['status']==0){ echo "Payment Pending"; }elseif($list['Order']['status']==1)
                                                                    { echo "Placed"; }elseif($list['Order']['status']==2)
                                                                    { echo "Confirmed"; }elseif($list['Order']['status']==3)
                                                                    { echo "Cancelled"; }elseif($list['Order']['status']==4)
                                                                    { echo "Delivery"; }elseif($list['Order']['status']==5)
                                                                    { echo "Pending"; }   
                                                                   ?>
                                                                </td>
								<td><span class="curreny">$</span><span class="amount"><?php echo $list['Order']['subtotal']; ?></span></td>
								<td><span class="curreny">$</span><span class="amount"><?php echo $list['Order']['total']; ?></span></td>
							</tr> 
                                                          <?php 
                                                            endforeach ;
                                                            ?>  
                                                              <?php echo $this->Paginator->numbers(array(
                                                                    'before' => '<nav class="text-center order_pg"><ul class="pagination">', 
                                                                    'separator' => '', 
                                                                    'tag' => 'li',
                                                                    'after' => '</ul></nav>' 
                                                                      )); ?>  
                                                            <?php   
                                                            }else{ 
                                                                    echo "<tr>There is no order</tr>";  
                                                                    }
                                                                ?> 
							
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>  