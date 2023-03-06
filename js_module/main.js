const main = {
    data: {
        number: "",
    },
    ajax: {
        loaddata: async () => {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: "./controllers/Index.php",
                data: {
                    function: 'get',
                },
                success: (results) => {
                    if (results.status) {
                        let data = results.data
                        let json_pay = data.json_pay[ 0 ]
                        if (json_pay) {
                            $('#pay_name').val(json_pay.name)
                            $('#pay_number').val(json_pay.number)
                        }
                    }
                }
            })
        },
        save_jsonpay: async (modules) => {
            let json = [
                {
                    name: $('#pay_name').val() ? $('#pay_name').val() : 'เบอร์ละ',
                    number: $('#pay_number').val() ? $('#pay_number').val() : '50'
                }
            ];
            await $.ajax({
                type: 'POST',
                dataType: 'json',
                url: './controllers/Index.php',
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
        }

    },
    init() {
        this.ajax.loaddata()
        $(document).on('click', ` .btnList`, (e) => {
            let obj = $(e.target).closest(` .btnList`)
            if (obj.hasClass('active') === false) {
                let number = obj.data('number')

                $('.content-number .text').text(number)
                this.data.number = number

            }
            if (obj.hasClass('selector')) {
                obj.removeClass('selector')
                $('.content-number .text').text('N/A')

            } else {
                obj.addClass('selector')
                $(` .btnList`).not(obj).removeClass('selector')
            }

        })

        $(document).on('click', ` #canceldata`, (e) => {
            $('.content-number .text').text('N/A')
            this.data.number = ""
        })

        $(document).on('click', '.save-data', (e) => {
            let obj = $(e.target).closest('.save-data')
            let attr = obj.attr('data-module')
            if (attr == 'pay') {
                this.ajax.save_jsonpay(attr)
            }
        })
    }
}
$(document).ready(function () {
    main.init()
    setTimeout(() => {
        $('.body-content').css('display', 'unset')
        $('.bg-loader ').remove()
        $('.loader').remove()
    }, 500);
    $("#datatable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons":
            [ "excel", "pdf", "print", "colvis" ]
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');


})