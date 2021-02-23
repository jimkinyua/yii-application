<?php

/* @var $this yii\web\View */

$this->title = 'Appraisal Periods';
?>
<div class="site-index">

<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary view_employee" href="./index.php?page=new_employee"><i class="fa fa-plus"></i> Add New Employee</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Department</th>
						<th>Designation</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<th class="text-center"></th>
						<td><b>Test</b></td>
						<td><b>Another Test</b></td>
						<td><b><?php echo 'Unknow Department' ?></b></td>
						<td><b><?php echo 'Unknow Designation'; ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_employee" href="javascript:void(0)" data-id=>View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_employee&id=">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_employee" href="javascript:void(0)" data-id=>Delete</a>
		                    </div>
						</td>
					</tr>	
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
