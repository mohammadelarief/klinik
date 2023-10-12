<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List Track_medic</h3>
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
            <div class="col-xs-12 col-md-4">
              <?php echo anchor(site_url('track_medic/create'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
              <div style="margin-top: 4px" id="message">

              </div>
            </div>
            <div class="col-xs-12 col-md-4 text-right">

            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="mytable" style="width:100%">
              <thead>
                <tr>
                  <th width=""></th>
                  <th width="10px">No</th>
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

                  <th width="80px">Action</th>
                </tr>
              </thead>


            </table>
          </div>
          <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>
        </form>

      </div>
    </div>
  </div>
</div>