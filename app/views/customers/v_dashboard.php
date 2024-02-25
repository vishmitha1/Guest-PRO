

<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





		

		<div class="clearfix"></div>
		<br/>
	<div class="smooth-scrolling">

		<a href="#bill_fletch">	
			<div class="col-div-3">
				<div class="box">
					<p><?php if(empty($data[2])){?>
							0 LKR<br/><span>Current Bill</span></p>
						<?php }else{?>	
							<?php echo ($data[2][0]->cost); ?> LKR<br/><span>Current Bill</span></p>
						<?php } ?>
					
					<i class="fa fa-wallet box-icon"></i>
				</div>
			</div>
		</a>
	
		<a href="#foodorder_fletch">	
			<div class="col-div-3">
				<div class="box">
					<p>01<br/><span>My Orders</span></p>
					<i class="fa fa-list box-icon"></i>
				</div>
			</div>
		</a>

		<a href="#ser_fletch">
			<div class="col-div-3">
				<div class="box">
					<p>0<br/><span>Active Servicerequests</span></p>
					<i class="fa fa-list box-icon"></i>
				</div>
			</div>
		</a>
	</div>	

		<div class="clearfix"></div>
		<br/><br/>
		<div class="col-div-8">
			<div class="box-8">
			<div class="content-box">
				<form action="<?php echo URLROOT;?>/Customers/updateOrder" method="POST" >
				<!-- <input type="hidden" name="order_id" value="<?php echo $data[0]->order_id; ?>"> -->
				<p>Last Order <span><button>Update</button></span></p></form>
				<br/>
				<table>
					
							
					<tr>
						<th>Item Name</th>
						<th>Cost</th>
						<th>Quantity</th>
					</tr>
					<?php if(!empty($data[0])){?>
						<?php $item=$data[0];
							$itemNames = explode(",",$item ->item_name);
							$itemCosts = explode(",", $item->cost);
							$quantities = explode(",", $item->quantity);
							$itemData = array_combine($itemNames, $quantities);
							for ($i = 0; $i < count($itemNames); $i++){?>
						<tr>
							<td><?php echo $itemNames[$i]; ?></td>
							<td><?php echo $quantities[$i] ; ?></td>
							<td><?php echo $itemCosts[$i];?>	</td>
						</tr>
						<?php } ?>	
					<?php } 
						?>		  
					
					
			
			
				</table>
			</div>
		</div>
		</div>

		<!-- <div class="col-div-4">
			<div class="box-4">
				<div class="content-box">
						<p> </p>

					<div class="circle-wrap">
						<div class="circle">
							<div class="mask full">
								<div class="fill"></div>
							</div>
							<div class="mask half">
								<div class="fill"></div>
							</div>
							<div class="inside-circle"> 70% </div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="col-div-4">
			<div class="box-4"  >
				<canvas id="chart-1" >

				</canvas>
			</div>
		</div>
		<div class="clearfix"></div>
		<!-- <div class="cus-dash-chart">
			
		</div> -->
			
		

		<div class="bill_fletch" id='bill_fletch'>
			<div class="bill_fletch_wrapper">

				<h2>Current Bill </h2>
				<table>
					<thead>
						<tr>
							<th>Description</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($data[1])){?>
							<?php foreach($data[1] as $item){?>
								<tr>
									<td><?php echo $item->description; ?></td>
									<td><?php echo $item->date; ?></td>
									<td><?php echo $item->amount; ?></td>
									<td><?php echo $item->status; ?></td>
								<tr>
							<?php } ?>
						<?php } ?>

					</tbody>	
				</table>
			</div>
		</div>

		<div class="foodorder_fletch" id="foodorder_fletch" >
			<div class="foodorder_fletch_wrapper">
				<h2>Active Food Orders</h2>
				<table>
					<thead>
						<tr>
							<th>Order Id</th>
							<th>Date</th>
							<th>Item Count</th>
							<th>Amount</th>
							<th>Status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($data[3])){?>
							<?php foreach($data[3] as $item){?>
								<tr>
									<td>
										
										<div class="dropdown">
											<button><?php echo $item->order_id; ?></button>
											<div class="dropdown-content">
												<table>
													<thead>
														<tr class='heder'>
															<th>Image</th>
															<th>Item Name</th>
															<th>Quantity</th>
															<th>Cost</th>
														</tr>
													</thead>
													<tbody>
														<?php $itemNames = explode(",",$item ->item_name);
															$itemCosts = explode(",", $item->cost);
															$quantities = explode(",", $item->quantity);
															$imgs = explode(",", $item->img);
															$itemData = array_combine($itemNames, $quantities);
															for ($i = 0; $i < count($itemNames); $i++){?>
														<tr>
															<td><img src="<?php echo URLROOT;?>/img/food_items/<?php echo $imgs[$i]; ?>.jpg" alt="item image"></td>
															<td><?php echo $itemNames[$i]; ?></td>
															<td><?php echo $quantities[$i] ; ?></td>
															<td><?php echo $itemCosts[$i]?>	</td>
															
														</tr>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</td>
									<td><?php echo $item->date; ?></td>
									<td><?php echo $item->item_count; ?></td>
									<td><?php echo $item->total; ?></td>
									<td class="edit-order">
										<form action="<?php echo URLROOT;?>/Customers/updateOrder" method="POST" >
											<input type="hidden" name="order_id" value="<?php echo $item->order_id; ?>">
											<input type="hidden" name="orderStatus" value="<?php echo $item->status; ?>">
							
										<?php if( strtolower($item->status) == 'placed'){?>
											<button class="placed"  ><span><?php echo $item->status; ?></span></button>
											<button class="cancel" name="cancel-foododer" >Cancel</button>
										<?php }
										elseif(strtolower($item->status) == 'preparing'){?>

											<span class="preparing" ><span><?php echo $item->status; ?></span></span>
										<?php }
										elseif(strtolower($item->status) == 'ready'){?>
											<span class="complete"  ><span><?php echo $item->status; ?></span></span>
										<?php }?>
									
									</form>

									</td>
								<tr>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
					

		</div>
		
	</div>

	

	
					
					
	



	<script>
		let links = document.querySelectorAll('.smooth-scrolling a');

		links.forEach(target => {
			target.onclick = function (e) {
				e.preventDefault(); // Prevent the default behavior of the anchor link

				let href = this.getAttribute('href');
				let offsetTop = document.querySelector(href).offsetTop;

				// Scroll to the target with smooth behavior
				window.scrollTo({
					top: offsetTop,
					behavior: 'smooth'
				});
			};
		});


		//chart-1
		var ctx = document.getElementById('chart-1');
		
		new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ['Reservation', 'Food Order'],
			datasets: [{
				label: 'My Cost',
				data: [300, 50],
				backgroundColor: [
				'#66b3ff ',
				'#ffff00',
				],
				borderColor:"black",
				borderWidth: .1
				// hoverOffset: 4
			}]
		},
		options: {
			plugins: {
				title: {
					display: true,
					text: 'My Cost', // You can replace this with your desired title
					font: {
                        size: 25,
						color:"#ffff00",
						
                    }
					

				},
			}	
    	}
		
		});
		


	</script>