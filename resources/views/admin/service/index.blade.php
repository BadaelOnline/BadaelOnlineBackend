@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('service.service') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.service.create') }}" class="btn btn-success">{{ __('service.Cservice') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('service.no') }}</th>

                        <th>{{ __('service.image') }}</th>

                        <th>{{ __('service.title') }}</th>

                        <th>{{  __('service.Desc') }}</th>

                        <th>{{ __('service.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($service as $service)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>

                            <img src="{{ asset('storage/'.$service->icon) }}" alt="" style="height: 100px; width: 200px">

                        </td>

                        <td>{{ $service->title }}</td>

                        <td>{{ $service->quote }}</td>

                        <td>

                            <a href="{{route('admin.service.edit', [$service->id])}}" class="btn btn-info btn-sm"> {{ __('service.edit') }} </a>

                            <form method="POST" action="{{route('admin.service.destroy', [$service->id])}}" class="d-inline" onsubmit="return confirm('Delete this service permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('service.del') }}" class="btn btn-danger btn-sm">

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
