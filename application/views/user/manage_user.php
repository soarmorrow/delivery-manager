
<style type="text/css">
    th {
              text-align: center;
    }
    td{
           text-align: left;
    }
</style>
<div class="container">
    <a href="<?= site_url('users/add') ?>" class="btn btn-primary"><i class="fa fa-users"></i> Add user</a>
       <br /><br /><br />
       
    <!-- <div class="row">
        <div class="col-md-offset-1 col-md-10" border="1">
 -->
            <table class="table table-bordered table-hover" width="100%">

                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
                
                    <tr>
                    <?php
                   foreach ($user_details as $user) {
                 ?>
                        <td><?=$user->first_name." ".$user->last_name?></td>
                        <td><?=$user->username?></td>
                        <td><?=$user->email?></td>
                        <td><?= Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans() ?></td>
                        <td>
                            <a href="<?= site_url('users/view/'.$user->id) ?>" title="view"><i class="fa fa-eye"></i></a>
                            <a href="<?= site_url('users/edit/'.$user->id) ?>" title="edit"><i class="fa fa-edit"></i></a>
                            <a href="#" title="delete"><i class="fa fa-trash-o"></i></a>
                        </td>

                    </tr>
                    <?php
                   }
                 ?>
                </table>
                
    <!--     </div>
    </div> -->
</div>