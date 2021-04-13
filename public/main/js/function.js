const baseUrl = () => {
    return window.location.protocol + '//' + window.location.host;
}

// const exampleFunctionES6 = (path, program_id)=> $.parseJSON( $.ajax({
//     async: false,
//     crossDomain: false,
//     url: `${baseUrl()}/${path}`,
//     dataType: 'JSON',
//     method: "POST",
//     data: {program_id: program_id},
//     headers: {
//         'X-CSRF-TOKEN': $('mseta[name="csrf-token"]').attr('content')
//     }
// }).responseText || '[]');

const bulk = (jenisData, status, location) => {
    if (status === 'move_to_trash') {
        type = 'di pindah ke tempat sampah';
    } else if (status === 'delete_permanently') {
        type = 'terhapus secara permanen';
    } else if (status === 'restore') {
        type = 'dikembalikan ke asal';
    } else {
        type = 'status tidak valid';
    }
    swal({
        title: "Apakah Anda yakin?",
        text: `data ${jenisData} akan ${type}`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            const bulkchoices = () => $('.case:checked').map(function () {
                return $(this).val();
            }).get();

            let url = baseUrl() + location;
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                data: { _token: CSRF_TOKEN, id: bulkchoices, type: status },
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.status === 'success') {
                        swal(`Success! ${jenisData} berhasil ${type}`, {
                            icon: "success",
                        }).then(function () {
                            window.location.href = '';
                        });
                        setTimeout(function () {
                            swal.close();
                            $('.modal-delete').modal('hide');
                            window.location.href = '';
                        }, 3000);
                        $(".case").prop("checked", false);
                        $("#selectall").prop("checked", false);
                        $('.select-option').attr('disabled', true);
                    } else {
                        swal(`Failed! ${jenisData} gagal ${type}`, {
                            icon: "success",
                        }).then(function () {
                            window.location.href = '';
                        });
                        setTimeout(function () {
                            swal.close();
                            $('.modal-delete').modal('hide');
                            window.location.href = '';
                        }, 3000);
                        $(".case").prop("checked", false);
                        $("#selectall").prop("checked", false);
                        $('.select-option').attr('disabled', true);
                    }
                },
                error: function (x, t, m) {
                    if (t === 'timeout') {
                    } else {
                    }
                    setTimeout(function () {
                    }, 3000);
                }
            });

        });
}

const deletepermanently = (location, id) => {
    swal({
        title: "Apakah Anda yakin?",
        text: "data akan dihapus dari database!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                let url = window.location.protocol + '//' + window.location.host + location;
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: { _token: CSRF_TOKEN, id: id },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            swal("Data berhasil dihapus!", {
                                icon: "success"
                            }).then(function () {
                                window.location.href = '';
                            });
                            setTimeout(function () {
                                swal.close();
                                $('.modal-delete').modal('hide');
                                window.location.href = '';
                            }, 3000);
                        } else {
                            swal("gagal hapus!", {
                                icon: "failed"
                            }).then(function () {
                                window.location.href = '';
                            });
                            setTimeout(function () {
                                swal.close();
                                $('.modal-delete').modal('hide');
                                window.location.href = '';
                            }, 3000);
                        }
                    },
                    error: function (x, t, m) {
                        if (t === 'timeout') {
                        } else {
                        }
                        setTimeout(function () {
                        }, 3000);
                    }
                });

            } else {
            }
        });
}

const resetpassword = (location, id) => {
    swal({
        title: "Apakah Anda yakin?",
        text: "password akan tereset ke default!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                let url = window.location.protocol + '//' + window.location.host + location;
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: { _token: CSRF_TOKEN, id: id },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            swal("Password Berhasil Ter-reset!", {
                                icon: "success"
                            }).then(function () {
                                window.location.href = '';
                            });
                            setTimeout(function () {
                                swal.close();
                                $('.modal-delete').modal('hide');
                                window.location.href = '';
                            }, 3000);
                        } else {
                            swal("gagal reset!", {
                                icon: "failed"
                            }).then(function () {
                                window.location.href = '';
                            });
                            setTimeout(function () {
                                swal.close();
                                $('.modal-delete').modal('hide');
                                window.location.href = '';
                            }, 3000);
                        }
                    },
                    error: function (x, t, m) {
                        if (t === 'timeout') {
                        } else {
                        }
                        setTimeout(function () {
                        }, 3000);
                    }
                });

            } else {
            }
        });
}

const selectall = (selector) => {
    $('.case').prop('checked', selector.checked);
    if ($('.case:checked').length > 0) {
        $('.select-option').attr('disabled', false);
    } else {
        $('.select-option').attr('disabled', true);
    }
    var count = $('input:checked').length;
    if (count > 0) {
        $('button.btn-apply').removeClass('disabled');
    } else {
        $('button.btn-apply').addClass('disabled');
    }
}

const caseclick = (selector) => {
    if ($('.case:checked').length > 0) {
        $('.select-option').attr('disabled', false);
    } else {
        $('.select-option').attr('disabled', true);
    }
    if ($(".case").length == $(".case:checked").length) {
        $("#selectall").attr("checked", "checked");
    } else {
        $("#selectall").removeAttr("checked");
    }
}


/**  INSERT FUNCTION GLOBAL
* @uri adalah url controller route
* @idselector adalah selecto id yang ada di <FORM>
* @effect Diisi ARRAY Jika ingin ada special effect setelah submit
* @type metode POST atau GET
*/
const insert = (uri, selector, type, success_effect, beforeSend_effect, failed_effect) => {
    $('form' + selector).on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let link = window.location.protocol + '//' + window.location.host + uri;
        let is_contain_file = $(this).attr('enctype');
        if (is_contain_file == undefined) {
            var formData = new FormData($(this)[0]);
        } else {
            var formData = new FormData($(this)[0]);
            var file = $('input[type=file]')[0].files[0];
            formData.append('photo', file);
        }
        let inst = $(this);
        $.ajax({
            type: type,
            url: link,
            data: formData,
            cache: false,
            dataType: 'JSON', /*type*/
            contentType: false,
            processData: false,
            beforeSend: function () {
                beforeSend_effect();
            },
            success: function (data) {
                if (data.status === 'success') {
                    success_effect(inst);
                } else {
                    failed_effect();
                }
            }
        });
    });
}

/** UPDATE FUNCTION GLOBAL
* @uri adalah url controller route
* @idselector adalah selecto id yang ada di <FORM>
* @effect Diisi ARRAY Jika ingin ada special effect setelah submit
* @type metode POST atau GET
*/
const update = (uri, selector, type, success_effect, beforeSend_effect, failed_effect) => {
    $('form' + selector).on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let link = window.location.protocol + '//' + window.location.host + uri;
        let is_contain_file = $(this).attr('enctype');
        if (is_contain_file == undefined) {
            var formData = new FormData($(this)[0]);
        } else {
            var formData = new FormData($(this)[0]);
            var file = $('input[type=file]')[0].files[0];
            formData.append('photo', file);
        }
        let inst = $(this);
        $.ajax({
            type: type,
            url: link,
            data: formData,
            cache: false,
            dataType: 'JSON', /*type*/
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                beforeSend_effect();
            },
            success: function (data) {
                if (data.status === 'success') {
                    success_effect(inst);
                } else {
                    failed_effect();
                }
            }
        });
    });
}

$("#selectall").click(function () {
    let selector = this;
    selectall(selector)
});

$(".case").click(function () {
    let selector = this;
    caseclick(selector)
});