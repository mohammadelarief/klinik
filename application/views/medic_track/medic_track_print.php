<!DOCTYPE html>
<html>

<head>
  <title>Tittle</title>
  <style type="text/css" media="print">
    @page {
      margin: 0;
      /* this affects the margin in the printer settings */
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
    }

    table th {
      -webkit-print-color-adjust: exact;
      border: 1px solid;

      padding-top: 11px;
      padding-bottom: 11px;
      background-color: #a29bfe;
    }

    table td {
      border: 1px solid;

    }
  </style>
</head>

<body>
  <h3 align="center">DATA Track Medic</h3>
  <h4>Tanggal Cetak : <?= date("d/M/Y"); ?> </h4>
  <table class="word-table" style="margin-bottom: 10px">
    <tr>
      <th>No</th>
      <th>Track Id</th>
      <th>Idsiswa</th>
      <th>Idperson</th>
      <th>Idunit</th>
      <th>Idperiode</th>
      <th>Unit</th>
      <th>Person Id</th>
      <th>Anamnesa</th>
      <th>Terapi</th>
      <th>Kif</th>
      <th>Tgl</th>

    </tr><?php
          foreach ($medic_track_data as $medic_track) {
          ?>
      <tr>
        <td><?php echo ++$start ?></td>
        <td><?php echo $medic_track->track_id ?></td>
        <td><?php echo $medic_track->idsiswa ?></td>
        <td><?php echo $medic_track->idperson ?></td>
        <td><?php echo $medic_track->idunit ?></td>
        <td><?php echo $medic_track->idperiode ?></td>
        <td><?php echo $medic_track->no_trans ?></td>
        <td><?php echo $medic_track->person_id ?></td>
        <td><?php echo $medic_track->anamnesa ?></td>
        <td><?php echo $medic_track->terapi ?></td>
        <td><?php echo $medic_track->kif ?></td>
        <td><?php echo $medic_track->tgl ?></td>
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