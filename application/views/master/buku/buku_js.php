<script src="<?= base_url('assets') ?>/js/dropify.js"></script>
<script src="<?= base_url('assets') ?>/js/select2.min.js"></script>
<script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/dataTables.bootstrap4.js') ?>"></script>

<script>
    $('.dropify').dropify(); //inisialisasi dropify
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

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

        var tableData = $('#myTable').DataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            bAutoWidth: false,
            oder: [],
            ajax: {
                url: "<?= base_url('master/Buku/json') ?>",
                type: "POST"
            },
            columns: [{
                    "data": "id_buku",
                    "orderable": false,
                    "width": "20px"
                },
                {
                    "data": "image",
                    "orderable": false,
                    "className": "text-center",
                    "render": function(dataImage) {
                        if (dataImage == 'default.png') {
                            return '<img class="avatar" src="<?= base_url("assets/img/") ?>' + dataImage + '"height="75">'
                        } else {
                            return '<img class="avatar" src="<?= base_url("assets/img/buku/") ?>' + dataImage + '"height="75">'
                        }
                    }
                },
                {
                    "data": "judul_buku"
                },
                {
                    "data": "nama_kategori"
                },
                {
                    "data": "stok",
                    "class": "text-center",
                    "render": function(t) {
                        if (t == null) {
                            return '<b style="font-size:15px">0</b>'
                        } else {
                            return '<b style="font-size:15px">' + t + '</b>'
                        }
                    }
                },
                {
                    "data": "dipinjam",
                    "class": "text-center",
                    "render": function(t) {
                        if (t == null) {
                            return '<div style="font-size:8px">0</div>'
                        } else {
                            return '<b style="font-size:15px">' + t + '</b>'
                        }
                    }
                },
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            order: [
                [0, 'asc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });


        // set theme select2 to bootstrap 3
        $.fn.select2.defaults.set("theme", "bootstrap");


        <?php if ($button == 'Read') { ?>
            $('.dropify-filename-inner').html(''); //hilangkan namafile
        <?php }; ?>

        // munculkan select2 kategori selain di page read
        <?php if ($button != 'Read') { ?>
            // select2 kategori
            $('#id_kategori').select2({
                allowClear: true,
                tags: true,
                placeholder: 'Pilih Kategori',
                templateSelection: function(state) {
                    if (!state.id) {
                        return state.text;
                    }
                    let text = state.text.replace('Tambah kategori: ', '');
                    return text;
                },
                createTag: function(params) {
                    if (params.result.length == 0) {
                        console.log(params.result)
                        if (params.term === '') {
                            return null;
                        }
                        let term = $.trim(params.term).replace(/\b[a-z]/g, function(l) {
                            return l.toUpperCase();
                        });
                        return {
                            id: term,
                            text: 'Tambah kategori: ' + term
                        }
                    }
                },
                language: {
                    searching: function() {
                        return "Tunggu...";
                    },
                    noResults: function() {
                        return "Kategori tidak ditemukan !";
                    }
                },
                ajax: {
                    dataType: "json",
                    type: "post",
                    url: "<?= base_url('master/Kategori/getKategori') ?>",
                    delay: 1000,

                    data: function(params) {
                        return {
                            search: params.term || "",
                            page: params.page || 1
                        }
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        params.result = data.results;
                        return {
                            results: data.results,
                            pagination: {
                                "more": (params.page * 5) < data.count_filtered
                            }
                        };
                    }
                }
            });
            $('#id_kategori').on("select2:clear", function() {
                $('#id_kategori').empty();
            });
            // end select2 kategori
        <?php }; ?>
    });
</script>