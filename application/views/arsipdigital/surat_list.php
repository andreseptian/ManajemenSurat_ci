<div class="row">
    <div class="col-xs-12">
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
                    <?php //echo anchor(site_url('arsipdigital/create'),'<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?>
                    
                    <?php echo anchor(site_url('arsipdigital/printdoc'), '<i class="fa fa-print"></i> Print Preview', 'class="btn bg-maroon"'); ?>
                    <?php echo anchor(site_url('arsipdigital/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">

                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right"><form action="<?php echo site_url('arsipdigital/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('arsipdigital'); ?>" class="btn btn-default">Reset</a>
                                <?php
                            }
                            ?>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('arsipdigital/deletebulk');?>" id="formbulk">
            <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
                <tr>
                    <!-- <th style="width: 10px;"><input type="checkbox" name="selectall" /></th> -->
                    <th>No</th>
                    <th>Klasifikasi</th>
                    <th>User</th>
                    <th>Unit</th>
                    <th>Tujuan</th>
                    <th>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Tgl Surat</th>
                    <th>File Surat</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Arsip</th>
                    <th>Action</th>
                    </tr><?php
                    foreach ($arsipdigital_data as $arsipdigital)
                    {
                        ?>
                        <tr>

                          <!-- <td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $arsipdigital->id_surat;?>" />&nbsp;</td> -->

                          <td width="80px"><?php echo ++$start ?></td>
                          <td><?php echo $arsipdigital->nama_klasifikasi ?></td>
                          <td><?php echo $arsipdigital->first_name ?></td>
                          <td><?php echo $arsipdigital->nama_unit ?></td>
                          <td><?php echo $arsipdigital->tujuan ?></td>
                          <td><?php echo $arsipdigital->nomor_surat ?></td>
                          <td><?php echo $arsipdigital->perihal ?></td>
                          <td><?php echo $arsipdigital->tgl_surat ?></td>
                          <td><?php echo $arsipdigital->file_surat ?></td>
                          <td><?php echo $arsipdigital->keterangan ?></td>
                          <?php $status = "-";
                          if($arsipdigital->status == "0"){
                            $status = "Menunggu Persetujuan";
                        }else if($arsipdigital->status == "1"){
                            $status = "Sudah di ACC Unit";
                        }else if($arsipdigital->status == "x"){
                            $status = "Reject";
                        }
                        ?>
                        <td><?php echo $status ?></td>
                        <?php 
                        if($arsipdigital->arsip == "1"){
                            $arsip = "Diarsipkan";
                        }else if($arsipdigital->arsip == "0" && $status == "Reject"){
                            $arsip = "Di Tolak";
                        }else{
                            $arsip = "Belum Diarsipkan";
                        }
                        ?>

                        <td><?php echo $arsip ?></td>
                        <td style="text-align:center" width="200px">
                            <?php 
                            echo anchor(site_url('arsipdigital/read/'.$arsipdigital->id_surat),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'); 
				// echo ' '; 
				// echo anchor(site_url('arsipdigital/update/'.$arsipdigital->id_surat),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				// echo ' '; 
				// echo anchor(site_url('arsipdigital/delete/'.$arsipdigital->id_surat),' <i class="fa fa-trash"></i>','class="btn btn-xs btn-danger" onclick="javasciprt: return confirmdelete(\'arsipdigital/delete/'.$arsipdigital->id_surat.'\')"  data-toggle="tooltip" title="Delete" '); 
                            ?>
                            <a href="<?= site_url('arsipdigital/download/'.$arsipdigital->id_surat);?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Download Surat"><i class="fa fa-download"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12">
                    <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>  --><a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
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
</div>
</div>