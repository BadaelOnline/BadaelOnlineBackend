@extends('layouts.admin')

@section('styles')
<style>
   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width: 800px;
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

<form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">

        <div class="picture-container">

            <div class="picture">

                <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                <input type="file" id="wizard-picture" name="cover">
                @error('cover')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror
            </div>

            <h6>Pilih Cover</h6>

        </div>

      </div>

    {{-- @foreach(config('app.languages') as $index => $lang) --}}
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
        <div class="col-sm-7">
            <input type="text" name='banner[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
            <input type="text" name='banner[en][local]' value='en' hidden>
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
            @error('banner.en.title')
                <small class="form-text text-danger"> {{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-group ml-5 ar">
        <label for="title" class="col-sm-2 col-form-label">Title Arabic</label>
        <div class="col-sm-7">
            <input type="text" name='banner[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" placeholder="Title">
            <input type="text" name='banner[ar][local]' value='ar' hidden>
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
            @error('banner.ar.title')
                <small class="form-text text-danger"> {{ $message }}</small>
            @enderror
        </div>
    </div>
    {{-- desc --}}
    <div class="form-group ml-5 en">
        <label for="desc" class="col-sm-2 col-form-label">Desc English</label>
        <div class="col-sm-7">
          <textarea name="banner[en][desc]" id="desc" cols="30" rows="10" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} " id="summernote">{{old('desc')}}</textarea>
          <input type="text" name='banner[en][local]' value='en' hidden>
            <div class="invalid-feedback">
                {{ $errors->first('desc') }}
            </div>
            @error('banner.en.desc')
                <small class="form-text text-danger"> {{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-group ml-5 ar">
        <label for="desc" class="col-sm-2 col-form-label">Desc Arabic</label>
        <div class="col-sm-7">
          <textarea name="banner[ar][desc]" id="desc" cols="30" rows="10" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} " id="summernote">{{old('desc')}}</textarea>
          <input type="text" name='banner[ar][local]' value='ar' hidden>
            <div class="invalid-feedback">
                {{ $errors->first('desc') }}
            </div>
            @error('banner.ar.desc')
                <small class="form-text text-danger"> {{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-group ml-5">
        <label for="link" class="col-sm-2 col-form-label">Link</label>
        <div class="col-sm-7">
          <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} " value="{{old('link')}}" id="link" placeholder="Link">
          <div class="invalid-feedback">
            {{ $errors->first('link') }}
        </div>
        </div>
      </div>

    <div class="form-group ml-5">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Create</button>
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
