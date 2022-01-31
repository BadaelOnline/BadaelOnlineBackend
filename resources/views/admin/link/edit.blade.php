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

<form action="{{ route('admin.link.update',$link->id) }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('link.Ulink')}}</h2>
    </div>

    {{-- name --}}
    <div class="form-group ml-3 col-sm-7">
        <div class="rowInput">

            <div class="en col-sm-9">
                <label class="col-sm-6 col-form-label">{{ __('link.Nenglish') }}</label>

                <input type="text" name='links[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $link->name}}" id="name">
                <input type="text" name='links[en][local]' value='en' hidden>

                @error('links.en.name')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror
            </div>

            <div class="ar col-sm-9">
                <label class="col-sm-6 col-form-label"{{ __('link.Narabic') }}</label>

                <input type="text" name='links[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $link->name}}" id="name">
                <input type="text" name='links[ar][local]' value='ar' hidden>

                @error('links.ar.name')
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

        <label for="link" class="col-sm-2 col-form-label ml-3">{{ __('link.link') }}</label>

        <div class="col-sm-7">

            <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} " value="{{old('link') ? old('link') : $link->link}}" id="link">

            <div class="invalid-feedback">
                {{ $errors->first('link') }}
            </div>

        </div>

    </div>

    <div class="form-group ml-4">

        <div class="col-sm-3">

            <button type="submit" class="btn btn-primary">{{ __('link.update') }}</button>

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
