<form action="<?php echo $action; ?>" method="post">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Nomor Transaksi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nomor</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_trans" id="no_trans" placeholder="Unit" value="<?php echo $no_trans; ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tgl" id="tgl" placeholder="Tgl" value="<?php echo $tgl; ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">IDYYS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="idperson" id="idperson" placeholder="idperson" value="<?php echo $idperson; ?>" readonly />
                            </div>
                            <!-- <label for="varchar">IDYYS <?php echo form_error('idperson') ?></label>
                            <input type="text" class="form-control" name="idperson" id="idperson" placeholder="Masukkan ID YYS / Nama Siswa" value="<?php echo $idperson; ?>" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Diri Pasien</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" class="form-control" name="track_id" id="track_id" placeholder="Track Id" value="<?php echo $track_id; ?>" readonly />
                    <input type="hidden" class="form-control" name="idsiswa" id="idsiswa" placeholder="Idsiswa" value="<?php echo $idsiswa; ?>" readonly />
                    <input type="hidden" class="form-control" name="idunit" id="idunit" placeholder="Idunit" value="<?php echo $idunit; ?>" readonly />
                    <input type="hidden" class="form-control" name="idperiode" id="idperiode" placeholder="Idperiode" value="<?php echo $idperiode; ?>" readonly />
                    <input type="hidden" class="form-control" name="uri" id="uri" placeholder="uri" value="<?php echo $uri; ?>" readonly />
                    <!-- <input type="hidden" class="form-control" name="person_id" id="person_id" placeholder="Person Id" value="<?= $user->id; ?>" readonly /> -->

                    <div class="form-group">
                        <label for="varchar">Nama</label>
                        <input type="text" class="form-control" name="nama_" id="nama_" placeholder="Nama" readonly />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Lembaga <?php echo form_error('no_trans') ?></label>
                        <input type="text" class="form-control" name="unit" id="unit" placeholder="Lembaga" readonly />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kelas / Kamar</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Kelas" readonly />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Penaganan Rekam Medis</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="int">Dokter <?php echo form_error('person_id') ?></label>
                        <?= cmb_dinamis('person_id', 'daruttaqwa_klinik.dokter', 'nama', 'id', $person_id); ?>
                        <!-- <input type="text" class="form-control" name="person_id" id="person_id" placeholder="No Rak" value="<?php echo $person_id; ?>" /> -->
                    </div>
                    <div class="form-group">
                        <label for="mediumtext">Anamnesa <?php echo form_error('anamnesa') ?></label>
                        <textarea class="form-control" rows="4" name="anamnesa" id="anamnesa" placeholder="Anamnesa" value="<?php echo $anamnesa; ?>"><?php echo $anamnesa; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="mediumtext">Terapi <?php echo form_error('terapi') ?></label>
                        <textarea class="form-control" rows="4" name="terapi" id="terapi" placeholder="Terapi" value="<?php echo $terapi; ?>"><?php echo $terapi; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="mediumtext">Kif <?php echo form_error('kif') ?></label>
                        <textarea class="form-control" rows="3" name="kif" id="kif" placeholder="Kif" value="<?php echo $kif; ?>"><?php echo $kif; ?></textarea>
                    </div>
                    <!-- <div class="form-group _rak">
                        <label for="int">No Rak <?php echo form_error('no_rak') ?></label> -->
                    <input type="hidden" class="form-control" name="no_rak" id="no_rak" placeholder="No Rak" value="<?php echo $no_rak; ?>" />
                    <!-- </div>
                    <div class="form-group _rak">
                        <label for="int">No Baris <?php echo form_error('no_baris') ?></label> -->
                    <input type="hidden" class="form-control" name="no_baris" id="no_baris" placeholder="No Baris" value="<?php echo $no_baris; ?>" />
                    <!-- </div>
                    <div class="form-group _rak">
                        <label for="int">No Urut <?php echo form_error('no_urut') ?></label> -->
                    <input type="hidden" class="form-control" name="no_urut" id="no_urut" placeholder="No Urut" value="<?php echo $no_urut; ?>" readonly />
                    <!-- </div>
                    <div class="form-group">
                        <label for="int">No Antri <?php echo form_error('no_antri') ?></label> -->
                    <input type="hidden" class="form-control" name="no_antri" id="no_antri" placeholder="No Antri" value="<?php echo $no_antri; ?>" />
                    <!-- </div>
                    <div class="callout callout-success _urut" style="display: none;">
                        <p class="_no_rak"> </p>
                    </div> -->
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('medical') ?>" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>