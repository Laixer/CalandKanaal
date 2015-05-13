@extends('dashboard')

@section('title', 'Graph')

@section('content')
          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Line Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">

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

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
                    <label>Date and time range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationtime">
                    </div><!-- /.input group -->
                  </div>
				</div>
			</div>

                  <div id="line-chart" style="height: 300px;"></div>
				 <input type="hidden" id="begintime" />
				 <input type="hidden" id="endtime" />
                </div>
              </div>

			<div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Description</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">

                  <div id="message"></div>
                </div>
              </div>


            </div><!-- /.col -->

          </div><!-- /.row -->
@stop

@section('script')
    <script src="plugins/moment/moment.min.js" type="text/javascript"></script>
    <script src="../../plugins/daterangepicker/new/daterangepicker.js" type="text/javascript"></script>
    <script src="../../plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="../../plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../../plugins/flot/jquery.flot.time.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="../../plugins/flot/jquery.flot.axislabels.js"></script>
	<script type="text/javascript">
		$(function() {
			function drawFlot(begin, end) {
				$.ajax({
					"dataType": 'json',
					"type": "GET",
					"url": "/graph/sensors/" + $('#date').val() +"/" + $('#sensor').val(),
					"success": function (data) {

					var vec1 = [];
					var vec2 = [];
					for(var i=0; i<data.data.length; i++){
						vec1.push([data.data[i][0]*1000, data.data[i][1]])
						vec2.push([data.data[i][0]*1000, data.data[i][2]])
					}

					var line_data1 = {
                    	label: data.columns[1].sTitle,
						data: vec1,
						color: "#3c8dbc"
					};

					var line_data2 = {
						label: data.columns[2].sTitle,
						data: vec2,
						color: "#00c0ef"
					};

					var begintime;
					if (!begin)
						begintime = (new Date($('#begintime').val() * 1000)).getTime();
					else
						begintime = begin.getTime();
					var endtime;
					if (!end)
						endtime = (new Date($('#endtime').val() * 1000)).getTime();
					else
						endtime = end.getTime();

					var tableops = {
						grid: {
							hoverable: true,
							borderColor: "#f3f3f3",
							borderWidth: 1,
							tickColor: "#f3f3f3"
						},
						series: {
							shadowSize: 0,
							lines: { show: true },
							points: { show: true }
						},
						lines: {
							fill: false,
							color: ["#3c8dbc", "#f56954"]
						},
						yaxis: {
							show: true
						},
						xaxis: {
							mode: "time",
							axisLabel: 'Time',
							min: begintime,
							max: endtime
						},
						yaxes: [{
							position: 'left',
							axisLabel: 'm/s2',
						}, {
							position: 'right',
							axisLabel: 'kPa'
						}]
					};
					$.plot("#line-chart", [line_data1, line_data2], tableops);
					$("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
						position: "absolute",
						display: "none",
						opacity: 0.8
					}).appendTo("body");
					$('.yaxisLabel').css('color','#3c8dbc');
					$('.y2axisLabel').css('color','#00c0ef');
					$("#line-chart").bind("plothover", function(event, pos, item){
						if (item) {
							var x = new Date(item.datapoint[0].toFixed(2)*1000).toLocaleTimeString()   , y = item.datapoint[1].toFixed(2);
							$("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y).css({top: item.pageY + 5, left: item.pageX + 5}).fadeIn(200);
						} else {
							$("#line-chart-tooltip").hide();
						}
					});
				}
			});
		}

		$('#date').change(function(){
			$.getJSON("/graph/active_sensors/" + $(this).val(), function(data) {
				$('#sensor').find('option').remove();
				$('#message').html(data.message);

				$('#reservationtime').daterangepicker({
					minDate: new Date(data.begin*1000),
					maxDate: new Date(data.end*1000),
					startDate: new Date(data.begin*1000),
					endDate: new Date(data.end*1000),
					timePicker: true,
					timePickerSeconds: true,
					timePickerIncrement: 1,
					timePicker12Hour: false,
					format: 'DD-MM-YYYY HH:mm:ss'
				}, function(start, end) {
					drawFlot(start.toDate(), end.toDate());
				});

				$('#begintime').val(data.begin);
				$('#endtime').val(data.end);

				var items = [];
				$.each(data.data, function(key, val) {
					$('#sensor').append( "<option id='" + key + "'>" + val + "</option>" );
				});
			});
		});

		$('#sensor').change(function(){
			$('#reservationtime').val('');
			drawFlot();
		});
	});
	</script>
@stop
