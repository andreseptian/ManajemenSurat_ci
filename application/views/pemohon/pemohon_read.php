<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pemohon Detail</h3>
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
                   <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
                   <tr><td>Jk</td><td><?php echo $jk; ?></td></tr>
                   <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
                   <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
                   <tr><td><a href="<?php echo site_url('pemohon') ?>" class="btn bg-purple">Cancel</a></td></tr>
               </table>
           </div>
       </div>
   </div>
</div>