<!DOCTYPE html>
<html lang="{{$lang}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="blank, starter">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}} &mdash; Одмінко</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="/admin/assets/css/core.min.css" rel="stylesheet">
    <link href="/admin/assets/css/app.min.css" rel="stylesheet">
    <link href="/admin/assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/admin/assets/img/apple-touch-icon.png">
    <link rel="icon" href="/admin/assets/img/favicon.png">
    <link rel="stylesheet" href="/admin/assets/vendor/dropzone/min/dropzone.min.css">

    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script> -->
<!--
    <script>tinymce.init({
    selector:'textarea',
    fontsize_formats: "8px 10px 12px 14px 16px 18px 24px 36px",
    plugins: 'print preview fullpage powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap mentions quickbars linkchecker emoticons',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl',
    });
</script> -->

    <style>
        textarea{
            min-height: 800px;
        }
    </style>
</head>

<body>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
    </div>
</div>


<!-- Sidebar -->
<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
    @include('admin._includes.l_menu')
</aside>
<!-- END Sidebar -->


<!-- Topbar -->
@include('admin._includes.header')
<!-- END Topbar -->


<!-- Main container -->
<main>
    <div class="main-content">
        @yield('main')
    </div><!--/.main-content -->
    <!-- Footer -->
    @include('admin._includes.footer')
    <!-- END Footer -->

</main>
<!-- END Main container -->



<!-- Global quickview -->
<div id="qv-global" class="quickview" data-url="/admin/assets/data/quickview-global.html">
    <div class="spinner-linear">
        <div class="line"></div>
    </div>
</div>
<!-- END Global quickview -->


@yield('modals')
<!-- Scripts -->
<script src="/admin/assets/js/core.min.js"></script>
<script src="/admin/assets/js/app.min.js"></script>
<script src="/admin/assets/js/script.min.js"></script>
<script src="/admin/assets/vendor/dropzone/min/dropzone.min.js"></script>
@if(!empty($translit) && count($translit) > 1)
    @include('admin.scripts.translit')
@endif
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')

<script src="/admin/assets/js/ckeditor/ckeditor.js"></script>

<script>


    CKEDITOR.replace( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



<script>
    $(document).ready(function() {
        $('.multi-select-area').select2();
    });
</script>



</body>
</html>
