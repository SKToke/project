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
<main class="c-main pt-0">
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
    <script src="{{ asset("assets/js/dashboard/project-main.js") }}"></script>
@endpush
