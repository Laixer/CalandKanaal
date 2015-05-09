@extends('dashboard')

@section('content')
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
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
                    <div class="checkbox">
                      <label>
                        <input name="val_1_0" type="checkbox" checked> VecWSM 1/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_1_1" type="checkbox" checked> VecWSM 1/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_2_0" type="checkbox" checked> VecWSM 2/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_2_1" type="checkbox" checked> VecWSM 2/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_3_0" type="checkbox" checked> VecWSM 3/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_3_1" type="checkbox" checked> VecWSM 3/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_4_0" type="checkbox" checked> VecWSM 4/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_4_1" type="checkbox" checked> VecWSM 4/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_5_0" type="checkbox" checked> VecWSM 5/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_5_1" type="checkbox" checked> VecWSM 5/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_6_0" type="checkbox" checked> VecWSM 6/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_6_1" type="checkbox" checked> VecWSM 6/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_7_0" type="checkbox" checked> VecWSM 7/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_7_1" type="checkbox" checked> VecWSM 7/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_8_0" type="checkbox" checked> VecWSM 8/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_8_1" type="checkbox" checked> VecWSM 8/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_9_0" type="checkbox" checked> VecWSM 9/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_9_1" type="checkbox" checked> VecWSM 9/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_10_0" type="checkbox" checked> VecWSM 10/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_10_1" type="checkbox" checked> VecWSM 10/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_11_0" type="checkbox" checked> VecWSM 11/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_11_1" type="checkbox" checked> VecWSM 11/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_12_0" type="checkbox" checked> VecWSM 12/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_12_1" type="checkbox" checked> VecWSM 12/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_13_0" type="checkbox" checked> VecWSM 13/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_13_1" type="checkbox" checked> VecWSM 13/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_14_0" type="checkbox" checked> VecWSM 14/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_14_1" type="checkbox" checked> VecWSM 14/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_15_0" type="checkbox" checked> VecWSM 15/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_15_1" type="checkbox" checked> VecWSM 15/1
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_16_0" type="checkbox" checked> VecWSM 16/0
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="val_16_1" type="checkbox" checked> VecWSM 16/1
                      </label>
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
<script>
      $(document).ready(function(){
        $("#compose-textarea").wysihtml5();
      });
    </script>
@stop
