<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<script type="text/javascript">
    //select2
    $('.select2').select2();
    //Date picker
    $('#start').datepicker({
        autoclose: true
    })
    $('#end').datepicker({
        autoclose: true
    })
</script>

<script type="text/javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    let _start = $("#start").val(),
        _end = $("#end").val(),
        _curdate = today,
        _check = $("#check").val()

    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        table = $("#mytable").DataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode != 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            scrollCollapse: true,
            processing: true,
            serverSide: true,
            ajax: {
                "url": "medic_track/json",
                "type": "POST",
                data: function(data) {
                    data._start = _start;
                    data._end = _end;
                    data._curdate = _curdate;
                    data._check = _check;
                    return data;
                }
            },
            columns: [{
                    "data": "track_id",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "track_id",
                    "orderable": false
                },
                // {
                //     "data": "track_id"
                // }, {
                //     "data": "idsiswa"
                // },
                {
                    "data": "idperson"
                }, {
                    "data": "nama",
                    createdCell: function(td, cellData, data, row, col) {
                        $(td).html('<a href="#" class="modal_detail" name="' + data.no_formulir + '" id="' + data.idperson + '" >' + data.nama + '</a>');
                    }
                }, {
                    "data": "title"
                }, {
                    "data": "keterangan"
                },
                // {
                //     "data": "idperiode"
                // }, {
                //     "data": "no_trans"
                // }, {
                //     "data": "person_id"
                // }, {
                //     "data": "anamnesa"
                // }, {
                //     "data": "terapi"
                // }, {
                //     "data": "kif"
                // }, 
                {
                    "data": "tgl"
                },
                // {
                //     "data": "no_rak"
                // }, {
                //     "data": "no_baris"
                // }, {
                //     "data": "no_urut"
                // }, {
                //     "data": "no_antri"
                // },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            columnDefs: [{
                    className: "text-center",
                    targets: 0,
                    checkboxes: {
                        selectRow: true,
                    }
                }

            ],
            select: {
                style: 'multi'
            },
            order: [
                [6, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(1)', row).html(index);
            }
        });
        table.on('click', '.modal_detail', function() {
            var id = $(this).attr("id");
            // var name = $(this).attr("name");

            // console.log(name);
            $.ajax({
                url: "<?php echo base_url('medical/get_Full_data') ?>",
                type: "POST",
                data: {
                    id: id,
                    // name: name
                },
                success: function(data) {
                    //alert(data);  
                    $('#modal_detail').html(data);
                    $('#modal-default').modal("show");
                }
            });
        });
        // $('#myform').keypress(function(e) {
        //     if (e.which == 13) return false;

        // });
        // $("#myform").on('submit', function(e) {
        //     var form = this
        //     var rowsel = t.column(0).checkboxes.selected();
        //     $.each(rowsel, function(index, rowId) {
        //         $(form).append(
        //             $('<input>').attr('type', 'hidden').attr('name', 'id[]').val(rowId)
        //         )
        //     });

        //     if (rowsel.join(",") == "") {
        //         alertify.alert('', 'Tidak ada data terpilih!', function() {});

        //     } else {
        //         var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?', 'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
        //             ok: 'Yakin',
        //             cancel: 'Batal!'
        //         }).set('onok', function(closeEvent) {
        //             $.ajax({
        //                 url: "medic_track/deletebulk",
        //                 type: "post",
        //                 data: "msg = " + rowsel.join(","),
        //                 success: function(response) {
        //                     if (response == true) {
        //                         location.reload();
        //                     }
        //                 },
        //                 error: function(jqXHR, textStatus, errorThrown) {
        //                     console.log(textStatus, errorThrown);
        //                 }
        //             });

        //         });
        //     }
        //     $(".ajs-header").html("Konfirmasi");
        // });
    });

    // function confirmdelete(linkdelete) {
    //     alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
    //         location.href = linkdelete;
    //     }, function() {
    //         alertify.error("Penghapusan data dibatalkan.");
    //     });
    //     $(".ajs-header").html("Konfirmasi");
    //     return false;
    // }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#filter').on('click', function() {
            _start = $("#start").val();
            _end = $("#end").val();
            _check = $("#check").val();
            // var tables = t;
            table.ajax.reload();
        });
        // $('#reset').on('click', function() {
        //     _start = $("#start").val('');
        //     _end = $("#end").val('');
        //     _check = $("#check").val('');
        //     table.ajax.reload();
        // });
    });
</script>