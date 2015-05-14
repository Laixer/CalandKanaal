@extends('dashboard')

@section('title', 'Table')

@section('content')
		<div class="row">
			<div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header with-border">
				 <i class="fa fa-table"></i>
                  <h3 class="box-title">Sensor overview</h3>
					<div class="box-tools">
                      <div class="btn-group">
                          <button id="excsv" type="button" class="btn btn-default btn-sm disabled">Export CSV</button>
                          <button id="exasc" type="button" class="btn btn-default btn-sm disabled">Export ASC</button>
                        </div>
					</div>
                </div><!-- /.box-header -->
                <div class="box-body">
			<div class="row">
			<div class="col-xs-6">
				<form role="form">
					<div class="form-group">
                      <label>Date</label>
                      <select id="date" class="form-control">
						<option selected>(Select a date)</option>
						<?php foreach($list as $row){
							if ($row['name'])
								echo "<option value=\"" . $row['id'] . "\">" . $row['recording_date'] . " (" . $row['name'] . ")" .  "</option>";
							else
								echo "<option value=\"" . $row['id'] . "\">" . $row['recording_date'] .  "</option>";
						} ?>
                      </select>
                    </div>
					<div class="form-group">
                      <label>Sensors</label>
                      <select id="sensor" class="form-control">
                        <option disabled>(Select a date)</option>
                      </select>
                    </div>
				</form>
				</div></div>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Measurement Time</th>
                        <th>Sensor 0</th>
                        <th>Sensor 1</th>
                      </tr>
                    </thead>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
@stop

@section('script')
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
	$(function () {
	 $('#date').change(function(){
		$.getJSON("/table/active_sensors/" + $(this).val(), function(data) {
		$('#sensor').find('option').remove();
		$('#excsv').removeClass('disabled');
		$('#exasc').removeClass('disabled');
		var items = [];
			$.each(data, function(key, val) {
				if (val[1])
					$('#sensor').append("<option id='" + key + "' data-id='" + val[2] + "'>" + val[0] + " (" + val[1] + ")" + "</option>");
				else
					$('#sensor').append("<option id='" + key + "' data-id='" + val[2] + "'>" + val[0] + "</option>");
			});
		});
	  });
	});
var table;
$(function () {
 $('#sensor').change(function(){
    $.ajax({
        "dataType": 'json',
        "type": "GET",
        "url": "/table/sensors/" + $('#date').val() +"/" + $('#sensor :selected').attr('data-id'),
        "success": function (dataStr) {
			if (table) {
				table.ajax.url('/table/sensors/' + $('#date').val() + '/' + $('#sensor :selected').attr('data-id')).load();
			} else {
            table = $('#example2').DataTable({
                "aaData": dataStr.data,
                "aoColumns": dataStr.columns
            });
			}
        }
    });
});

$('#excsv').click(function(e){
	e.preventDefault();
	window.open('/table/exportcsv/' + $('#date').val(), 'Export CSV');
});

$('#exasc').click(function(e){
	e.preventDefault();
	window.open('/table/exportasc/' + $('#date').val(), 'Export CSV');
});

 });

    </script>
@stop
