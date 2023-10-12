<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var idperson;
        var idperiode;
        const uri = $('#uri').val();
        if (uri == "update") {
            const idsiswa = $('#idsiswa').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Medic_track/get_siswa'); ?>', // Sesuaikan dengan URL controller Anda
                data: {
                    idsiswa: idsiswa
                },
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    const nama = data[0].nama;
                    const title = data[0].title;
                    const keterangan = data[0].keterangan;
                    $('#nama_').val(nama);
                    $('#unit').val(title);
                    $('#keterangan').val(keterangan);

                }
            });
            // console.log(idsiswa);
        } else {
            $("#idperson").autocomplete({
                source: "<?= site_url('Medic_track/get_autocomplete'); ?>",
                select: function(event, ui) {
                    $('#no_rak').val();
                    $('[name="idperson"]').val(ui.item.value);
                    // $('[name="idperson"]').val(ui.item.departemen);
                    $('[name="nama_"]').val(ui.item.nama);
                    $("#idsiswa").val(ui.item.idsiswa);
                    $("#idunit").val(ui.item.idunit);
                    $("#idperiode").val(ui.item.idperiode);
                    $("#unit").val(ui.item.unit);
                    $("#keterangan").val(ui.item.keterangan);
                    // $('[name="jk"]').val(ui.item.jk);
                    // $('[name="no_hp_ayah"]').val(ui.item.phone);
                    var idprsn = ui.item.value;
                    var idprd = ui.item.idperiode;

                    idperson = idprsn;
                    idperiode = idprd;
                    var dataToSend = {
                        idperson: idperson,
                        idperiode: idperiode
                    };
                    ajax_r(dataToSend)
                }
            });
        }

        function ajax_r(datass) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('Medic_track/check_register'); ?>', // Sesuaikan dengan URL controller Anda
                data: datass,
                dataType: "json",
                success: function(data) {
                    // console.log('Data dari server:', data);
                    if (data.length > 0) {
                        $('._rak').hide();
                        $('._urut').show();
                        const rak = data[0].no_rak;
                        const baris = data[0].no_baris;
                        const urut = data[0].no_urut;
                        const ids = data[0].track_id;
                        $('#no_rak').val(rak);
                        $('#no_baris').val(baris);
                        $('#no_urut').val(urut);
                        $('#inject').append('<div class="row" id="row_ajax"><div class="col-xs-6 col-md-6"><p class="_no_rak"> </p></div><div class="col-xs-6 col-md-6 text-right"><button type="button" id="edit_rak" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i> Edit No Rekam Medis</button></div></div>')
                        $('._no_rak').text("No Rekam Medis : " + rak);
                        $('#edit_rak').on('click', function() {
                            $('._rak').show();
                            $('#edit_rak_').show();
                            $('#simpan_rak_').show();
                            $('._urut').hide();
                            $('#submit_').hide();
                            $('#cancel_').hide();
                        });
                        $('#edit_rak_').on('click', function() {
                            $('._rak').hide();
                            $('#edit_rak_').hide();
                            $('#simpan_rak_').hide();
                            $('._urut').show();
                            $('#submit_').show();
                            $('#cancel_').show();
                        });
                        $('#simpan_rak_').on('click', function() {
                            var id = ids;
                            var data_to_update = $("#no_rak").val();

                            // Mengirim data ke server melalui AJAX
                            $.ajax({
                                url: "<?php echo base_url('Medic_track/update_norekmed'); ?>",
                                type: "POST",
                                data: {
                                    id: id,
                                    data_to_update: data_to_update
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.status === 'success') {
                                        // Tangani jika update berhasil
                                        // alert(response.message);
                                        $('#edit_rak_').click();
                                        $('#row_ajax').remove();
                                        var dataToSend = {
                                            idperson: idperson,
                                            idperiode: idperiode
                                        };
                                        ajax_r(dataToSend);
                                    } else {
                                        // Tangani jika ada kesalahan dalam update
                                        // alert(response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Tangani kesalahan AJAX
                                    alert("Terjadi kesalahan: " + error);
                                }
                            });
                        });
                    } else {
                        $('#no_rak').val('');
                        $('#no_baris').val('');
                        $('#no_urut').val('');
                        $('._rak').show();
                        $('._urut').hide();
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('Medic_track/check_counter_urut'); ?>', // Sesuaikan dengan URL controller Anda
                            data: {
                                idperson: idperson,
                                idperiode: idperiode
                            },
                            // dataType: "json",
                            success: function(datas) {
                                // console.log(datas);
                                $('#no_urut').val(datas);
                            }
                        });
                    }
                }
            });
        }
    });
</script>

<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<script type="text/javascript">
    //select2
    $('.select2').select2();
    //Date picker
    $('#tgl').datepicker({
        autoclose: true
    })
</script>