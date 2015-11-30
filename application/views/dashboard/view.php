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
		     <h3><?= strtoupper($details->name) ?></h3>
		     <table class="table table-bordered" width="100%">
		     <tr>
		     	<th>Address</th>
		     	<td><?= $details->address ?></td>
		     </tr>
		      <tr>
		     	<th>location</th>
		     	<td><?= $details->location ?></td>
		     </tr>
		      <tr>
		     	<th>PIN</th>
		     	<td><?= $details->pin ?></td>
		     </tr>
		      <tr>
		     	<th>Email</th>
		     	<td><?= $details->email ?></td>
		     </tr>
		      <tr>
		     	<th>Phone</th>
		     	<td><?= $details->phone ?></td>
		     </tr>
		     <tr>
		     	<th>Created at</th>
		     	<td><?= Carbon\Carbon::createFromTimestamp(strtotime($details->created_at))->diffForHumans()  ?></td>
		     </tr>

		     </table>
		     <a href="<?= site_url('dashboard') ?>" class="btn btn-primary">Back</a>
			</div>
		</div>
		</div>
	</div>
</div>