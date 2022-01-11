@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.category.store') }}" method="POST">
    @csrf

    <div class="container">

        @foreach(config('app.languages') as $index => $lang)

        <div class="form-group ml-5">

            <label for="name" class="col-sm-2 col-form-label">Name [{{$lang}}]</label>

            <div class="col-sm-7">

                <input type="text" name='category[{{$index}}][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="Name">
                <input type="text" name='category[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}    
                </div>   

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="keyword" class="col-sm-2 col-form-label">Keyword [{{$lang}}]</label>

            <div class="col-sm-7">

                <input type="text" name='category[{{$index}}][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword" placeholder="Keyword">
                <input type="text" name='category[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('keyword') }}    
                </div>   

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="meta_desc" class="col-sm-2 col-form-label">Meta Desc [{{$lang}}]</label>

            <div class="col-sm-7">

                <input type="text" name='category[{{$index}}][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc" placeholder="Meta Description">
                <input type="text" name='category[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('meta_desc') }}    
                </div>   

            </div>

        </div>

        @endforeach
   
        <div class="form-group ml-5">
   
            <div class="col-sm-3">
   
                <button type="submit" class="btn btn-primary">Create</button>
   
            </div>
   
        </div>

    </div>      

  </form>
@endsection