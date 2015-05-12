@extends('dashboard')

@section('title', 'User Profile')

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

			<?php if (Session::has('error')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ^ </button>
                    <h4><i class="icon fa fa-ban"></i> Error</h4>
                    <?php echo Session::get('error'); ?>
                  </div>
                <?php } ?>

              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">User profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="POST">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm</label>
                      <input type="password" class="form-control" name="password2" id="exampleInputPassword2" placeholder="Password">
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
