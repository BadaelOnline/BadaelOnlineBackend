@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('testi.testi') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.testi.create') }}" class="btn btn-success">{{ __('testi.Ctesti') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('testi.no') }}</th>

                        <th>{{ __('testi.photo') }}</th>

                        <th>{{ __('testi.name') }}</th>

                        <th>{{ __('testi.prof') }}</th>

                        <th>{{ __('testi.tes') }}</th>

                        <th>{{ __('testi.status') }}</th>

                        <th>{{ __('testi.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($testi as $testi)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>
                            @if (!empty($testi->photo))
                            <img src="{{ asset('storage/'.$testi->photo) }}" alt="" style="height: 100px; width: 100px">
                            @else
                            <img src="{{ asset('storage/images/testi/avatar.png') }}" alt="" style="height: 100px; width: 100px">
                            @endif

                        </td>

                        <td>{{ $testi->name }}</td>

                        <td>{{ $testi->profession }}</td>

                        <td>{{ substr($testi->desc,0,50) }}...</td>

                        <td>{{ $testi->status }}</td>

                        <td>

                            <a href="{{route('admin.testi.edit', [$testi->id])}}" class="btn btn-info btn-sm"> {{ __('testi.edit') }} </a>

                            <form method="POST" action="{{route('admin.testi.destroy', [$testi->id])}}" class="d-inline" onsubmit="return confirm('Delete this testi permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('testi.del') }}" class="btn btn-danger btn-sm">

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
