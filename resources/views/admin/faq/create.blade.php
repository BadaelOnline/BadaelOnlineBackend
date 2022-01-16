@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.faq.store') }}" method="POST">
    @csrf

    <div class="container">

        @foreach(config('app.languages') as $index => $lang)

        <div class="form-group ml-5">

            <label for="question" class="col-sm-2 col-form-label">Question [{{ $lang }}]</label>

            <div class="col-sm-7">

                <input type="text" name='faq[{{$index}}][question]' class="form-control {{$errors->first('question') ? "is-invalid" : "" }} " value="{{old('question')}}" id="question" placeholder="Question">
                <input type="text" name='faq[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('question') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="answer" class="col-sm-2 col-form-label">Answer [{{ $lang }}]</label>

            <div class="col-sm-7">

                <textarea name="faq[{{$index}}][answer]" class="form-control {{$errors->first('answer') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('answer')}}</textarea>
                <input type="text" name='faq[{{$index}}][local]' value='{{$lang}}' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('answer') }}
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
