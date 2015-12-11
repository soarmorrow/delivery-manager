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
    #map_canvas{
        width: 100%;
        height: 350px;
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
                    <div id="map_canvas"></div>
                    <input type="hidden" name="latitude" value="<?=$details->latitude?>">
                    <input type="hidden" name="longitude" value="<?=$details->longitude?>">
                    <input type="hidden" name="google_place_id" value="<?=$details->google_place_id?>">
                    <input type="text" name="location" id="location" class="form-control"  placeholder="Location" value="<?=$details->location?>"/>
                 <small class="text-danger"><?=form_error('location')?></small>
				</div>
				<div class="form-group <?= (form_error('pin')) ?'has-error' :''?>">
                 <input type="text" name="pin" class="form-control"  placeholder="PIN" value="<?=$details->pin?>"/>
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

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDHWvuZNsivQxVfbEMS6eilYwqPwlpuJQA&amp;libraries=places"></script>
<script src="<?= base_url('assets/js/jquery.geocomplete.min.js') ?>"></script>
<script type="text/javascript">
    var geocoder = new google.maps.Geocoder();
    var options = {
        map: "#map_canvas",
        location: "<?=($details->location)?$details->location:'Kochi'?>",
        markerOptions: {
            draggable: true
        }
    };
    var map = $("#location");
    map.geocomplete(options)
        .bind("geocode:result", function (event, result) {
            $("input[name=latitude]").val(result.geometry.location.lat());
            $("input[name=longitude]").val(result.geometry.location.lng());
            $("input[name=google_place_id]").val(result.place_id);
            codeLatLng(result.geometry.location, false);
        });

    map.bind("geocode:dragged", function (event, latLng) {
        $("input[name=latitude]").val(latLng.lat());
        $("input[name=latitude]").val(latLng.lng());
        codeLatLng(latLng, true);
    });
    function codeLatLng(latlng, update_text_field) {
        geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        if (update_text_field) {
                            $("#location").val(results[0].formatted_address);
                            $("input[name=google_place_id]").val(results[0].place_id);
                        }
                        var address = results[0].address_components;
                        for (var i = 0; i < address.length; i++) {
                            if (jQuery.inArray("postal_code", address[i].types) != -1) {
                                $('input[name="pin"]').val(address[i].long_name)
                            }
                        }
                    } else {
                        console.log('No results found');
                    }
                } else {
                    console.log('Geocoder failed due to: ' + status);
                }
            }
        )
    }
</script>