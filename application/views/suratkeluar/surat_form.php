<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Surat</h3>
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
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Klasifikasi <?php echo form_error('id_klasifikasi') ?></label>
            <input type="text" class="form-control" name="id_klasifikasi" id="id_klasifikasi" placeholder="Id Klasifikasi" value="<?php echo $id_klasifikasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id User <?php echo form_error('id_user') ?></label>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Unit <?php echo form_error('id_unit') ?></label>
            <input type="text" class="form-control" name="id_unit" id="id_unit" placeholder="Id Unit" value="<?php echo $id_unit; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tujuan <?php echo form_error('tujuan') ?></label>
            <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Tujuan" value="<?php echo $tujuan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nomor Surat <?php echo form_error('nomor_surat') ?></label>
            <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" value="<?php echo $nomor_surat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Perihal <?php echo form_error('perihal') ?></label>
            <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal" value="<?php echo $perihal; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tgl Surat <?php echo form_error('tgl_surat') ?></label>
            <input type="text" class="form-control" name="tgl_surat" id="tgl_surat" placeholder="Tgl Surat" value="<?php echo $tgl_surat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">File Surat <?php echo form_error('file_surat') ?></label>
            <input type="text" class="form-control" name="file_surat" id="file_surat" placeholder="File Surat" value="<?php echo $file_surat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Arsip <?php echo form_error('arsip') ?></label>
            <input type="text" class="form-control" name="arsip" id="arsip" placeholder="Arsip" value="<?php echo $arsip; ?>" />
        </div>
	    <input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('suratkeluar') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>