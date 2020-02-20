<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/');
require DOC_ROOT_PATH . "test_p/application/views/layout/header.php";
?>
<div class="container invitefriend">

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0 borders">

			<div class="container expense_friends border " style="padding: 20px">
				<div class="row" style="margin-left: 5px" >
					<img src="<?php echo base_url()?>/asset/images/<?php echo $upicture; ?>" style="display: inline-block;width: 50px; height: 50px;border-radius: 50%;margin: 3px">
					<div class="col-3" style="display: inline-block"><h2><?php echo $fname. "  " .$lname; ?></h2></div>
					<div class="col-7" style="margin-left:50px">

						<div class="row" style="margin-top: 10px">
						<a href="<?= site_url('search_friends'); ?>" class="btn btn-primary btn-sm"style="height:30px;margin-left:50px;margin-right:30px">Search friends</a>
							
						<div class="dropdown" style="width: 40px; display: inline-block">
							<div id="dropdownMenuButton" data-toggle="dropdown">
								<i class="fas fa-user-circle" style="font-size:36px"></i>
							</div>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 350px;margin-top:20px;">
								<div>
									<?php foreach($friend_requests as $request){ ?>
									<div class="row" style="padding: 5px 10px">
									<img src="<?php echo base_url()?>/asset/images/<?php echo $request->picture; ?>" style="width: 50px; height: 50px;border-radius: 50%;margin-left:10px;">
									<p  style="display: inline-block;padding: 5px 10px;background-color: #e1e4e5;border-radius: 5px;margin-left: 10px;margin-top:10px;"><?= $request -> fullname; ?></p>
									
									<form method="post" action="<?= site_url('accept_friend_request'); ?>">
                                            <input type="hidden" id="Id" name="sender_id" value="<?= $request -> sender_id;?>">
                                            <button class="btn btn-secondry btn-sm" style="height:25px;margin-top:15px;margin-left:10px;" type="submit" name="accept">Accept</button>
									</form>
									<form method="post" action="<?= site_url('reject_friend_request');?>">
                                            <input type="hidden" id="Id" name="sender_id" value="<?= $request -> sender_id?>">
                                            <button class="btn btn-danger btn-sm" style="height:25px;margin-top:15px;" type="submit" name="reject">Reject</button>
                                    </form>
								
									</div>
								<?php } ?>
								</div>
							</div>
						</div>
						<div class="border border-dark text-center" style="width: 30px; height: 30px; display: inline-block; margin-top: 5px;border-radius: 50%">
							<p style="margin-top: 3px"><?= $request_no;?></p>
						</div>
							<div class="dropdown" style="width: 35px; display: inline-block;margin-left:20px">
								<div id="dropdownMenuButton" data-toggle="dropdown">
									<i class="fas fa-bell" style="font-size:36px"></i>
								</div>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#">notification one </a>
									<a class="dropdown-item" href="#">notification two</a>
									<a class="dropdown-item" href="#">notification three</a>
								</div>
							</div>
							<div class="border border-dark text-center" style="width: 30px; height: 30px; display: inline-block; margin-top: 5px">
								<p style="margin-top: 3px">53</p>
							</div>
							<a href="<?= site_url('logout'); ?>" class="btn btn-primary btn-sm"style="height:30px;margin-left:50px">Log out</a>
							<div class="border text-center" style="border-radius: 50%;width: 40px;height: 40px;margin-left: 20px"> <a href="<?= site_url('create_group'); ?>"><i class="fas fa-plus" style="margin-top: 11px"></i></a> </div>

						</div>

					</div>
				</div>

			</div>






			<div style="height: 400px;margin-top: 10px">
				<div>
					<table class="table">
						<tbody>

						<?php foreach($groups as $group){ ?>
							<tr>
									<td><img src="<?php echo base_url()?>/asset/group_images/<?= $group -> pic; ?>" style="display: inline-block;width: 50px; height: 50px;margin: 3px"></td>
									<td><p class="td" style="margin-top: 15px"><?= $group -> title ?></p></td>
									<td>
									<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
										<p class="td" style="margin-top: 9px">Created By : <?= $group->fullname;?></p>
									</div>
									</td>
									<td>
									<div class="border border-dark text-center" style="background-color: whitesmoke;height: 40px; margin-top: 10px">
										<p class="td" style="margin-top: 9px"><?php $date = date_create_from_format("Y-n-j G:i:s",$group -> created_at);echo date_format($date,"d/m/Y"); ?></p>
									</div>
									</td>
									<td><div class="border text-center" style="border-radius: 50%;width: 50px;height: 50px; margin-top: 10px"><p class="td" style="margin-top: 14px">T: 34</p></div></td>
									<td><div class="border text-center" style="width: 90px;height: 40px; margin-top: 10px"><p class="td" style="margin-top: 9px">3456 RS</p></div></td>
									<td><a href="<?= site_url('show_transaction/'.$group->id); ?>"><i class="far fa-arrow-alt-circle-right" style="margin-top: 13px;font-size:36px"></i></a></td>
							</tr>
						<?php } ?>

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

