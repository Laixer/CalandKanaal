@extends('dashboard')

@section('title', 'Users')

@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User accounts</h3>
                  <div class="box-tools">
                      <a href="newuser" class="btn btn-sm  btn-success  pull-right">New user</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
					<?php foreach($users as $user) { ?>
                    <tr>
                      <td data-id="<?php echo $user->id; ?>"><?php echo $user->id; ?></td>
                      <td><?php echo $user->firstname . ' '. $user->lastname; ?></td>
                      <td><?php echo $user->email; ?></td>
                      <td><?php echo ucfirst($user->priv); ?></td>
					  <?php if ($user->active) { ?>
                      <td><span class="label label-success">Active</span></td>
					  <?php } else { ?>
					  <td><span class="label label-danger">Disabled</span></td>
					  <?php } ?>
                      <td>
							<?php if ($user->active) { ?>
							<span class="btn-group">
								<button class="btn btn-block btn-danger btn-xs userdis">Disable</button>
							</span>
							<?php }else{ ?>
                            <span class="btn-group">
                                <button class="btn btn-block btn-success btn-xs useren">Enable</button>
                            </span>
							<?php } ?>
							<span class="btn-group">
								<button class="btn btn-block btn-info btn-xs reset">Reset password</button>
							</span>
							<span class="btn-group">
								<button class="btn btn-block btn-danger btn-xs userdel">Delete</button>
							</span>
					  </td>
                    </tr>
					<?php } ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$('.userdel').click(function(e){
				e.preventDefault();
				var $cthis = $(this);
				var $id = $cthis.closest('tr').find('td:first-child').attr('data-id');
				$.post("user/delete",{userid: $id, _token:"<?php echo csrf_token(); ?>"}, function(data) {
				 if (data.success)
					$cthis.closest('tr').hide("slow");
				});
			});
			$('.userdis').click(function(e){
                e.preventDefault();
                var $cthis = $(this);
                var $id = $cthis.closest('tr').find('td:first-child').attr('data-id');
                $.post("user/disable",{userid: $id, _token:"<?php echo csrf_token(); ?>"}, function(data) {
                 if (data.success) {
						$cthis.removeClass('btn-danger').addClass('btn-success').text('Enable');
					}
                });
            });
            $('.useren').click(function(e){
                e.preventDefault();
                var $cthis = $(this);
                var $id = $cthis.closest('tr').find('td:first-child').attr('data-id');
                $.post("user/enable",{userid: $id, _token:"<?php echo csrf_token(); ?>"}, function(data) {
                 if (data.success) {
                        $cthis.removeClass('btn-success').addClass('btn-danger').text('Disable');
                    }
                });
            });
            $('.reset').click(function(e){
                e.preventDefault();
                var $cthis = $(this);
                var $id = $cthis.closest('tr').find('td:first-child').attr('data-id');
                $.post("user/resetpassword",{userid: $id, _token:"<?php echo csrf_token(); ?>"}, function(data) {
                 if (data.success) {
                        //$cthis.removeClass('btn-success').addClass('btn-danger').text('Disable');
						alert("Password reset to: ABC@123");
                    }
                });
            });
		});
	</script>
@stop
