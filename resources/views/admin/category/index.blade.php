@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('category.categories') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.category.create') }}" class="btn btn-success">{{ __('category.Ccategory') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('category.no') }}</th>

                        <th>{{ __('category.name') }}</th>

                        {{-- <th>Slug</th> --}}

                        <th>{{ __('category.keyword') }}</th>

                        <th>{{ __('category.desc') }}</th>

                        <th>{{ __('category.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($category as $category)

                    <tr class="col-sm-12">

                        <td class="col-sm-1">{{ ++$no }}</td>

                        <td class="col-sm-2">{{ $category->name }}</td>

                        {{-- <td>{{ $category->slug }}</td> --}}

                        <td class="col-sm-2">{{ $category->keyword }}</td>

                        <td class="col-sm-4">{{ $category->meta_desc }}</td>

                        <td class="col-sm-3">

                            <a href="{{route('admin.category.edit', [$category->id])}}" class="btn btn-info btn-sm"> {{ __('category.edit') }} </a>

                            <form method="POST" action="{{route('admin.category.destroy', [$category->id])}}" class="d-inline" onsubmit="return confirm('Delete this category permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('category.del') }}" class="btn btn-danger btn-sm">

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
