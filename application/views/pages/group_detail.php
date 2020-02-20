<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>

<div class="container invitefriend">

	<!--Card content-->
	<div class="card-body px-lg-5 pt-0">

		<div class="container expense_friends border " style="padding: 20px">
			<div class="row" style="margin-left: 5px">
				<img src="<?php echo base_url()?>/asset/group_images/<?= $pic; ?>" style="display: inline-block;width: 50px; height: 50px;border-radius: 50%;margin: 3px">
				<div class="col-4" style="display: inline-block"><h2><?= $title; ?></h2></div>
				<div class="col">

					<div class="row" style="margin-top: 10px ;">
						<div class="dropdown" style="width: 60px; display: inline-block;margin-left: 20px">
							<div id="dropdownMenuButton" data-toggle="dropdown">
								<i class="fa fa-users" style="font-size:36px"></i>
							</div>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width:200px">
								<?php foreach($group_member as $group){ ?>
								<div>
									<div class="row" style="padding: 5px 10px">
										<div class="col-2">
											<img src="<?php echo base_url()?>/asset/images/<?= $group -> picture;?> " style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
										</div>
										<div class="col text-center" style=" margin-left: 20px ">
											<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 10px; margin-top: 5px"><?= $group -> fullname;?></p>
										</div>

									</div>
								</div>
								<?php } ?>

							</div>
						</div>
						<div class="border border-dark text-center" style="width: 30px; height: 30px; display: inline-block; margin-top: 5px;border-radius: 50%">
							<p style="margin-top: 3px"><?= $total_members; ?></p>
						</div>
						<div style="border-left: 2px solid black;height: 35px;margin-left:10px;"></div>
							<div style="margin-left:10px">
								<i class="fa fa-tasks" style="font-size:36px"></i>
							</div>
							<div class="border border-dark text-center" style="width: 30px; height: 30px; display: inline-block; margin-top: 5px;border-radius: 50%;margin-left:10px">
							<p style="margin-top: 3px">23</p>
						</div>


						<div class="border border-dark text-center" style="height: 30px; display: inline-block; margin-top: 5px; margin-left: 30px;">
							<p style="margin: 3px">TOTAL : 3145 RS</p>
						</div>
						<div class="dropdown">
								<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Invite
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 300px">
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<a href="#" class="btn btn-primary btn-sm" style="height:30px">invite</a>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<a href="#" class="btn btn-primary btn-sm"style="height:30px">invite</a>

										</div>
									</div>

								</div>
							</div>
						<div class="border border-dark text-center" style="border-radius: 50%;width: 40px;height: 40px;margin-left: 70px"> <a href="<?= site_url('create_transaction/'.$id); ?>"><i class="fas fa-plus" style="margin-top: 11px"></i></a> </div>

					</div>

				</div>
			</div>

		</div>



		<div style="height: 400px;margin-top: 10px">
			<div>
				<div style="width: 100%" class="text-center">
					<h4>Group members</h4>
				</div>
				<table class="table">

					<tbody>
					<!-- transaction rows -->
					<?php foreach($group_member as $group){ ?>
					<tr style="background-color: #e6e6ff">
						<td><img src="<?php echo base_url()?>/asset/images/<?= $group -> picture; ?>" style="display: inline-block;width: 50px; height: 50px;margin: 3px"></td>
						<td><p class="td" style="margin-top: 15px"><?= $group -> fullname; ?></p></td>
						<td><div class="border border-dark text-center" style="background-color: whitesmoke; border-radius: 50%;width: 40px;height: 40px; margin-top: 10px"><p class="td" style="margin-top: 9px">T:34</p></div></td>
						<td><div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px"><p class="td" style="margin-top: 9px">CREDIT: 3456 RS</p></div></td>
						<td><div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px"><p class="td" style="margin-top: 9px">DEBT: -3456 RS</p></div></td>

					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			<!-- member rows -->
			<div>
				<div style="width: 100%" class="text-center">
					<h4>Transaction list</h4>
				</div>
				<table class="table">

					<tbody>
					<!-- transaction rows -->

					<tr style="background-color: #e6e6ff ">
						<td>
							<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
								<p class="td" style="margin-top: 9px">Created By : zakir</p>
							</div>
						</td>
						<td>
							<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
								<p class="td" style="margin-top: 9px">18/12/2019</p>
							</div>
						</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Spenders
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 300px">
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">453 RS</p>
											</div>

										</div>
									</div>

								</div>
							</div>
						</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Items
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 250px">
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">Item 1</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">Item 2</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">Item 3</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">453 RS</p>
											</div>

										</div>
									</div>

								</div>
							</div>
						</td>
						<td>
							<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
								<p class="td" style="margin-top: 9px">TOTAL: 3456 RS</p>
							</div>
						</td>
						<td>
								<div class="border border-dark text-center" style="background-color: whitesmoke;border-radius: 50%;width: 40px;height: 40px;margin-top: 10px">
									<a href="<?= site_url('create_expense'); ?>"><i class="fa fa-edit" style="margin-top: 12px"></i></a>
								</div>
						</td>
					</tr>
					<tr style="background-color: #e6e6ff ">
						<td>
							<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
								<p class="td" style="margin-top: 9px">Created By : irfan</p>
							</div>
						</td>
						<td>
							<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
								<p class="td" style="margin-top: 9px">18/12/2019</p>
							</div>
						</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Spenders
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 300px">
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-1">
												<img src="<?php echo base_url()?>/asset/images/1576239756 569815.jpg" style="display: inline-block;width: 40px; height: 40px;border-radius: 50%;margin: 3px">
											</div>
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">Friend name</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px; margin-top: 8px">453 RS</p>
											</div>

										</div>
									</div>

								</div>
							</div>
						</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Items
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 250px">
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">Item 1</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">Item 2</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">453 RS</p>
											</div>

										</div>
									</div>
									<div>
										<div class="row" style="padding: 5px 10px">
											<div class="col-6" style=" margin-left: 15px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">Item 3</p>
											</div>
											<div class="col" style=" margin-left: 10px ">
												<p class="w3-tag w3-round w3-green w3-border w3-border-white" style="padding: 3px 5px;">453 RS</p>
											</div>

										</div>
									</div>

								</div>
							</div>
						</td>
						<td><div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px"><p class="td" style="margin-top: 9px">TOTAL: 3456 RS</p></div></td>
						<td>
								<div class="border border-dark text-center" style="background-color: whitesmoke;border-radius: 50%;width: 40px;height: 40px;margin-top: 10px">
									<a href="<?= site_url('create_expense'); ?>"><i class="fa fa-edit" style="margin-top: 12px"></i></a>
								</div>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<!-- Material form register -->
</div>

<?php
require DOC_ROOT_PATH . "test_p/application/views/layout/footer.php";


?>


