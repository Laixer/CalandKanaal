@extends('dashboard')

@section('title', 'New Measurement')

@section('content')
          <div class="row">
            <!-- left column -->
            <div class="col-xs-12">
              <!-- general form elements -->

				<?php if (Session::has('success')) { ?>
				<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo Session::get('success'); ?>
                  </div>
				<?php } ?>

				<?php if (Session::has('error')) { ?>
				<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error</h4>
                    <?php echo Session::get('error'); ?>
                  </div>
				<?php } ?>

              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">New Measurement <?php echo Session::get('error'); ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="" role="form" name="frm-measurement" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <div class="box-body">

				  <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control input-lg" placeholder="Name">
                    </div>

                  <div class="form-group">
                    <label for="compose-textarea">Description</label>
                    <textarea name="message" id="compose-textarea" class="form-control" style="height: 300px">
                      <h1><u>Project description</u></h1>
                      <h4>Subheading</h4>
					<p>Some text ... </p>
                      <ul>
                        <li>List </li>
                        <li>Item </li>
                      </ul>
                      <p>Note</p>
                    </textarea>
                  </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input name="ascfile" type="file" id="exampleInputFile">
                      <p class="help-block">Upload the .asc file</p>
                    </div>
					<div class="row margin"><div class="col-sm-6">
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_1" type="checkbox" checked>&nbsp;&nbsp;VecWSM 1</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_2" type="checkbox" checked>&nbsp;&nbsp;VecWSM 2</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_3" type="checkbox" checked>&nbsp;&nbsp;VecWSM 3</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_4" type="checkbox" checked>&nbsp;&nbsp;VecWSM 4</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_5" type="checkbox" checked>&nbsp;&nbsp;VecWSM 5</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_6" type="checkbox" checked>&nbsp;&nbsp;VecWSM 6</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_7" type="checkbox" checked>&nbsp;&nbsp;VecWSM 7</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_8" type="checkbox" checked>&nbsp;&nbsp;VecWSM 8</span>
                        <input type="text" class="form-control" />
                      </div>
				</div>
				<div class="col-sm-6">
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_9" type="checkbox" checked>&nbsp;&nbsp;VecWSM 9</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_10" type="checkbox" checked>&nbsp;&nbsp;VecWSM 10</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_11" type="checkbox" checked>&nbsp;&nbsp;VecWSM 11</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_12" type="checkbox" checked>&nbsp;&nbsp;VecWSM 12</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_13" type="checkbox" checked>&nbsp;&nbsp;VecWSM 13</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_14" type="checkbox" checked>&nbsp;&nbsp;VecWSM 15</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_15" type="checkbox" checked>&nbsp;&nbsp;VecWSM 15</span>
                        <input type="text" class="form-control" />
                      </div>
					<br />
					 <div class="input-group">
                        <span class="input-group-addon">
                          <input name="val_16" type="checkbox" checked>&nbsp;&nbsp;VecWSM 16</span>
                        <input type="text" class="form-control" />
                      </div>
				</div>
				</div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
@stop

@section('script')
	<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$("#compose-textarea").wysihtml5();
		});
	</script>
@stop
