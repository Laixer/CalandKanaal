@extends('dashboard')

@section('title', 'Dashboard')

@section('content')
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">

              <a href="table" class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $measurements; ?></h3>
                  <p>Measurements</p>
                </div>
                <div class="icon">
                  <i class="fa fa-table"></i>
                </div>
                <div href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </div>
              </a>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">

              <a href="graph" class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $sensors; ?></sup></h3>
                  <p>Recorded values</p>
                </div>
                <div class="icon">
                  <i class="fa fa fa-pie-chart"></i>
                </div>
                <div href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </div>
              </a>
            </div><!-- ./col -->
			<?php if (Auth::user()->priv == 'admin') { ?>
            <div class="col-lg-3 col-xs-6">
              <a href="user" class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $users; ?></h3>
                  <p>User accounts</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <div href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </div>
              </a>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <a href="newmeasurement" class="small-box bg-red">
                <div class="inner">
                  <h3>New</h3>
                  <p>Measurement</p>
                </div>
                <div class="icon">
                  <i class="fa fa-edit"></i>
                </div>
                <div href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </div>
              </a>
            </div><!-- ./col -->
		<?php } ?>
          </div><!-- /.row -->
@stop
