@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('user.perm') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.permission.create') }}" class="btn btn-success">{{ __('user.Cperm') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('user.no') }}</th>

                        <th>{{ __('user.name') }}</th>

                        {{-- <th>Email</th> --}}

                        <th>{{ __('user.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($permissions as $permission)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>{{ $permission->name }}</td>

                        {{-- <td>{{ $user->email }}</td> --}}

                        <td>

                            {{-- <a href="#" data-toggle="modal" data-target="#changepasswordModal" class="btn btn-primary btn-sm">Change Password</a> --}}
                            <a href="{{route('admin.permission.edit', [$permission->id])}}" class="btn btn-info btn-sm"> {{ __('user.edit') }} </a>

                            <form method="POST" action="{{route('admin.permission.destroy', [$permission->id])}}" class="d-inline" onsubmit="return confirm('Delete this permission permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('user.del') }}" class="btn btn-danger btn-sm">

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
