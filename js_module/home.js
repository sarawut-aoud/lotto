const home = {
    data: {
        number: "",
    },
    ajax: {
        loaddata: async () => {
            await $.ajax({
                type: "get",
                dataType: 'json',
                url: "./controllers/Home.php",
                data: {
                    function: 'index',
                },
                success: (results) => {
                    if (results.status) {
                        let data = results.data;

                        if (data?.json_pay) {
                            let content = $('.content .content-pirce')
                            let content_p = $('.content-pay')
                            let pay = data.json_pay[ 0 ]
                            let bottom = data.json_bottom[ 0 ]
                            let top = data.json_top[ 0 ]
                            content.find('.text').text(pay.name)
                            content.find('.price').text(pay.number)
                            content_p.find('.top-number').text(top.name + ' ' + top.number + " .-")
                            content_p.find('.bottom-number').text(bottom.name + ' ' + bottom.number + " .-")

                        }
                    }
                }
            })
        },
    },
    init() {
        this.ajax.loaddata();
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
    home.init();
})