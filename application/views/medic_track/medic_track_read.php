<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Track Medic Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td>Track Id</td>
                        <td><?php echo $track_id; ?></td>
                    </tr>
                    <tr>
                        <td>Idsiswa</td>
                        <td><?php echo $idsiswa; ?></td>
                    </tr>
                    <tr>
                        <td>Idperson</td>
                        <td><?php echo $idperson; ?></td>
                    </tr>
                    <tr>
                        <td>Idunit</td>
                        <td><?php echo $idunit; ?></td>
                    </tr>
                    <tr>
                        <td>Idperiode</td>
                        <td><?php echo $idperiode; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Transaksi</td>
                        <td><?php echo $no_trans; ?></td>
                    </tr>
                    <tr>
                        <td>Person Id</td>
                        <td><?php echo $person_id; ?></td>
                    </tr>
                    <tr>
                        <td>Anamnesa</td>
                        <td><?php echo $anamnesa; ?></td>
                    </tr>
                    <tr>
                        <td>Terapi</td>
                        <td><?php echo $terapi; ?></td>
                    </tr>
                    <tr>
                        <td>Kif</td>
                        <td><?php echo $kif; ?></td>
                    </tr>
                    <tr>
                        <td>Tgl</td>
                        <td><?php echo $tgl; ?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo site_url('medic_track') ?>" class="btn bg-purple">Cancel</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>