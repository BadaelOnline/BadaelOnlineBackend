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

        <div class="form-group ml-5">

            <label for="lang" class="col-sm-2 col-form-label">Languages</label>

            <div class="col-sm-9">
                <select class="form-control" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- title --}}
        <div class="form-group ml-2 en">

            <label for="title" class="col-sm-2 col-form-label">Title English</label>

            <div class="col-sm-10">

                <input type="text" name='page[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
                <input type="text" name='page[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-2 ar">

            <label for="title" class="col-sm-2 col-form-label">Title Arabic</label>

            <div class="col-sm-10">

                <input type="text" name='page[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
                <input type="text" name='page[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>

            </div>

        </div>

        {{-- text --}}
        <div class="form-group ml-2 en">

            <label for="text" class="col-sm-2 col-form-label">Text English</label>

            <div class="col-sm-10">

                <textarea name="page[en][text]" class="form-control {{$errors->first('text') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('text')}}</textarea>
                <input type="text" name='page[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('text') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-2 ar">

            <label for="text" class="col-sm-2 col-form-label">Text Arabic</label>

            <div class="col-sm-10">

                <textarea name="page[ar][text]" class="form-control {{$errors->first('text') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('text')}}</textarea>
                <input type="text" name='page[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('text') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-2">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">Create</button>

            </div>

        </div>

    </div>

  </form>
@endsection

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
        $("#selectLang").change(function() {
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
