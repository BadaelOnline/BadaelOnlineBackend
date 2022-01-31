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

@section('styles')
<style>
.rowInput {
    display: flex;
    gap: 15px;
}
.selectLang {
    margin-top: 38px;
}
</style>
@endsection

<form action="{{ route('admin.page.store') }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('page.Cpage')}}</h2>
    </div>

        {{-- title --}}

        <div class="form-group ml-3 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('page.Tenglish') }}</label>

                    <input type="text" name='page[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title">
                    <input type="text" name='page[en][local]' value='en' hidden>

                    @error('page.en.title')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('page.Tarabic') }}</label>

                    <input type="text" name='page[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title">
                    <input type="text" name='page[ar][local]' value='ar' hidden>

                    @error('page.ar.title')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- text --}}
        <div class="form-group ml-3 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('page.Denglish') }}</label>

                    <textarea name="page[en][text]" class="form-control {{$errors->first('text') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="20">{{old('text')}}</textarea>
                    <input type="text" name='page[en][local]' value='en' hidden>

                    @error('page.en.text')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('page.Darabic') }}</label>

                    <textarea name="page[ar][text]" class="form-control {{$errors->first('text') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="20">{{old('text')}}</textarea>
                    <input type="text" name='page[ar][local]' value='ar' hidden>

                    @error('page.ar.text')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="form-group ml-4">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('page.create') }}</button>

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
