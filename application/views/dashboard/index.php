
<style type="text/css">
    th, tr {
              text-align: center;
    }
</style>
<div class="container">
    <a href="<?= site_url('dashboard/add')?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add address</a>
    <br /><br /><br />
    <!-- <div class="row">
        <div class="col-md-offset-1 col-md-10" border="1">
 -->
            <table class="table table-bordered table-hover" width="100%">

                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>PIN</th>
                    <th>Website</th>
                    <th>Phone</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                
                    <tr>
                    <?php
                   foreach ($details as $details) {
                 ?>
                        <td><?=$details->name?></td>
                        <td><?=$details->email?></td>
                        <td><?=$details->address?></td>
                        <td><?=$details->location?></td>
                        <td><?=$details->pin?></td>
                        <td><?=$details->website?></td>
                        <td><?=$details->phone?></td>
                        <td><?=$details->created_at?></td>
                        <td>
                            <a href="#" title="view"><i class="fa fa-eye"></i></a>
                            <a href="#" title="edit"><i class="fa fa-edit"></i></a>
                            <a href="<?=site_url('dashboard/delete/'.$details->id)?>" title="delete"><i class="fa fa-trash-o"></i></a>
                        </td>

                    </tr>
                    <?php
                   }
                 ?>
                </table>
                
    <!--     </div>
    </div> -->
</div>