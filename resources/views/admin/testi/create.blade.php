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

<form action="{{ route('admin.testi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('testi.Ctesti')}}</h2>
    </div>

    <div class="container">

        <div class="form-group ml-4">

            <label for="Photo" class="col-sm-2 col-form-label">{{ __('testi.photo') }}</label>

            <div class="col-sm-7">

                <input type="file" name='photo' class="form-control {{$errors->first('photo') ? "is-invalid" : "" }} " value="{{old('photo')}}" id="photo">

                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>

            </div>

        </div>

        {{-- name --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('testi.Nenglish') }}</label>

                    <input type="text" name='testimonial[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                    <input type="text" name='testimonial[en][local]' value='en' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('testi.Narabic') }}</label>

                    <input type="text" name='testimonial[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name">
                    <input type="text" name='testimonial[ar][local]' value='ar' hidden>

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

        {{-- Profession --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('testi.Penglish') }}</label>

                    <input type="text" name='testimonial[en][profession]' class="form-control {{$errors->first('profession') ? "is-invalid" : "" }} " value="{{old('profession')}}" id="profession">
                    <input type="text" name='testimonial[en][local]' value='en' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('profession') }}
                    </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('testi.Parabic') }}</label>

                    <input type="text" name='testimonial[ar][profession]' class="form-control {{$errors->first('profession') ? "is-invalid" : "" }} " value="{{old('profession')}}" id="profession">
                    <input type="text" name='testimonial[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('profession') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- Testimonial --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('testi.Tenglish') }}</label>

                    <textarea name="testimonial[en][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('desc')}}</textarea>
                    <input type="text" name='testimonial[en][local]' value='en' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('testi.Tarabic') }}</label>

                    <textarea name="testimonial[ar][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('desc')}}</textarea>
                    <input type="text" name='testimonial[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
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

                <button type="submit" class="btn btn-primary">{{ __('testi.create') }}</button>

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
