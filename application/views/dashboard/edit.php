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

<br /><br>
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
		<div class="card">
		
		
            <h3>edit details</h3>
            
            
            
			<form method="post" action="<?= current_url()?>">
				<div class="form-group <?= (form_error('name')) ?'has-error' :''?>">
                 <input type="text" name="name" class="form-control floating-label"  placeholder="Name" value="<?=$details->name?>"/>
                 <small class="text-danger"><?=form_error('name')?></small>
				</div>
				<div class="form-group <?= (form_error('email')) ?'has-error' :''?>">
                 <input type="text" name="email" class="form-control floating-label"  placeholder="Email Address" value="<?=$details->email?>"/>
                 <small class="text-danger"><?=form_error('email')?></small>
				</div>
				<div class="form-group <?= (form_error('address')) ?'has-error' :''?>">
                 <textarea name="address" class="form-control floating-label" rows="5" placeholder="Address" ><?=$details->address?></textarea>
                 <small class="text-danger"><?=form_error('address')?></small>
				</div>
				<div class="form-group <?= (form_error('location')) ?'has-error' :''?>">
                 <input type="text" name="location" class="form-control floating-label"  placeholder="Location" value="<?=$details->location?>"/>
                 <small class="text-danger"><?=form_error('location')?></small>
				</div>
				<div class="form-group <?= (form_error('pin')) ?'has-error' :''?>">
                 <input type="text" name="pin" class="form-control floating-label"  placeholder="PIN" value="<?=$details->pin?>"/>
                 <small class="text-danger"><?=form_error('pin')?></small>
				</div>
				<div class="form-group <?= (form_error('website')) ?'has-error' :''?>">
                 <input type="text" name="website" class="form-control floating-label"  placeholder="Website" value="<?=$details->website?>"/>
                 <small class="text-danger"><?=form_error('website')?></small>
				</div>
				<div class="form-group <?= (form_error('phone')) ?'has-error' :''?>">
                 <input type="text" name="phone" class="form-control floating-label"  placeholder="Phone Number" value="<?=$details->phone?>"/>
                 <small class="text-danger"><?=form_error('phone')?></small>
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