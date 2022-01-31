@extends('layouts.admin')

@section('styles')
<style>
.picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width: 300px;
  height: 400px;
  background-color: #999999;
  border: 4px solid #CCCCCC;
  color: #FFFFFF;
  /* border-radius: 50%; */
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.picture:hover {
  border-color: #2ca8ff;
}
.picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.picture-src {
  width: 100%;
  height: 100%;
}
.rowInput {
    display: flex;
    gap: 15px;
}
.selectLang {
    margin-top: 38px;
}
</style>

@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('service.Cservice')}}</h2>
    </div>

    <div class="container">

        <div class="form-group">
            <div class="picture-container">

                <div class="picture">

                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture" name="icon" class="form-control {{$errors->first('icon') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                    {{ $errors->first('icon') }}
                    </div>

                </div>
                <h6>{{ __('service.Scover') }}</h6>
            </div>
        </div>

        {{-- title --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('service.Tenglish') }}</label>

                    <input type="text" name='service[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title">
                    <input type="text" name='service[en][local]' value='en' hidden>

                    @error('service.en.title')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('service.Tarabic') }}</label>

                    <input type="text" name='service[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title">
                    <input type="text" name='service[ar][local]' value='ar' hidden>

                    @error('service.ar.title')
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

        {{-- quote --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('service.Qenglish') }}</label>

                    <input type="text" name='service[en][quote]' class="form-control {{$errors->first('quote') ? "is-invalid" : "" }} " value="{{old('quote')}}" id="quote">
                    <input type="text" name='service[en][local]' value='en' hidden>

                    @error('service.en.quote')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('service.Qarabic') }}</label>

                    <input type="text" name='service[ar][quote]' class="form-control {{$errors->first('quote') ? "is-invalid" : "" }} " value="{{old('quote')}}" id="quote">
                    <input type="text" name='service[ar][local]' value='ar' hidden>

                    @error('service.ar.quote')
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

        {{-- desc --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('service.Denglish') }}</label>

                    <textarea name="service[en][desc]" id="summernote" cols="40" rows="10"  class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} ">{{old('desc')}}</textarea>
                    <input type="text" name='service[en][local]' value='en' hidden>

                    @error('service.en.desc')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('service.Darabic') }}</label>

                    <textarea name="service[ar][desc]" id="summernote" cols="40" rows="10"  class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} ">{{old('desc')}}</textarea>
                    <input type="text" name='service[ar][local]' value='ar' hidden>

                    @error('service.ar.desc')
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
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
      readURL(this);
  });
  //Function to show image before upload
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
