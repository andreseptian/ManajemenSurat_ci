<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Surat</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Klasifikasi</th>
		<th>Id User</th>
		<th>Id Unit</th>
		<th>Tujuan</th>
		<th>Nomor Surat</th>
		<th>Perihal</th>
		<th>Tgl Surat</th>
		<th>File Surat</th>
		<th>Keterangan</th>
		<th>Status</th>
		<!-- <th>Tipe</th> -->
		<!-- <th>Arsip</th> -->
		
            </tr><?php
            foreach ($suratpemohon_data as $suratpemohon)
            {

                          $status = $suratpemohon->status;
                            if($suratpemohon->status == "0"){
                                $status = "Menunggu Persetujuan";
                            }else if($suratpemohon->status == "1"){
                                $status = "Sudah di ACC Unit";
                            }else if($suratpemohon->status == "x"){
                                $status = "Reject";
                            }
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $suratpemohon->id_klasifikasi ?></td>
		      <td><?php echo $suratpemohon->id_user ?></td>
		      <td><?php echo $suratpemohon->id_unit ?></td>
		      <td><?php echo $suratpemohon->tujuan ?></td>
		      <td><?php echo $suratpemohon->nomor_surat ?></td>
		      <td><?php echo $suratpemohon->perihal ?></td>
		      <td><?php echo $suratpemohon->tgl_surat ?></td>
		      <td><?php echo $suratpemohon->file_surat ?></td>
		      <td><?php echo $suratpemohon->keterangan ?></td>
		      <td><?php echo $status ?></td>
		      <!-- <td><?php echo $suratpemohon->tipe ?></td> -->
		      <!-- <td><?php echo $suratpemohon->arsip ?></td>	 -->
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>