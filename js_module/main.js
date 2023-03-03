const main = {
    data: {
        number: "",
    },
    ajax: {

    },
    init() {
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