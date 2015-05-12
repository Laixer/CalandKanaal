@extends('dashboard')

@section('title', 'Measurements')

@section('content')
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Recorded measurements</h3>
                  <div class="box-tools">
                      <button type="button" class="btn btn-sm  btn-success  pull-right">New user</button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Date</th>
                      <th>VecWSM 1</th>
                      <th>VecWSM 2</th>
                      <th>VecWSM 3</th>
                      <th>VecWSM 4</th>
                      <th>VecWSM 5</th>
                      <th>VecWSM 6</th>
                      <th>VecWSM 7</th>
                      <th>VecWSM 8</th>
                      <th>VecWSM 9</th>
                      <th>VecWSM 10</th>
                      <th>VecWSM 11</th>
                      <th>VecWSM 12</th>
                      <th>VecWSM 13</th>
                      <th>VecWSM 14</th>
                      <th>VecWSM 15</th>
                      <th>VecWSM 16</th>
                      <th>Actions</th>
                    </tr>
					<?php foreach($measurements as $measurement) { ?>
                    <tr>
                      <td data-id="<?php echo $measurement->id; ?>"><?php echo $measurement->id; ?></td>
                      <td><?php echo $measurement->recording_date; ?></td>
                      <td><?php echo ($measurement->vecwsm_1 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_2 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_3 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_4 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_5 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_6 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_7 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_8 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_9 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_10 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_11 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_12 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_13 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_14 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_15 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td><?php echo ($measurement->vecwsm_16 ? '<span class="label label-success">On</span>' : '<span class="label label-danger">Off</span>'); ?></td>
                      <td>
							<span class="btn-group">
								<button class="btn btn-block btn-danger btn-xs messdel">Delete</button>
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
			$('.messdel').click(function(e){
				e.preventDefault();
				var $cthis = $(this);
				var $id = $cthis.closest('tr').find('td:first-child').attr('data-id');
				$.post("measurement/delete",{messid: $id, _token:"<?php echo csrf_token(); ?>"}, function(data) {
				 if (data.success)
					$cthis.closest('tr').hide("slow");
				});
			});
		});
	</script>
@stop
