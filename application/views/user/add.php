<style type="text/css">
    .btn-group .btn {
        width: 50%;
    }

    .panel {
        text-align: center;
        color:;
    }

    #map_canvas {
        width: 100%;
        height: 350px;
    }

</style>
<body>
<br/><br/>

<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add user</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?= current_url() ?>">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group <?= (form_error('first_name')) ? 'has-error' : '' ?>">
                                    <input type="text" name="first_name" id="first_name"
                                           class="form-control input-sm floating-label" placeholder="First Name"
                                           value="<?= set_value('first_name') ?>">
                                    <small class="text-danger"><?= form_error('first_name') ?></small>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group <?= (form_error('last_name')) ? 'has-error' : '' ?>">
                                    <input type="text" name="last_name" id="last_name"
                                           class="form-control input-sm floating-label" placeholder="Last Name"
                                           value="<?= set_value('last_name') ?>">
                                    <small class="text-danger"><?= form_error('last_name') ?></small>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class=" col-sm-12 col-md-12">
                                <div id="map_canvas"></div>
                                <input type="hidden" name="latitude" value="">
                                <input type="hidden" name="longitude" value="">
                                <input type="hidden" name="google_place_id" value="">
                                <div class="form-group <?= (form_error('location')) ? 'has-error' : '' ?>">
                                    <input type="text" name="location" id="location"
                                           class="form-control input-sm" placeholder="User name"
                                           value="<?= set_value('location') ?>">
                                    <small class="text-danger"><?= form_error('location') ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group <?= (form_error('username')) ? 'has-error' : '' ?>">
                                    <input type="text" name="username" id="username"
                                           class="form-control input-sm floating-label" placeholder="User name"
                                           value="<?= set_value('username') ?>">
                                    <small class="text-danger"><?= form_error('username') ?></small>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">

                                <div class="form-group <?= (form_error('email')) ? 'has-error' : '' ?>">
                                    <input type="text" name="email" id="email" class="form-control input-sm floating-label"
                                           placeholder="Email Address" value="<?= set_value('email') ?>">
                                    <small class="text-danger"><?= form_error('email') ?></small>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group <?= (form_error('password')) ? 'has-error' : '' ?>">
                                    <input type="password" name="password" id="password"
                                           class="form-control input-sm floating-label" placeholder="Password">
                                    <small class="text-danger"><?= form_error('password') ?></small>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group <?= (form_error('password_confirmation')) ? 'has-error' : '' ?>">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control input-sm floating-label" placeholder="Confirm Password">
                                    <small class="text-danger"><?= form_error('password_confirmation') ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="btn-group btn-block">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Create</button>
                                <a href="javascript:history.go(-1)" class="btn btn-primary"><i class="fa fa-times"></i>
                                    cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAK3S08d1fhYGMpyylmwf_iwPNfjhkbyaU&amp;libraries=places"></script>
<script src="<?= base_url('assets/js/jquery.geocomplete.min.js') ?>"></script>
<script type="text/javascript">
    var geocoder = new google.maps.Geocoder();
    var options = {
        map: "#map_canvas",
        location: "Kochi",
        markerOptions: {
            draggable: true
        }
    };
    var map = $("#location");
    map.geocomplete(options)
        .bind("geocode:result", function (event, result) {
            $("input[name=latitude]").val(result.geometry.location.lat());
            $("input[name=google_place_id]").val(result.place_id);
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