<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Surat Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
	    <?php
                  if($status == "0"){
                    $status = "Menunggu Persetujuan";
                  }else if($status == "1"){
                    $status = "Sudah di ACC Unit";
                  }else if($status == "x"){
                    $status = "Reject";
                  }
                  ?>
                  <td><?php echo $status ?></td>
                  <?php 
                  if($arsip == "1"){
                    $arsip = "Diarsipkan";
                  }else if($arsip == "0" && $status == "Reject"){
                    $arsip = "Di Tolak";
                  }else{
                    $arsip = "Belum Diarsipkan";
                  }
                  ?>
                    <tr><td>Klasifikasi</td><td><?php echo $nama_klasifikasi; ?></td></tr>
                   <tr><td>Pemohon</td><td><?php echo $pemohon; ?></td></tr>
                   <tr><td>Unit</td><td><?php echo $nama_unit; ?></td></tr>
	    <tr><td>Tujuan</td><td><?php echo $tujuan; ?></td></tr>
	    <tr><td>Nomor Surat</td><td><?php echo $nomor_surat; ?></td></tr>
	    <tr><td>Perihal</td><td><?php echo $perihal; ?></td></tr>
	    <tr><td>Tgl Surat</td><td><?php echo $tgl_surat; ?></td></tr>
	    <tr><td>File Surat</td><td><?php echo $file_surat; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Arsip</td><td><?php echo $arsip; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('suratmasuktu') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Surat Detail</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                  <i class="fa fa-refresh"></i></button>
              </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <iframe width="100%" style="min-height: 800px" src="<?= base_url('assets/uploads/surat/'.$file_surat);?>"></iframe>
          </div>
      </div>
  </div>
</div>