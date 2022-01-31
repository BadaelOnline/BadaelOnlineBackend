@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('page.page') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.page.create') }}" class="btn btn-success">{{ __('page.Cpage') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('page.no') }}</th>

                        <th>{{ __('page.title') }}</th>

                        <th>{{ __('page.text') }}</th>

                        <th>{{ __('page.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($page as $page)

                    <tr class="col-sm-12">

                        <td class="col-sm-2">{{ ++$no }}</td>

                        <td class="col-sm-2">{{ $page->title }}</td>

                        <td class="col-sm-4">{{ $page->text }}</td>

                        <td class="col-sm-4">

                            <a href="{{route('admin.page.edit', [$page->id])}}" class="btn btn-info btn-sm"> {{ __('page.edit') }} </a>

                            <form method="POST" action="{{route('admin.page.destroy', [$page->id])}}" class="d-inline" onsubmit="return confirm('Delete this page permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('page.del') }}" class="btn btn-danger btn-sm">

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
