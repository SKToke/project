@extends('layouts.master')

@section('title', 'Project List')

@push('header')
    <script>
        window.appHelper = {
            routes: {!! json_encode(
        [
            'project' => route('project'),
            'projectList' => route('projectList'),
        ]
        ) !!} };
    </script>
    <link href="{{ asset("assets/font-awesome/all.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/sweetalert2/sweetalert2.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/toastr/toastr.min.css") }}" rel="stylesheet">
@endpush

@section("content"){{--
    <main class="c-main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Payments</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Salary</a>
            </li>
            <li class="breadcrumb-item active">Salary Grade</li>
        </ol>
        <div class="container-fluid">
            <div class="fade-in">
                <div id="project">
                    <project></project>
                </div>
            </div>
        </div>
    </main>--}}
<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Project</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card card-accent-info" id="project">
                <project></project>
            </div>
        </div>
    </div>
</main>
@endsection

@push("footer")
    <script src="{{ asset("assets/font-awesome/all.js") }}"></script>
    <script src="{{ asset("assets/sweetalert2/sweetalert2.min.js") }}"></script>
    <script src="{{ asset("assets/toastr/toastr.min.js") }}"></script>
    <script src="{{ asset("assets/js/dashboard/project-main.js") }}"></script>
@endpush
