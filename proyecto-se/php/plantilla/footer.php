
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!--
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
	<script src="assets/scripts/jquery.min.js"></script>
	<script src="assets/scripts/modernizr.min.js"></script>
	<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="assets/plugin/nprogress/nprogress.js"></script>
	<script src="assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="assets/plugin/waves/waves.min.js"></script>
	<!-- Full Screen Plugin -->
	<script src="assets/plugin/fullscreen/jquery.fullscreen-min.js"></script>

    <!-- Remodal -->
    <script src="assets/plugin/modal/remodal/remodal.min.js"></script>

    <!-- Data Tables -->
    <script src="assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>



    <script src="assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.0/js/buttons.print.min.js"></script>
<!--    <script src="assets/scripts/datatables.demo.js"></script>-->

	<!-- Flex Datalist -->
	<script src="assets/plugin/flexdatalist/jquery.flexdatalist.min.js"></script>

	<!-- Popover -->
	<script src="assets/plugin/popover/jquery.popSelect.min.js"></script>

	<!-- Select2 -->
	<script src="assets/plugin/select2/js/select2.min.js"></script>

	<!-- Multi Select -->
	<script src="assets/plugin/multiselect/multiselect.min.js"></script>

	<!-- Touch Spin -->
	<script src="assets/plugin/touchspin/jquery.bootstrap-touchspin.min.js"></script>

	<!-- Timepicker -->
	<script src="assets/plugin/timepicker/bootstrap-timepicker.min.js"></script>

	<!-- Colorpicker -->
	<script src="assets/plugin/colorpicker/js/bootstrap-colorpicker.min.js"></script>


	<!-- Datepicker -->
	<script src="assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
    <!--    EN DATEPICKER DECIDI UTILIZAR EL JAVASCRIPT NO COMPRIMIDO POR LA EDICION-->

	<!-- Moment -->
	<script src="assets/plugin/moment/moment.js"></script>

	<!-- DateRangepicker -->
	<script src="assets/plugin/daterangepicker/daterangepicker.js"></script>

	<!-- Maxlength -->
	<script src="assets/plugin/maxlength/bootstrap-maxlength.min.js"></script>

	<!-- Demo Scripts -->
<!--	<script src="assets/scripts/form.demo.min.js"></script>-->
    <script src="assets/scripts/form.demo.js"></script>

<!--    AQUI TAMBIEN DECIDI USAR LA VERSION NO COMPRIMIDA DE JAVASCRIPT-->

	<script src="assets/scripts/main.min.js"></script>
	<script src="assets/color-switcher/color-switcher.min.js"></script>



<script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "language":{
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningun dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Ultimo",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "pagingType": "full_numbers",
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        className: 'btn btn-secondary',
                        autoPrint: true
                    }
                ]
            });
        });

</script>



<!-- Remodal -->
<script src="assets/plugin/modal/remodal/remodal.min.js"></script>


    <script>
        $( "form" ).submit(function( event ) {
            $('input[type=text]').val (function () {
                return this.value.toUpperCase();
            })
        });
    </script>
    <script>
        var letters=' ABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ'
        var numbers='1234567890'
        var signs=',.:;@-\''
        var mathsigns='+-=()*/'
        var custom='<>#$%&?¿'

        function validacion(e,allow) {
            var k;
            k=document.all?parseInt(e.keyCode): parseInt(e.which);
            return (allow.indexOf(String.fromCharCode(k))!=-1);
        }

    </script>

</body>
</html>