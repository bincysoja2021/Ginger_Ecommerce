
@extends('layouts.app')

@section('content')
<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">
        


        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content 403-forbidden">

            <div class="not-found-wrap text-center">
    <h1 class="text-60"></h1>
    <p class="text-36 subheading mb-3">Error!</p>
    <p class="mb-5 text-muted text-18">Sorry! You dont have permission to view this page.</p><a class="btn btn-lg btn-primary btn-rounded" href="{{URL::previous()}}">Go back</a>
</div>


            </div>
        </div>
    </div>
</body>
<!--============Search UI End=============-->
@endsection