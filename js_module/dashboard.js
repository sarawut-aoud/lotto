const main = {
    data: {
        number: "",
    },
    ajax: {
        loaddata: async () => {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: "./controllers/Dashboard.php",
                data: {
                    function: 'get',
                },
                success: (results) => {
                    if (results.status) {
                        let data = results.data
                        let json_pay = data.json_pay[ 0 ]
                        let json_bottom = data.json_bottom[ 0 ]
                        let json_top = data.json_top[ 0 ]
                        if (json_pay) {
                            $('#pay_name').val(json_pay.name)
                            $('#pay_number').val(json_pay.number)
                        }
                        if (json_bottom) {
                            $('#bottom_name').val(json_bottom.name)
                            $('#bottom_number').val(json_bottom.number)
                        }
                        if (json_top) {
                            $('#top_name').val(json_top.name)
                            $('#top_number').val(json_top.number)
                        }
                    }
                }
            })
        },
        save_jsonpay: async (modules) => {
            let json = '';

            if (modules == 'pay') {
                json = [
                    {
                        name: $('#pay_name').val() ? $('#pay_name').val() : 'เบอร์ละ',
                        number: $('#pay_number').val() ? $('#pay_number').val() : '50'
                    }
                ];
            } else if (modules == 'top') {
                json = [
                    {
                        name: $('#top_name').val() ? $('#top_name').val() : 'ถูกบน',
                        number: $('#top_number').val() ? $('#top_number').val() : '300'
                    }
                ];
            } else if (modules == 'bottom') {
                json = [
                    {
                        name: $('#bottom_name').val() ? $('#bottom_name').val() : 'ถูกล่าง',
                        number: $('#bottom_number').val() ? $('#bottom_number').val() : '3000'
                    }
                ];
            }

            await $.ajax({
                type: 'POST',
                dataType: 'json',
                url: './controllers/Dashboard.php',
                data: {
                    function: modules,
                    data: json
                },
                success: (results) => {
                    if (results.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            })
        },
        savedate: async () => {
            await $.ajax({
                type: 'POST',
                dataType: 'json',
                url: './controllers/Dashboard.php',
                data: {
                    function: 'date',
                    date: 'dasdas'
                },
                success: (results) => {
                    if (results.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            })
        }

    },
    init() {
        this.ajax.loaddata()


        $(document).on('click', '.save-data', (e) => {
            let obj = $(e.target).closest('.save-data')
            let attr = obj.attr('data-module')
            this.ajax.save_jsonpay(attr)
        })
        $(document).on('click', '.save-data-date', (e) => {
            this.ajax.savedate()
        })
    }
}
$(document).ready(function () {
    main.init()

    $("#datatable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons":
            [ "excel", "pdf", "print", "colvis" ]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');


})