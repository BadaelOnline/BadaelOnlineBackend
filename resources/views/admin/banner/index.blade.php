@extends('layouts.admin')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">
         <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">{{__('banner.banner')}}</h1>
         @if (session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
           <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-md">{{__('banner.Cbanner')}}</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>{{__('banner.no')}}</th>
                    <th>{{__('banner.cover')}}</th>
                    <th>{{__('banner.title')}}</th>
                    <th>{{__('banner.desc')}}</th>
                    <th>{{__('banner.link')}}</th>
                    <th>{{__('banner.option')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                    $no=0;
                    @endphp
                @foreach ($banner as $banner)
                  <tr class="col-sm-12">
                    <td class="col-sm-1">{{ ++$no }}</td>
                    <td class="col-sm-2">
                        <img src="{{ asset('storage/'.$banner->cover) }}" alt="" height="50px" width="50px">
                    </td>
                    <td class="col-sm-2">{{ $banner->title }}</td>
                    <td class="col-sm-3">{{Str::limit( strip_tags( $banner->desc ), 30 )}}</td>
                    <td class="col-sm-2">{{ $banner->link }}</td>
                    <td class="col-sm-2">
                        <a href="{{route('admin.banner.edit', [$banner->id])}}" class="btn btn-info btn-sm"> {{__('banner.edit')}} </a>

                        <form method="POST" action="{{route('admin.banner.destroy', [$banner->id])}}" class="d-inline" onsubmit="return confirm('Delete this banner permanently?')">

                            @csrf

                            <input type="hidden" name="_method" value="DELETE">

                            <input type="submit" value="{{__('banner.del')}}" class="btn btn-danger btn-sm">

                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
@endsection
