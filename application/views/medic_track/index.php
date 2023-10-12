<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Daftar Rekam Medis</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">

        <form id="myform" method="post" onsubmit="return false">

          <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-12">
              <div class="row">
                <div class="col-xs-12 col-md-3">
                  <div class="form-group">
                    <label>Tanggal Awal:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="start" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-xs-12 col-md-3">
                  <div class="form-group">
                    <label>Tanggal Akhir:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="end" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-xs-12 col-md-3">
                  <div class="form-group">
                    <label>Penanganan</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-check"></i>
                      </div>
                      <select class="form-control select2" id="check" style="width: 100%;">
                        <option value='all' selected='selected'>Semua</option>
                        <option value='1'>Sudah</option>
                        <option value='2'>Belum</option>
                      </select>
                      <!-- <input type="text" class="form-control pull-right" id="end" autocomplete="off"> -->
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-xs-12 col-md-3">
                  <div class="form-group">
                    <label></label>
                    <div class="input-group">
                      <div class="#">
                      </div>
                      <button class="btn btn-success" id="filter">Filter </button>
                      <a href="javascript:location.reload(true)" class="btn btn-warning">Reset </a>
                      <?php echo anchor(site_url('medical/ekspor_'), '<i class="fa fa-file-excel"></i> Download Excel', 'class="btn btn-info"'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="mytable" style="width:100%">
              <thead>
                <tr>
                  <th width=""></th>
                  <th width="10px">No</th>
                  <!-- <th>Track Id</th>
                  <th>Idsiswa</th> -->
                  <th>IDYYS</th>
                  <th>Nama</th>
                  <th>Unit</th>
                  <th>Kelas</th>
                  <!-- <th>Idperiode</th>
                  <th>noTrans</th>
                  <th>Person Id</th>
                  <th>Anamnesa</th>
                  <th>Terapi</th>
                  <th>Kif</th> -->
                  <th>Tanggal</th>
                  <!-- <th>No Rak</th>
                  <th>No Baris</th>
                  <th>No Urut</th>
                  <th>No Antri</th> -->

                  <th width="80px">Action</th>
                </tr>
              </thead>


            </table>
          </div>
          <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> -->
        </form>

      </div>
    </div>
  </div>
</div>
<div class="modal fade modal-fullscreen" tabindex="-1" role="dialog" id="modal-default" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="margin: 15px;width:auto" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Jejak Rekam Medis</h4>
      </div>
      <div class="modal-body" id="modal_detail">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>