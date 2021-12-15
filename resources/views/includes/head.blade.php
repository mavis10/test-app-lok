<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Lok</title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
<link href="/css/layout.min.css" rel="stylesheet" type="text/css">
<link href="/css/components.min.css" rel="stylesheet" type="text/css">
<link href="/css/colors.min.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="/js/main/jquery.min.js"></script>
<script src="/js/main/bootstrap.bundle.min.js"></script>
<script src="/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="/js/app.js"></script>
<!-- /theme JS files -->

<script>
$(function () {
$.ajaxSetup({
 headers: {
     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
 }
});
});
</script>