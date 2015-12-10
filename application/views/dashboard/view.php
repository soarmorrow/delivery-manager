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
		     	<td><?= nl2br($details->address) ?><br />
                <?php
                 if($details->pin){
                   echo	"PIN: ".$details->pin."<br />";
                 }
                 if($details->email){
                   echo	"Email: ".$details->email ."<br />";
                 }
                  if($details->website){
                   echo	"Website: ".$details->website;
                 }

                ?>
		     	</td>
		     </tr>
		      <tr>
		     	<th>location</th>
		     	<td><?= $details->location ?></td>
		     </tr>
		      <tr>
		      	<th>Order Status</th>
		      	<td><span class="label label-<?=$details->label?>"><?= $details->status ?></span></td>
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
		     <a href="javascript:history.go(-1);" class="btn btn-primary">Back</a>
			</div>
		</div>
		</div>
	</div>
</div>