@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('post.post') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.post.create') }}" class="btn btn-success">{{ __('post.Cpost') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('post.no') }}</th>

                        <th>{{ __('post.cover') }}</th>

                        <th>{{ __('post.title') }}</th>

                        <th>{{ __('post.keyword') }}</th>

                        <th>{{ __('post.status') }}</th>

                        <th>{{ __('post.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($post as $post)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>

                            <img src="{{asset('storage/' . $post->cover)}}" width="96px"/>

                        </td>

                        <td>{{ $post->title }}</td>

                        <td>{{ $post->category->name }}</td>

                        <td>{{ $post->status }}</td>

                        <td>

                            <a href="{{route('admin.post.edit', [$post->id])}}" class="btn btn-info btn-sm"> {{ __('post.edit') }} </a>

                            <form method="POST" class="d-inline" onsubmit="return confirm('Move post to trash ?')" action="{{route('admin.post.destroy', $post->id)}}">
                                @csrf

                                <input type="hidden" value="DELETE" name="_method">

                                <input type="submit" value="{{ __('post.trash') }}" class="btn btn-danger btn-sm">

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
