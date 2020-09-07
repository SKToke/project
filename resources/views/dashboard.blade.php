@extends('layouts.master')

@section('title', 'Dashboard')

@push('header')
    <script>
        window.appHelper = {
            routes: {!! json_encode(
        [
            'initial' => route('projectDetailsList'),
            'project' => route('calculateByProject')
        ]
        ) !!} };
    </script>
    {{--    <link href="{{ asset("assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}" rel="stylesheet">--}}
@endpush
@section("content")
    <main class="c-main mt-0 pt-0">
        <div class="container-fluid">
            <div class="fade-in">
                <div id="dashboard">
                    <dashboard></dashboard>
                </div>
            </div>
        </div>
    </main>
@endsection

@push("footer")
    {{--    <script src="{{ asset("assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}"></script>--}}
    <script src="{{ asset("assets/js/dashboard/dashboard-main.js") }}"></script>
@endpush
