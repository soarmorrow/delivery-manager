<style type="text/css">
    .card {
        padding: 10px 20px 4px 20px;
        text-align: center;
        box-shadow: 2px 0px 4px -1px rgba(0, 0, 0, 0.3);
    }

    h3 {
        color: #5D6974;
        text-transform: uppercase;
        font-weight: bold;
    }

    .btn-group .btn {
        width: 50%;
    }

    #map_canvas {
        width: 100%;
        height: 350px;
    }

</style>

<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="card">


                <h3>edit user details</h3>


                <form method="post" action="<?= current_url() ?>">
                    <!--First name and last name-->
                    <div class="row">
                        <div class="col-sm-6 col-md-6">

                            <div class="form-group <?= (form_error('first_name')) ? 'has-error' : '' ?>">
                                <input type="text" name="first_name" class="form-control floating-label"
                                       placeholder="First Name" value="<?= $user_details->first_name ?>"/>
                                <small class="text-danger"><?= form_error('first_name') ?></small>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">

                            <div class="form-group <?= (form_error('last_name')) ? 'has-error' : '' ?>">
                                <input type="text" name="last_name" class="form-control floating-label"
                                       placeholder="Last Name"
                                       value="<?= $user_details->last_name ?>"/>
                                <small class="text-danger"><?= form_error('last_name') ?></small>
                            </div>
                        </div>
                    </div>

                    <!--map-->

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div id="map_canvas"></div>
                            <input type="hidden" name="latitude" value="<?= $user_details->latitude ?>">
                            <input type="hidden" name="longitude" value="<?= $user_details->longitude ?>">
                            <input type="hidden" name="google_place_id" value="<?= $user_details->google_place_id ?>">
                            <div class="form-group">
                                <input type="text" name="location" id="location" class="form-control"
                                       placeholder="location"
                                       value="<?= $user_details->formatted_address ?>"/>
                            </div>
                        </div>
                    </div>

                    <!--username and email-->
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <input readonly type="text" name="" class="form-control floating-label"
                                       placeholder="Userame"
                                       value="<?= $user_details->username ?>"/>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-6">

                            <div class="form-group <?= (form_error('email')) ? 'has-error' : '' ?>">
                                <input type="text" name="email" class="form-control floating-label"
                                       placeholder="Email Address"
                                       value="<?= $user_details->email ?>"/>
                                <small class="text-danger"><?= form_error('email') ?></small>
                            </div>
                        </div>
                    </div>

                    <!--Password & Confirm Password-->
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group <?= (form_error('password')) ? 'has-error' : '' ?>">
                                <input type="password" name="password" class="form-control floating-label"
                                       placeholder="Password"/>
                                <small class="text-danger"><?= form_error('password') ?></small>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-6">

                            <div class="form-group <?= (form_error('conpassword')) ? 'has-error' : '' ?>">
                                <input type="password" name="conpassword" class="form-control floating-label"
                                       placeholder="Confirm password"/>
                                <small class="text-danger"><?= form_error('conpassword') ?></small>
                            </div>
                        </div>
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

<script
    src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDHWvuZNsivQxVfbEMS6eilYwqPwlpuJQA&amp;libraries=places"></script>
<script src="<?= base_url('assets/js/jquery.geocomplete.min.js') ?>"></script>
<script type="text/javascript">
    var geocoder = new google.maps.Geocoder();
    var options = {
        map: "#map_canvas",
        location: "<?=($user_details->formatted_address)?$user_details->formatted_address:'Kochi'?>",
        markerOptions: {
            draggable: true
        }
    };
    var map = $("#location");
    map.geocomplete(options)
        .bind("geocode:result", function (event, result) {
            $("input[name=google_place_id]").val(result.place_id);
            $("input[name=latitude]").val(result.geometry.location.lat());
            $("input[name=longitude]").val(result.geometry.location.lng());
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