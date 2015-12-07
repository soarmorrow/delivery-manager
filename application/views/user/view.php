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
		     <h3><?= strtoupper($user_details->first_name) ?></h3>
		     <table class="table table-bordered" width="100%">
		     <tr>
		     	<th>First Name</th>
		     	<td><?= $user_details->first_name ?></td>
		     </tr>
		      <tr>
		     	<th>Last Name</th>
		     	<td><?= $user_details->last_name ?></td>
		     </tr>
		      <tr>
		     	<th>Username</th>
		     	<td><?= $user_details->username ?></td>
		     </tr>
		      <tr>
		     	<th>Email</th>
		     	<td><?= $user_details->email ?></td>
		     </tr>
		      
		     <tr>
		     	<th>Created at</th>
		     	<td><?= Carbon\Carbon::createFromTimestamp(strtotime($user_details->created_at))->diffForHumans()  ?></td>
		     </tr>

		     </table>
		     <a href="javascript:history.go(-1);" class="btn btn-primary">Back</a>
			</div>
		</div>
		</div>
	</div>
</div>