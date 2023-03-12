<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/fontawesom.min.js"></script>
<script src="./js/sweetalert2.all.min.js"></script>
<script src="./js/select2.min.js"></script>

<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap4.min.js"></script>
<script src="./js/dataTables.responsive.min.js"></script>
<script src="./js/responsive.bootstrap4.min.js"></script>
<script src="./js/dataTables.buttons.min.js"></script>
<script src="./js/buttons.bootstrap4.min.js"></script>
<script src="./js/jszip.min.js"></script>
<script src="./js/pdfmake.min.js"></script>
<script src="./js/vfs_fonts.js"></script>
<script src="./js/buttons.html5.min.js"></script>
<script src="./js/buttons.print.min.js"></script>
<script src="./js/buttons.colVis.min.js"></script>



<script>
    $(document).ready(function(e) {
        $('.select2').select2()
        setTimeout(() => {
            $('.body-content').css('display', 'unset')
            $('.bg-loader ').remove()
            $('.loader').remove()
        }, 1000);
    })
</script>