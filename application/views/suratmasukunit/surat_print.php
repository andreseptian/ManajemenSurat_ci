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
		<th>Arsip</th>
		
            </tr><?php
            foreach ($suratmasukunit_data as $suratmasukunit)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $suratmasukunit->id_klasifikasi ?></td>
		      <td><?php echo $suratmasukunit->id_user ?></td>
		      <td><?php echo $suratmasukunit->id_unit ?></td>
		      <td><?php echo $suratmasukunit->tujuan ?></td>
		      <td><?php echo $suratmasukunit->nomor_surat ?></td>
		      <td><?php echo $suratmasukunit->perihal ?></td>
		      <td><?php echo $suratmasukunit->tgl_surat ?></td>
		      <td><?php echo $suratmasukunit->file_surat ?></td>
		      <td><?php echo $suratmasukunit->keterangan ?></td>
		      <td><?php echo $suratmasukunit->status ?></td>
		      <td><?php echo $suratmasukunit->arsip ?></td>	
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