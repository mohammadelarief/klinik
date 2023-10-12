<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Track_medic</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="varchar">Track Id <?php echo form_error('track_id') ?></label>
                        <input type="text" class="form-control" name="track_id" id="track_id" placeholder="Track Id" value="<?php echo $track_id; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idsiswa <?php echo form_error('idsiswa') ?></label>
                        <input type="text" class="form-control" name="idsiswa" id="idsiswa" placeholder="Idsiswa" value="<?php echo $idsiswa; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idperson <?php echo form_error('idperson') ?></label>
                        <input type="text" class="form-control" name="idperson" id="idperson" placeholder="Idperson" value="<?php echo $idperson; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idunit <?php echo form_error('idunit') ?></label>
                        <input type="text" class="form-control" name="idunit" id="idunit" placeholder="Idunit" value="<?php echo $idunit; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Idperiode <?php echo form_error('idperiode') ?></label>
                        <input type="text" class="form-control" name="idperiode" id="idperiode" placeholder="Idperiode" value="<?php echo $idperiode; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Trans <?php echo form_error('no_trans') ?></label>
                        <input type="text" class="form-control" name="no_trans" id="no_trans" placeholder="No Trans" value="<?php echo $no_trans; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Person Id <?php echo form_error('person_id') ?></label>
                        <input type="text" class="form-control" name="person_id" id="person_id" placeholder="Person Id" value="<?php echo $person_id; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="mediumtext">Anamnesa <?php echo form_error('anamnesa') ?></label>
                        <input type="text" class="form-control" name="anamnesa" id="anamnesa" placeholder="Anamnesa" value="<?php echo $anamnesa; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="mediumtext">Terapi <?php echo form_error('terapi') ?></label>
                        <input type="text" class="form-control" name="terapi" id="terapi" placeholder="Terapi" value="<?php echo $terapi; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="mediumtext">Kif <?php echo form_error('kif') ?></label>
                        <input type="text" class="form-control" name="kif" id="kif" placeholder="Kif" value="<?php echo $kif; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="datetime">Tgl <?php echo form_error('tgl') ?></label>
                        <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">No Rak <?php echo form_error('no_rak') ?></label>
                        <input type="text" class="form-control" name="no_rak" id="no_rak" placeholder="No Rak" value="<?php echo $no_rak; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">No Baris <?php echo form_error('no_baris') ?></label>
                        <input type="text" class="form-control" name="no_baris" id="no_baris" placeholder="No Baris" value="<?php echo $no_baris; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">No Urut <?php echo form_error('no_urut') ?></label>
                        <input type="text" class="form-control" name="no_urut" id="no_urut" placeholder="No Urut" value="<?php echo $no_urut; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">No Antri <?php echo form_error('no_antri') ?></label>
                        <input type="text" class="form-control" name="no_antri" id="no_antri" placeholder="No Antri" value="<?php echo $no_antri; ?>" />
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('track_medic') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>