<style type="text/css">
	.card{
		text-align: center;
        padding:9px 39px 20px 39px;
	}
	h3{
		color:#5D6974;
		text-transform: uppercase;
		font-weight: bold;
	}
	table,th,td{
		text-align: left;


	}
</style>
<br /><br />
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6" >
			<div class="card">
		     <h3><?= strtoupper($user->first_name.' '.$user->last_name) ?></h3>
		     <table class="table table-bordered" width="100%">
             <tr>
		     	<th>First Name</th>
		     	<td><?= $user->first_name ?></td>
		     </tr>
		     <tr>
		     	<th>Last name</th>
		     	<td><?= $user->last_name ?></td>
		     </tr>

		     <tr>
		     	<th>Username</th>
		     	<td><?= $user->username ?></td>
		     </tr>
		      <tr>
		     	<th>Email</th>
		     	<td><?= $user->email ?></td>
		     </tr>
		      
		      
		     <tr>
		     	<th>Created at</th>
		     	<td><?= Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans()  ?></td>
		     </tr>

		     </table>
		     <a href="<?=site_url('dashboard/profile/edit') ?>" class="btn btn-primary">Edit</a>
			</div>
		</div>
		</div>
	</div>
</div>