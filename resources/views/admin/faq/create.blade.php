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

<form action="{{ route('admin.faq.store') }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('faq.Cfaq')}}</h2>
    </div>

        {{-- question --}}
        <div class="form-group ml-3 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('faq.Qenglish') }}</label>

                    <input type="text" name='faq[en][question]' class="form-control {{$errors->first('question') ? "is-invalid" : "" }} " value="{{old('question')}}" id="question">
                    <input type="text" name='faq[en][local]' value='en' hidden>

                    @error('faq.en.question')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('faq.Qarabic') }}</label>

                    <input type="text" name='faq[ar][question]' class="form-control {{$errors->first('question') ? "is-invalid" : "" }} " value="{{old('question')}}" id="question">
                    <input type="text" name='faq[ar][local]' value='en' hidden>

                    @error('faq.ar.question')
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

        {{-- answer --}}

        <div class="form-group ml-3 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('faq.ANenglish') }}</label>

                    <textarea name="faq[en][answer]" class="form-control {{$errors->first('answer') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('answer')}}</textarea>
                    <input type="text" name='faq[en][local]' value='en' hidden>

                    @error('faq.en.answer')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('faq.ANarabic') }}</label>

                    <textarea name="faq[ar][answer]" class="form-control {{$errors->first('answer') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('answer')}}</textarea>
                    <input type="text" name='faq[ar][local]' value='ar' hidden>

                    @error('faq.ar.answer')
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

                <button type="submit" class="btn btn-primary">{{ __('faq.create') }}</button>

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
