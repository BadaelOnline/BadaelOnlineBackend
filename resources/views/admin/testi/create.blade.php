@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.testi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="Photo" class="col-sm-2 col-form-label">Photo</label>

            <div class="col-sm-7">

                <input type="file" name='photo' class="form-control {{$errors->first('photo') ? "is-invalid" : "" }} " value="{{old('photo')}}" id="photo">

                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>

            </div>

        </div>

        @foreach(config('app.languages') as $index => $lang)

        <div class="form-group ml-5">

            <label for="name" class="col-sm-2 col-form-label">Name [{{ $lang }}]</label>

            <div class="col-sm-7">

                <input type="text" name='testimonial[{{$index}}][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                <input type="text" name='testimonial[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="profession" class="col-sm-2 col-form-label">Profession [{{ $lang }}]</label>

            <div class="col-sm-7">

                <input type="text" name='testimonial[{{$index}}][profession]' class="form-control {{$errors->first('profession') ? "is-invalid" : "" }} " value="{{old('profession')}}" id="profession">
                <input type="text" name='testimonial[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('profession') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="desc" class="col-sm-2 col-form-label">Testi [{{ $lang }}]</label>

            <div class="col-sm-7">

                <textarea name="testimonial[{{$index}}][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('desc')}}</textarea>
                <input type="text" name='testimonial[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('desc') }}
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
