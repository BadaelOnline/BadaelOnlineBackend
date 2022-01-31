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

<form action="{{ route('admin.tag.store') }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('tag.Ctag')}}</h2>
    </div>

    <div class="container">

        {{-- name --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('tag.Nenglish') }}</label>

                    <input type="text" name='tag[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                    <input type="text" name='tag[en][local]' value='en' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('tag.Narabic') }}</label>

                    <input type="text" name='tag[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                    <input type="text" name='tag[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- keyword --}}

        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('tag.Kenglish') }}</label>

                    <input type="text" name='tag[en][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword">
                    <input type="text" name='tag[en][local]' value='en' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('keyword') }}
                    </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('tag.Karabic') }}</label>

                    <input type="text" name='tag[ar][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword">
                    <input type="text" name='tag[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('keyword') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- desc --}}

        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('tag.Denglish') }}</label>

                    <input type="text" name='tag[en][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc">
                    <input type="text" name='tag[en][local]' value='en' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('meta_desc') }}
                    </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('tag.Darabic') }}</label>

                    <input type="text" name='tag[ar][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc">
                    <input type="text" name='tag[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('meta_desc') }}
                    </div>
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

                <button type="submit" class="btn btn-primary">{{ __('tag.create') }}</button>

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
