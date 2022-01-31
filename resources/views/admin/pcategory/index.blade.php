@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<style>
    .rowInput {
        display: flex;
        gap: 15px;
    }
</style>

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('pcategory.pcategory') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <form class="form-inline" action="{{ route('admin.pcategory.store') }}" method="POST">
            @csrf

            <div class="form-group ml-2 col-sm-7">
                <div class="rowInput">
        
                    <div class="en col-sm-9">        
                        <input type="text" name='pcategory[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="{{ __('pcategory.Nenglish') }}">
                        <input type="text" name='pcategory[en][local]' value='en' hidden>
        
                        @error('pcategory.en.name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
        
                    <div class="ar col-sm-9">        
                        <input type="text" name='pcategory[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="{{ __('pcategory.Narabic') }}">
                        <input type="text" name='pcategory[ar][local]' value='ar' hidden>
        
                        @error('pcategory.ar.name')
                            <small class="form-text text-danger"> {{ $message }}</small>
                        @enderror
                    </div>
        
                    <select class="form-control col-sm-4 selectLang" id="selectLang">
                        @foreach(config('app.languages') as $index => $lang)
                        <option id="lang">{{ $lang }}</option>
                        @endforeach
                    </select>
        
                </div>
            </div>

            <button type="submit" class="btn btn-primary mb-2">{{ __('pcategory.create') }}</button>
          </form>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('pcategory.no') }}</th>

                        <th>{{ __('pcategory.name') }}</th>

                        <th>{{ __('pcategory.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($pcategory as $pcategory)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>{{ $pcategory->name }}</td>

                        <td>

                            <a href="{{route('admin.pcategory.edit', [$pcategory->id])}}" class="btn btn-info btn-sm"> {{ __('pcategory.edit') }} </a>

                            <form method="POST" action="{{route('admin.pcategory.destroy', [$pcategory->id])}}" class="d-inline" onsubmit="return confirm('Delete this pcategory permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('pcategory.del') }}" class="btn btn-danger btn-sm">

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

@push('scripts')

<script>
  // language
  window.onload = function () {
        if(localStorage.getItem('local') == 'en'){
                $('.ar').css({display: "none"});
                $('.en').css({display: "block"});
        }else{
                $('.ar').css({display: "block"});
                $('.en').css({display: "none"});
        }
    }

    $(function () {
        $(".selectLang").change(function() {
            var val = $(this).val();
            localStorage.setItem('local',val);
            if(localStorage.getItem('local') == 'en'){
                $('.ar').css({display: "none"});
                $('.en').css({display: "block"});
        }else{
                $('.ar').css({display: "block"});
                $('.en').css({display: "none"});
        }
        });
    });
</script>
@endpush