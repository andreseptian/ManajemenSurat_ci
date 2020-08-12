<div class="row">
    <div class="col-xs-12 col-md-4">
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                 <div class="form-group">
                    <label for="int">Klasifikasi <?php echo form_error('id_klasifikasi') ?></label>
                    <select class="form-control selectpicker" data-live-search="true" name="id_klasifikasi" id="id_klasifikasi" >
                        <option value="">-- Pilih Klasifikasi --</option>
                        <?php foreach ($klasifikasi as $key => $value) : ?>
                            <option <?= ($value->id_klasifikasi == $id_klasifikasi)?"selected":"";?> value="<?= $value->id_klasifikasi;?>"><?= $value->nama_klasifikasi;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <!-- <label for="int">Id User <?php echo form_error('id_user') ?></label> -->
                    <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $this->session->user_id; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Unit <?php echo form_error('id_unit') ?></label>
                    <select class="form-control selectpicker" data-live-search="true" name="id_unit" id="id_unit" >
                        <option value="">-- Pilih Klasifikasi --</option>
                        <?php foreach ($unit as $key => $value) : ?>
                            <option <?= ($value->id_unit == $id_unit)?"selected":"";?> value="<?= $value->id_unit;?>"><?= $value->nama_unit;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="varchar">Tujuan <?php echo form_error('tujuan') ?></label>
                    <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Tujuan" value="<?php echo $tujuan; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Nomor Surat <?php echo form_error('nomor_surat') ?></label>
                    <input type="text" class="form-control" name="" id="nomor_surat" placeholder="Nomor Surat" value="<?php echo $nomor_surat; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Nomor Surat Generate <?php echo form_error('nomor_surat') ?></label>
                    <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" placeholder="Nomor Surat" value="<?php echo $last_id; ?>" />
                </div>

           

                <div class="form-group">
                    <label for="varchar">Perihal <?php echo form_error('perihal') ?></label>
                    <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal" value="<?php echo $perihal; ?>" />
                </div>
                <div class="form-group">
                    <label for="date">Tgl Surat <?php echo form_error('tgl_surat') ?></label>
                    <input type="date" class="form-control" name="tgl_surat" id="tgl_surat" placeholder="Tgl Surat" value="<?php echo $tgl_surat; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">File Surat <?php echo form_error('file_surat') ?></label>
                    <?php if($file_surat != ""):?>
                        <span> File Jangan di isi jika tidak akan di edit</span>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12">
                                File Surat :<a href="<?= base_url('assets/upload/surat/'.$file_surat);?>">Lihat Surat</a>
                            </div>
                        </div>
                    <?php endif;?>
                    <input type="file" class="form-control" name="file_surat" id="file_surat" placeholder="File Surat" value="" />
                </div>
                <div class="form-group">
                    <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
                    <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                </div>
                <div class="form-group">
                    <!-- <label for="varchar">Status <?php echo form_error('status') ?></label> -->
                    <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                </div>

                <div class="form-group">
                    <!-- <label for="int">Arsip <?php echo form_error('arsip') ?></label> -->
                    <input type="hidden" class="form-control" name="arsip" id="arsip" placeholder="Arsip" value="<?php echo $arsip; ?>" />
                </div>
                <input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>" /> 
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url('suratpemohon') ?>" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>

    </div>
    <div class="col-xs-12 col-md-8">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Surat</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
                  <i class="fa fa-refresh"></i></button>
              </div>
          </div>

          <div class="box-body">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">

                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                 <form action="<?php echo site_url('suratpemohon/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('suratpemohon'); ?>" class="btn btn-default">Reset</a>
                                <?php
                            }
                            ?>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('suratpemohon/deletebulk');?>" id="formbulk">
            <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
                <tr>
                    <!-- <th style="width: 10px;"><input type="checkbox" name="selectall" /></th> -->
                    <th>No</th>
                    <th>Klasifikasi</th>
                    <th>User</th>
                    <th>Unit</th>
                    <th>Tujuan</th>
                    <th nowrap>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th nowrap>File Surat</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                    </tr><?php
                    foreach ($suratpemohon_data as $suratpemohon)
                    {
                        ?>
                        <tr>

                          <!-- <td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $suratpemohon->id_surat;?>" />&nbsp;</td> -->

                          <td width="80px"><?php echo ++$start ?></td>
                          <td><?php echo $suratpemohon->nama_klasifikasi ?></td>
                          <td><?php echo $suratpemohon->first_name ?></td>
                          <td><?php echo $suratpemohon->nama_unit ?></td>
                          <td><?php echo $suratpemohon->tujuan ?></td>
                          <td><?php echo $suratpemohon->nomor_surat ?></td>
                          <td><?php echo $suratpemohon->perihal ?></td>
                          <td><?php echo $suratpemohon->tgl_surat ?></td>
                          <td><a href="<?= base_url('assets/uploads/surat/'.$suratpemohon->file_surat) ?>" target="_blank">Lihat Surat</a></td>
                          <td><?php echo $suratpemohon->keterangan ?></td>
                       
                          <td style="text-align:center" width="200px">
                            <?php 
                            echo anchor(site_url('suratpemohon/update/'.$suratpemohon->id_surat),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning"  data-toggle="tooltip" title="edit"'); 
                            // echo ' '; 
                            // echo anchor(site_url('suratpemohon/update/'.$suratpemohon->id_surat),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
                            // echo ' '; 
                            // echo anchor(site_url('suratpemohon/delete/'.$suratpemohon->id_surat),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'suratpemohon/delete/'.$suratpemohon->id_surat.'\')"  data-toggle="tooltip" title="Delete" '); 
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <div class="row" style="margin-bottom: 10px;">
                 <div class="col-md-12">
                    <!--<button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>  --><a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>