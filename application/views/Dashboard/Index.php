
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fas fa-user-edit"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?= $titlewidget1;?></span>
              <span class="info-box-number"><?= $contentwidget1;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fab fa-black-tie"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?= $titlewidget2;?></span>
              <span class="info-box-number"><?= $contentwidget2;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fas fa-inbox"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?= $titlewidget3;?></span>
              <span class="info-box-number"><?= $contentwidget3;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fas fa-file-export"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?= $titlewidget4;?></span>
              <span class="info-box-number"><?= $contentwidget4;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <?php if($sebagai == "pemohon"):?>
        <div class="col-md-8 col-xs-12">
        <?php else: ?>
        <div class="col-md-12 col-xs-12">
        <?php endif;?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Surat Masuk & Keluar</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body" style="min-height: 150px">
              <div class="chart">
                <canvas id="barChart" style="height:270px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
        <?php if($sebagai == "pemohon"):?>
        <div class="col-md-4 col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Surat Masuk Terbaru</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body" style="height:295px">
              <table class="table table-bordered table-striped">
                <thead>
                  <th>No</th>
                  <th>Nomor</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                </thead>
                <tbody>
                   <?php $no = 0; foreach ($notifikasi as $key => $value) :?>
                   <?php 
                   $status = "";
                   if($value->arsip == '1'){
                    $status = "Diarsipkan";
                   }else if($value->status == '0'){
                    $status = "Menunggu";

                   }else if($value->status == '1'){
                    $status = "ACC";

                   }else{
                    $status = $value->status;
                   }
                   ?>
                    <tr>
                      <td><?= $no++;?></td>
                      <td><?= $value->nomor_surat;?></td>
                      <td><?= $status;?></td>
                      <td><?= $value->keterangan;?></td>
                    </tr>
                    <?php endforeach;?>
                  
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
      <?php endif;?>
