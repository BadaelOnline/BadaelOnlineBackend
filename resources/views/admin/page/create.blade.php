@extends('layouts.admin')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.page.store') }}" method="POST">
    @csrf

    <div class="container">

        @foreach(config('app.languages') as $index => $lang)

        <div class="form-group ml-2">

            <label for="title" class="col-sm-2 col-form-label">Title [{{ $lang }}]</label>

            <div class="col-sm-10">

                <input type="text" name='page[{{$index}}][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
                <input type="text" name='page[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-2">

            <label for="text" class="col-sm-2 col-form-label">Text [{{ $lang }}]</label>

            <div class="col-sm-10">

                <textarea name="page[{{$index}}][text]" class="form-control {{$errors->first('text') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('text')}}</textarea>
                <input type="text" name='page[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('text') }}
                </div>

            </div>

        </div>

        @endforeach

        <div class="form-group ml-2">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">Create</button>

            </div>

        </div>

    </div>

  </form>
@endsection
