<div class="row">
    <div class="col-xs-12 col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center"><?= $fullData->nama; ?></h3>

                <p class="text-muted text-center">ID YYS <?= $fullData->idperson; ?></p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Gender</b> <a class="pull-right"><?= $fullData->gender; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Tempat, Tanggal Lahir</b> <a class="pull-right"><?= $fullData->lahirtempat; ?>, <?= $fullData->lahirtanggal; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Usia</b> <a class="pull-right"><?= $fullData->usia; ?> Tahun</a>
                    </li>
                    <li class="list-group-item custom-list-item">
                        <b>Alamat</b> <a class="pull-right"><?= $fullData->alamat; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Wali</b> <a class="pull-right"><?= $fullData->phone_number; ?> ( <?= $fullData->pemilik; ?> )</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">History Pemeriksaan</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th style="width: 10px;">No</th>
                        <th style="width: 150px;">Waktu</th>
                        <th>Anamnesa</th>
                        <th>Terapi</th>
                        <th>KIF</th>
                        <th>Dokter</th>
                    </tr>
                    <?php $no = 1;
                    foreach ($medic as $key) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $key->tgl ?></td>
                            <td><?= $key->anamnesa ?></td>
                            <td><?= $key->terapi ?></td>
                            <td><?= $key->kif ?></td>
                            <td><?= $key->nama ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>