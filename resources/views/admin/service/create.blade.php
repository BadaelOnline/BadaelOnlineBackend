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
                <h6>Choose Photo</h6>
            </div>
        </div>

        {{-- <div class="form-group ml-5">

            <label for="icon" class="col-sm-2 col-form-label">Icon</label>

            <div class="col-sm-9">

                <input type="text" name='icon' class="form-control {{$errors->first('icon') ? "is-invalid" : "" }} " value="{{old('icon')}}" id="icon" placeholder="example: icofont-map">

                <div class="invalid-feedback">
                    {{ $errors->first('icon') }}
                </div>

            </div>

            <a href="https://icofont.com/icons" target="_blank" rel="noopener noreferrer">

                <span class="col-sm-2 col-form-label" style="color: blue">https://icofont.com/icons</span>

            </a>

        </div> --}}

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
        <div class="form-group ml-5 en">

            <label for="title" class="col-sm-2 col-form-label">Title English</label>

            <div class="col-sm-9">

                <input type="text" name='service[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
                <input type="text" name='service[en][local]' value='en' hidden>

                @error('service.en.title')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="title" class="col-sm-2 col-form-label">Title Arabic</label>

            <div class="col-sm-9">

                <input type="text" name='service[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
                <input type="text" name='service[ar][local]' value='ar' hidden>

                @error('service.ar.title')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- quote --}}
        <div class="form-group ml-5 en">

            <label for="quote" class="col-sm-2 col-form-label">Quote English</label>

            <div class="col-sm-9">

                <input type="text" name='service[en][quote]' class="form-control {{$errors->first('quote') ? "is-invalid" : "" }} " value="{{old('quote')}}" id="quote" placeholder="Quote">
                <input type="text" name='service[en][local]' value='en' hidden>

                @error('service.en.quote')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="quote" class="col-sm-2 col-form-label">Quote Arabic</label>

            <div class="col-sm-9">

                <input type="text" name='service[ar][quote]' class="form-control {{$errors->first('quote') ? "is-invalid" : "" }} " value="{{old('quote')}}" id="quote" placeholder="Quote">
                <input type="text" name='service[ar][local]' value='ar' hidden>

                @error('service.ar.quote')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- desc --}}
        <div class="form-group ml-5 en">

            <label for="desc" class="col-sm-2 col-form-label">Desc English</label>

            <div class="col-sm-9">

                {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                <textarea name="service[en][desc]" id="summernote" cols="40" rows="10"  class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} ">{{old('desc')}}</textarea>
                <input type="text" name='service[en][local]' value='en' hidden>

                @error('service.en.desc')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="desc" class="col-sm-2 col-form-label">Desc Arabic</label>

            <div class="col-sm-9">

                {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                <textarea name="service[ar][desc]" id="summernote" cols="40" rows="10"  class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} ">{{old('desc')}}</textarea>
                <input type="text" name='service[ar][local]' value='ar' hidden>

                @error('service.ar.desc')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5">

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
