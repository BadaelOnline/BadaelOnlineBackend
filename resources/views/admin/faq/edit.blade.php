@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.faq.update',$faq->id) }}" method="POST">
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

        {{-- question --}}
        <div class="form-group ml-5 en">

            <label for="question" class="col-sm-2 col-form-label">Question English</label>

            <div class="col-sm-7">

                <input type="text" name='faq[en][question]' class="form-control {{$errors->first('question') ? "is-invalid" : "" }} " value="{{old('question') ? old('question') : $faq->question}}" id="question" placeholder="Question">
                <input type="text" name='faq[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('question') }}
                </div>
                @error('faq.en.question')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="question" class="col-sm-2 col-form-label">Question Arabic</label>

            <div class="col-sm-7">

                <input type="text" name='faq[ar][question]' class="form-control {{$errors->first('question') ? "is-invalid" : "" }} " value="{{old('question') ? old('question') : $faq->question}}" id="question" placeholder="Question">
                <input type="text" name='faq[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('question') }}
                </div>
                @error('faq.ar.question')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- answer --}}
        <div class="form-group ml-5 en">

            <label for="answer" class="col-sm-2 col-form-label">Answer English</label>

            <div class="col-sm-7">

                <textarea name="faq[en][answer]" class="form-control {{$errors->first('answer') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('answer') ? old('answer') : $faq->answer}}</textarea>
                <input type="text" name='faq[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('answer') }}
                </div>
                @error('faq.en.answer')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="answer" class="col-sm-2 col-form-label">Answer Arabic</label>

            <div class="col-sm-7">

                <textarea name="faq[ar][answer]" class="form-control {{$errors->first('answer') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('answer') ? old('answer') : $faq->answer}}</textarea>
                <input type="text" name='faq[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('answer') }}
                </div>
                @error('faq.ar.answer')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">Update</button>

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
