@extends('layouts.admin')

@section('content')

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

<form action="{{ route('admin.category.store') }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('category.Ccategory')}}</h2>
    </div>

        {{-- name --}}

        <div class="form-group ml-3 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('category.Nenglish') }}</label>

                    <input type="text" name='category[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                    <input type="text" name='category[en][local]' value='en' hidden>

                    @error('category.en.name')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('category.Narabic') }}</label>
                    <input type="text" name='category[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                    <input type="text" name='category[ar][local]' value='ar' hidden>

                    @error('category.ar.name')
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

        {{-- keyword --}}

        <div class="form-group ml-3 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('category.Kenglish') }}</label>


                    <input type="text" name='category[en][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword">
                    <input type="text" name='category[en][local]' value='en' hidden>

                    @error('category.en.keyword')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('category.Karabic') }}</label>

                    <input type="text" name='category[ar][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword">
                    <input type="text" name='category[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('keyword') }}
                    </div>
                @error('category.ar.keyword')
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

    {{-- meta desc --}}
    <div class="form-group ml-3 col-sm-7">
        <div class="rowInput">

            <div class="en col-sm-9">
                <label class="col-sm-6 col-form-label">{{ __('category.Denglish') }}</label>

                <input type="text" name='category[en][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc">
                <input type="text" name='category[en][local]' value='en' hidden>

                @error('category.en.meta_desc')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

            <div class="ar col-sm-9">
                <label class="col-sm-6 col-form-label">{{ __('category.Darabic') }}</label>

                <input type="text" name='category[ar][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc">
                <input type="text" name='category[ar][local]' value='ar' hidden>

                @error('category.ar.meta_desc')
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

                <button type="submit" class="btn btn-primary">{{ __('category.create') }}</button>

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
