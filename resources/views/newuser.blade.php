@extends('dashboard')

@section('content')
		<div class="row">
            <!-- left column -->
            <div class="col-xs-12">
              <!-- general form elements -->

				 <?php if (Session::has('success')) { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ^ </button>
                    <h4>    <i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo Session::get('success'); ?>
                  </div>
                <?php } ?>



              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add new user</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="POST">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">First name</label>
                      <input type="text" class="form-control" name="firstname" id="exampleInputEmail1" placeholder="First name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Last name</label>
                      <input type="text" class="form-control" name="lastname" id="exampleInputEmail1" placeholder="Last name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>Group</label>
                      <select name="priv" class="form-control">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
@stop
