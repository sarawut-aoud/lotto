const main = {
  data: {
    number: "",
    dataDate: [],
  },
  methods: {
    table: (data) => {
      let item = "";
      let action = "";

      for (let i in data) {
        if (data[i].is_active == 0) {
          action = ":p";
        } else {
          action = "1";
        }
        item += `
            <tr>
                <td>${data[i].date}</td>
                <td>${action}</td>
            </tr>
        `;
      }
      $("#contentdate").html(item);
    },
  },
  ajax: {
    loaddata: async () => {
      await $.ajax({
        type: "get",
        dataType: "json",
        url: "./controllers/Dashboard.php",
        data: {
          function: "get",
        },
        success: (results) => {
          if (results.status) {
            let data = results.data;
            let json_pay = data.json_pay[0];
            let json_bottom = data.json_bottom[0];
            let json_top = data.json_top[0];
            if (json_pay) {
              $("#pay_name").val(json_pay.name);
              $("#pay_number").val(json_pay.number);
            }
            if (json_bottom) {
              $("#bottom_name").val(json_bottom.name);
              $("#bottom_number").val(json_bottom.number);
            }
            if (json_top) {
              $("#top_name").val(json_top.name);
              $("#top_number").val(json_top.number);
            }
          }
        },
      });
    },
    save_jsonpay: async (modules) => {
      let json = "";

      if (modules == "pay") {
        json = [
          {
            name: $("#pay_name").val() ? $("#pay_name").val() : "เบอร์ละ",
            number: $("#pay_number").val() ? $("#pay_number").val() : "50",
          },
        ];
      } else if (modules == "top") {
        json = [
          {
            name: $("#top_name").val() ? $("#top_name").val() : "ถูกบน",
            number: $("#top_number").val() ? $("#top_number").val() : "300",
          },
        ];
      } else if (modules == "bottom") {
        json = [
          {
            name: $("#bottom_name").val() ? $("#bottom_name").val() : "ถูกล่าง",
            number: $("#bottom_number").val()
              ? $("#bottom_number").val()
              : "3000",
          },
        ];
      }

      await $.ajax({
        type: "POST",
        dataType: "json",
        url: "./controllers/Dashboard.php",
        data: {
          function: modules,
          data: json,
        },
        success: (results) => {
          if (results.status) {
            Swal.fire({
              icon: "success",
              title: "บันทึกสำเร็จ",
              showConfirmButton: false,
              timer: 1500,
            }).then(() => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "เกิดข้อผิดพลาด",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
      });
    },
    savedate: async () => {
      let date = $("#date_number");

      if (!date.val()) {
        Swal.fire({
          icon: "warning",
          title: "โปรดเลือกวันที่",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        await $.ajax({
          type: "POST",
          dataType: "json",
          url: "./controllers/Dashboard.php",
          data: {
            function: "date",
            date: date.val(),
          },
          success: (results) => {
            if (results.status) {
              Swal.fire({
                icon: "success",
                title: "บันทึกสำเร็จ",
                showConfirmButton: false,
                timer: 1500,
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                showConfirmButton: false,
                timer: 1500,
              });
            }
          },
        });
      }
    },
    get_date: async () => {
      await $.ajax({
        type: "POST",
        dataType: "json",
        url: "./controllers/Dashboard.php",
        data: {
          function: "getdate",
        },
        success: (results) => {
          let item = "<option value selected>เลือกวันที่</option>";
          if (results.data.length > 0) {
            let data = results.data;

            main.data.dataDate = results.data;

            data.forEach((el, index) => {
              item += `<option value="${el.id}" >${el.date}</option>`;
            });
          }
          $("#date-select").html(item);
        },
      });
    },
    get_datetable: async () => {
      await $.ajax({
        type: "POST",
        dataType: "json",
        url: "./controllers/Dashboard.php",
        data: {
          function: "getdatetable",
        },
        success: (results) => {
          if (results.data.length > 0) {
            let data = results.data;
            let item = "";
            let action = "";

            for (let i in data) {
              if (data[i].is_active == 0) {
                action = ":p";
              } else {
                action = "1";
              }
              item += `
                  <tr>
                      <td>${data[i].date}</td>
                      <td>${action}</td>
                  </tr>
              `;
            }
            $(".contentdate").html(item);
          }
        },
      });
    },
  },
  init() {
    this.ajax.loaddata();
    this.ajax.get_date();
    this.ajax.get_datetable();

    $(document).on("click", ".save-data", (e) => {
      let obj = $(e.target).closest(".save-data");
      let attr = obj.attr("data-module");
      this.ajax.save_jsonpay(attr);
    });
    $(document).on("click", ".save-data-date", (e) => {
      this.ajax.savedate();
    });
  },
};
$(document).ready(function () {
  main.init();
  $("#tabledate").DataTable({
    responsive: true,
    autoWidth: false,
  });
  $("#datatable")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#datatable_wrapper .col-md-6:eq(0)");
});
