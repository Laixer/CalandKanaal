@extends('dashboard')

@section('title', 'Table')

@section('content')
		<div class="row">
			<div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Sensor overview</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			<div class="row">
			<div class="col-xs-6">
				<form role="form">
					<div class="form-group">
                      <label>Date</label>
                      <select id="date" class="form-control">
						<option selected>(Select a date)</option>
						<?php foreach($list as $key => $date){
							echo "<option value=\"" . $key . "\">" . $date . "</option>";
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
<!-- DATA TABES SCRIPT -->
    <!--<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>-->
	<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
    $.ajax({
        "dataType": 'json',
        "type": "GET",
        "url": "/table/sensors/2/" + $('#sensor').val(),
        "success": function (dataStr) {
            $('#example2').dataTable({
                "aaData": dataStr.data,
                "aoColumns": dataStr.columns
            });
        }
    });
      });
	$(function () {
	 $('#date').change(function(){
		$.getJSON("/table/active_sensors/" + $(this).val(), function(data) {
		$('#sensor').find('option').remove();
		  var items = [];
			  $.each(data, function( key, val ) {
			   $('#sensor').append( "<option id='" + key + "'>" + val + "</option>" );
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
        "url": "/table/sensors/" + $('#date').val() +"/" + $('#sensor').val(),
        "success": function (dataStr) {
			if (table) {
				table.ajax.url('/table/sensors/' + $('#date').val() + '/' + $('#sensor').val()).load();
			} else {
            table = $('#example2').DataTable({
                "aaData": dataStr.data,
                "aoColumns": dataStr.columns
            });
			}
        }
    });



});

 });

    </script>
@stop
