<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?php if(isset($title)){echo $title; } else echo config('app.name'); ?></title>
<meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta  name="csrf-token" content="{{ csrf_token() }}" />
<!-- bootstrap & fontawesome -->
<link rel="icon" type="image/png" href="{{asset('admin/assets/images/favicon.ico')}}">
<link href="{{asset('user/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('user/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('user/css/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('user/css/styles.css')}}" rel="stylesheet">
<link href="{{asset('user/css/ipad.css')}}" rel="stylesheet">

<!--Custom Font-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<!--[if lt IE 9]>
<script src="{{asset('user/js/html5shiv.js')}}"></script>
<script src="{{asset('user/js/respond.min.js')}}"></script>
<![endif]-->
