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
    <h3 align="center">DATA Track Medic</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Track Id</th>
		<th>Idsiswa</th>
		<th>Idperson</th>
		<th>Idunit</th>
		<th>Idperiode</th>
		<th>No Trans</th>
		<th>Person Id</th>
		<th>Anamnesa</th>
		<th>Terapi</th>
		<th>Kif</th>
		<th>Tgl</th>
		<th>No Rak</th>
		<th>No Baris</th>
		<th>No Urut</th>
		<th>No Antri</th>
		
            </tr><?php
            foreach ($track_medic_data as $track_medic)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $track_medic->track_id ?></td>
		      <td><?php echo $track_medic->idsiswa ?></td>
		      <td><?php echo $track_medic->idperson ?></td>
		      <td><?php echo $track_medic->idunit ?></td>
		      <td><?php echo $track_medic->idperiode ?></td>
		      <td><?php echo $track_medic->no_trans ?></td>
		      <td><?php echo $track_medic->person_id ?></td>
		      <td><?php echo $track_medic->anamnesa ?></td>
		      <td><?php echo $track_medic->terapi ?></td>
		      <td><?php echo $track_medic->kif ?></td>
		      <td><?php echo $track_medic->tgl ?></td>
		      <td><?php echo $track_medic->no_rak ?></td>
		      <td><?php echo $track_medic->no_baris ?></td>
		      <td><?php echo $track_medic->no_urut ?></td>
		      <td><?php echo $track_medic->no_antri ?></td>	
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