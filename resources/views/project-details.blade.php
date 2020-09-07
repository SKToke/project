@extends('layouts.master')

@section('title', 'Project Details List')

@push('header')
    <script>
        window.appHelper = {
            routes: {!! json_encode(
        [
            'projectDetails' => route('project-details'),
            'projectDetailsList' => route('projectDetailsList'),
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
        <li class="breadcrumb-item active">Project Details</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="card card-accent-info" id="project-details">
                <project-details></project-details>
            </div>
        </div>
    </div>
</main>
@endsection

@push("footer")
    <script src="{{ asset("assets/js/dashboard/project-details.js") }}"></script>
@endpush
