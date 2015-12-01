<style type="text/css">
	.card{
		padding: 10px 20px 4px 20px;
		text-align: center;
		box-shadow: 2px 0px 4px -1px rgba(0,0,0,0.3);
	}

	h3{
		color:#5D6974;
		text-transform: uppercase;
		font-weight: bold;
	}
	.btn-group .btn{
		width:50%;
	}
	
</style>

<br /><br />
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
		<div class="card">
		
		
            <h3>edit user details</h3>
            
            
            
			<form method="post" action="<?= current_url()?>">
				<div class="form-group <?= (form_error('first_name')) ?'has-error' :''?>">
                 <input type="text" name="first_name" class="form-control floating-label"  placeholder="First Name" value="<?=$user_details->first_name?>"/>
                 <small class="text-danger"><?=form_error('first_name')?></small>
				</div>
				<div class="form-group <?= (form_error('last_name')) ?'has-error' :''?>">
                 <input type="text" name="last_name" class="form-control floating-label"  placeholder="Last Name" value="<?=$user_details->last_name?>"/>
                 <small class="text-danger"><?=form_error('last_name')?></small>
				</div>
                <div class="form-group <?= (form_error('username')) ?'has-error' :''?>">
                 <input type="text" name="username" class="form-control floating-label"  placeholder="Userame" value="<?=$user_details->username?>"/>
                 <small class="text-danger"><?=form_error('username')?></small>
				</div>

				<div class="form-group <?= (form_error('email')) ?'has-error' :''?>">
                 <input type="text" name="email" class="form-control floating-label"  placeholder="Email Address" value="<?=$user_details->email?>"/>
                 <small class="text-danger"><?=form_error('email')?></small>
				</div>
				

				<div class="btn-group btn-block">
				<button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Edit</button>
				<a href="javascript:history.go(-1);" class="btn btn-primary"><i class="fa fa-times"></i> Cancel</a>
				</div>
			</form>
			
			
			</div>
		</div>
	</div>
</div>