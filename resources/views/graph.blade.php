@extends('dashboard')

@section('title', 'Graph')

@section('content')
          <div class="row">

            <div class="col-xs-12">

              <div class="box box-success">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Line Chart</h3>
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
                      <?php if (Auth::user()->priv == 'admin') { ?>
     <span class="input-group-btn">
        <button id="split" class="btn btn-default disabled" type="button">Save</button>
      </span>
      				<?php } ?>
                    </div><!-- /.input group -->
                  </div>
				</div>
			</div>

                  <div id="line-chart" style="height: 300px;text-align: center;"></div>
				 <input type="hidden" id="begintime" />
				 <input type="hidden" id="endtime" />
                </div>
              </div>

			<?php if (Auth::user()->priv == 'admin') { ?>
			<form action="" role="form" name="frm-message" method="POST">
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<input type="hidden" name="messid" id="messid" />
				<div class="box box-success">
					<div class="box-header with-border">
						<i class="fa fa-comment-o"></i>
						<h3 class="box-title">Description</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<textarea name="message" id="compose-textarea" class="form-control" style="height: 300px"></textarea>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
			<?php } else {?>
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-comment-o"></i>
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
			<?php } ?>

		</div>
	</div>
@stop

@section('script')
    <script src="plugins/moment/moment.min.js" type="text/javascript"></script>
    <script src="../../plugins/daterangepicker/new/daterangepicker.js" type="text/javascript"></script>
    <script src="../../plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="../../plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../../plugins/flot/jquery.flot.time.min.js" type="text/javascript"></script>
	<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="../../plugins/flot/jquery.flot.axislabels.js"></script>
	<script type="text/javascript">
		var _begin;
		var _end;
		$(function() {
			function drawFlot(begin, end) {
				$('#line-chart').append('<img src="/dist/img/hex-loader.gif" />');
				$.ajax({
					"dataType": 'json',
					"type": "GET",
					"url": "/graph/sensors/" + $('#date').val() +"/" + $('#sensor :selected').attr('data-id'),
					"success": function (data) {

					var vec1 = [];
					var vec2 = [];
					var vec3 = [];
					for(var i=0; i<data.data.length; i++){
						vec1.push([data.data[i][0]*1000, data.data[i][1]]);
						vec2.push([data.data[i][0]*1000, data.data[i][2]]);
					}

					var line_data1 = {
						label: "Versnelling (m/s<sup>2</sup>)",
						data: vec1,
						color: "#3c8dbc"
					};

					var line_data2 = {
						label: "Waterspanning (kPa)",
						data: vec2,
						color: "#00c0ef"
					};

					var line_data3 = {
						data: vec3,
						color: "#ff0000"
					};

					var begintime;
					if (!begin)
						if (data.begin) {
							begintime = data.begin;
							console.log('begin '+begintime);
						}
						else
							begintime = (new Date($('#begintime').val() * 1000)).getTime();
					else
						begintime = begin.getTime();
					var endtime;
					if (!end)
						if (data.end) {
							endtime = data.end;
							console.log('end '+endtime);
						}
						else
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
							color: ["#3c8dbc", "#f56954", "#ff0000"]
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
			var $id = $(this).val();
			$.getJSON("/graph/active_sensors/" + $(this).val(), function(data) {
				$('#sensor').find('option').remove();
				<?php if (Auth::user()->priv == 'admin') { ?>
				$('#messid').val($id);
				$('#compose-textarea').data("wysihtml5").editor.setValue(data.message);
				<?php } else { ?>
				$('#message').html(data.message);
				<?php } ?>

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
					$('#split').removeClass('disabled');
					_begin = start.toDate();
					_end = end.toDate();
				});

				$('#begintime').val(data.begin);
				$('#endtime').val(data.end);

				var items = [];
				$.each(data.data, function(key, val) {
				if (val[1])
					$('#sensor').append("<option id='" + key + "' data-id='" + val[2] + "'>" + val[0] + " (" + val[1] + ")" + "</option>");
				else
					$('#sensor').append("<option id='" + key + "' data-id='" + val[2] + "'>" + val[0] + "</option>");
				});
			});
 		});

		$('#sensor').change(function(){
			$('#reservationtime').val('');
			drawFlot();
		});

		<?php if (Auth::user()->priv == 'admin') { ?>
		$("#compose-textarea").wysihtml5();
		<?php } ?>

		$('#split').click(function(e){
			e.preventDefault();
			$.post("/graph/split", {
				messid: $('#date').val(),
				sensorid: $('#sensor :selected').attr('data-id'),
				begin: _begin.getTime(),
				end: _end.getTime(),
				_token:"<?php echo csrf_token(); ?>"
			});
		});
	});
	</script>
@stop
