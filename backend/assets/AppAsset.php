<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
        'assets/plugins/fontawesome-free/css/all.min.css',
        'assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
        'assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
        'assets/plugins/select2/css/select2.min.css',
        'assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        'assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'assets/plugins/toastr/toastr.min.css',
        'assets/plugins/dropzone/min/dropzone.min.css',
        'assets/dist/css/jquery.datetimepicker.min.css',
        'assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css',
        'assets/dist/css/adminlte.min.css',
        'assets/dist/css/styles.css',
        'assets/plugins/summernote/summernote-bs4.min.css',
        
    ];
    public $js = [
        'assets/plugins/jquery/jquery.min.js',
        'assets/plugins/jquery-ui/jquery-ui.min.js',
        'assets/plugins/sweetalert2/sweetalert2.min.js',
        'assets/plugins/toastr/toastr.min.js',
        'assets/plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js',
        'assets/plugins/select2/js/select2.full.min.js',
        'assets/plugins/summernote/summernote-bs4.min.js',
        'assets/plugins/dropzone/min/dropzone.min.js',
        'assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js',
        'assets/dist/js/jquery.datetimepicker.full.min.js',
        'assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'assets/plugins/moment/moment.min.js',

        'assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'assets/dist/js/adminlte.js',

        'assets/plugins/jquery-mousewheel/jquery.mousewheel.js',
        'assets/plugins/raphael/raphael.min.js',
        'assets/plugins/jquery-mapael/jquery.mapael.min.js',
        'assets/plugins/jquery-mapael/maps/usa_states.min.js',
        'assets/plugins/chart.js/Chart.min.js',

        'assets/dist/js/demo.js',
        'assets/dist/js/pages/dashboard2.js',
        'assets/plugins/datatables/jquery.dataTables.min.js',
        'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
        'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js',
        'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
        'assets/plugins/datatables-buttons/js/dataTables.buttons.min.js',
        'assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
        'assets/plugins/jszip/jszip.min.js',
        'assets/plugins/pdfmake/pdfmake.min.js',
        'assets/plugins/pdfmake/vfs_fonts.js',
        'assets/plugins/datatables-buttons/js/buttons.html5.min.js',
        'assets/plugins/datatables-buttons/js/buttons.print.min.js',
        'assets/plugins/datatables-buttons/js/buttons.colVis.min.js',
        'assets/customjs/ajax-modal-popup.js',

    ];
    // public $depends = [
    //     'yii\web\YiiAsset',
    //     'yii\bootstrap\BootstrapAsset',
    // ];
}
