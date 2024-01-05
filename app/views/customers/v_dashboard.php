

<?php   require APPROOT. "/views/includes/components/sidenavbar.php" ?>

<div class="home">

		

		<div class="clearfix"></div>
		<br/>
		
		<div class="col-div-3">
			<div class="box">
				<p>2500 LKR<br/><span>Current Bill</span></p>
				
                <i class="fa fa-wallet box-icon"></i>
			</div>
		</div>
		<div class="col-div-3">
			<div class="box">
				<p>01<br/><span>Active Reservations</span></p>
				<i class="fa fa-list box-icon"></i>
			</div>
		</div>
		<div class="col-div-3">
			<div class="box">
				<p>01<br/><span>Active Servicerequests</span></p>
				<i class="fa fa-list box-icon"></i>
			</div>
		</div>


		<div class="clearfix"></div>
		<br/><br/>
		<div class="col-div-8">
			<div class="box-8">
			<div class="content-box">
				<form action="<?php echo URLROOT;?>/Customers/updateOrder" method="POST" >
				<p>Last Order <span><button>Update</button></span></p></form>
				<br/>
				<table>
					
							
					<tr>
						<th>Item Name</th>
						<th>Cost</th>
						<th>Quantity</th>
					</tr>
					<?php if(!empty($data)){?>
						<?php $item=$data;
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

		<div class="col-div-4">
			<div class="box-4">
			<div class="content-box">
				<p>Total Discount </p>

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
		</div>
			
		<div class="clearfix"></div>
	</div>