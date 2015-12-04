
<style type="text/css">
    th {
              text-align: center;
    }
    td{
           text-align: left;
    }

     .input-group .input-group-btn .btn.search{
   border-radius: 0;
   padding: 6px 9px;
}
.input-group{
    position: relative;
    top: 12px;
}
.input-group-btn {
    font-size: 0;
    position: absolute;
    right: 27px;
    top: 1px;
    white-space: nowrap;
}
</style>
<div class="container">
   
    <!-- search -->
  <div class="row">
      <div class="col-md-6">
       <a href="<?= site_url('users/add') ?>" class="btn btn-primary"><i class="fa fa-users"></i> Add user</a>
   </div>
   <div class="col-md-6">
       <form method="get" action="<?= site_url('users') ?>">
       <div class="input-group pull-right">
           <input type="text" name="search" value="<?=$this->input->get('search')?>" class="form-control" placeholder="Search here..." />
          <span class="input-group-btn"><button class="btn btn-primary search btn-flat" type="submit"><i class="fa fa-search"></i></button></span>
      </div>
      </form>
       <div class="clearfix"></div>
   </div>
  </div>

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
                        <td><?=$user->name?></td>
                        <td><?=$user->username?></td>
                        <td><?=$user->email?></td>
                        <td><?= Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->diffForHumans() ?></td>
                        <td>
                            <a href="<?= site_url('users/view/'.$user->id) ?>" title="view"><i class="fa fa-eye"></i></a>
                            <a href="<?= site_url('users/edit/'.$user->id) ?>" title="edit"><i class="fa fa-edit"></i></a>
                            <a href="<?= site_url('users/delete/'.$user->id) ?>" title="delete"><i class="fa fa-trash-o"></i></a>
                        </td>

                    </tr>
                    <?php
                   }
                 ?>
                </table>
                <?php echo $this->pagination->create_links();?>
    <!--     </div>
    </div> -->
</div>