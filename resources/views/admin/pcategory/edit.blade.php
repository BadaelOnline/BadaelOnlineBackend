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

<form action="{{ route('admin.pcategory.update',$pcategory->id) }}" method="POST">
    @csrf

    <div class="container">

        {{-- name --}}

        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">
    
                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('pcategory.Nenglish') }}</label>
                    
                    <input type="text" name='pcategory[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $pcategory->name}}" id="name" placeholder="Name">
                    <input type="text" name='pcategory[en][local]' value='en' hidden>
    
                    @error('pcategory.en.name')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>
    
                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('pcategory.Narabic') }}</label>
    
                    <input type="text" name='pcategory[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $pcategory->name}}" id="name" placeholder="Name">
                    <input type="text" name='pcategory[ar][local]' value='ar' hidden>

                    @error('pcategory.ar.name')
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

                <button type="submit" class="btn btn-primary">{{ __('pcategory.update') }}</button>

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
