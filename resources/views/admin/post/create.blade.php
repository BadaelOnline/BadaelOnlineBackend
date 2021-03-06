@extends('layouts.admin')

@section('styles')
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

<form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('post.Cpost')}}</h2>
    </div>

    <div class="container">

        <div class="form-group">

            <div class="picture-container">

                <div class="picture">

                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture" name="cover" class="form-control {{$errors->first('cover') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>

                </div>

                <h6>{{ __('post.Scover') }}</h6>

            </div>

        </div>

        {{-- title --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Tenglish') }}</label>

                    <input type="text" name='post[en][title]' class="form-control {{$errors->first('post.title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title">
                    <input type="text" name='post[en][local]' id="local" value="en" hidden>
                    @error('post.en.title')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Tarabic') }}</label>

                    <input type="text" name='post[ar][title]' class="form-control {{$errors->first('post.title') ? "is-invalid" : "" }} " value="{{old('title')}}" id="title" >
                    <input type="text" name='post[ar][local]' id="local" value="ar" hidden>
                    @error('post.ar.title')
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
        {{-- body --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Benglish') }}</label>

                    <textarea name='post[en][body]' class="form-control {{$errors->first('body') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('body')}}</textarea>
                    <input type="text" name='post[en][local]' id="local" value="en" hidden>
                    @error('post.en.body')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Barabic') }}</label>

                    <textarea name='post[ar][body]' class="form-control {{$errors->first('body') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('body')}}</textarea>
                    <input type="text" name='post[ar][local]' id="local" value="ar" hidden>
                    @error('post.ar.body')
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
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Kenglish') }}</label>

                    <input type="text" name='post[en][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword">
                    <input type="text" name='post[en][local]' value='en' hidden>
                    @error('post.en.keyword')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Karabic') }}</label>

                    <input type="text" name='post[ar][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword')}}" id="keyword">
                    <input type="text" name='post[ar][local]' value='ar' hidden>
                    @error('post.ar.keyword')
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
        {{-- meta-desc --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Menglish') }}</label>

                    <input type="text" name='post[en][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc">
                    <input type="text" name='post[en][local]' value='en' hidden>
                    @error('post.en.meta_desc')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('post.Marabic') }}</label>

                    <input type="text" name='post[ar][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc')}}" id="meta_desc">
                    <input type="text" name='post[ar][local]' value='ar' hidden>
                    @error('post.ar.meta_desc')
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

        {{-- category --}}
        <div class="form-group ml-4">

            <label for="category" class="col-sm-2 col-form-label">{{ __('post.category') }}</label>

            <div class="col-sm-7">

                <select name='category' class="form-control {{$errors->first('category') ? "is-invalid" : "" }} " id="category">
                    <option disabled selected>{{ __('post.choosone') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- tags --}}
        <div class="form-group ml-4">

            <label for="tags" class="col-sm-2 col-form-label">{{ __('post.tags') }}</label>

            <div class="col-sm-7">

                <select name='tags[]' class="form-control {{$errors->first('tags') ? "is-invalid" : "" }} select2" id="tags" multiple>
                    @foreach ($tags as $tags)
                        <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                    @endforeach
                </select>
                @error('tags')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-4">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('post.create') }}</button>

            </div>

        </div>

    </div>

  </form>
@endsection

<?php
$local = '';

if(isset($_COOKIE['local'])) {
    $local = $_COOKIE['local'];
}
?>
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

    //define a function to set cookies
// function setCookie(name,value) {
//    var lang = document.getElementById('selectLang').value;
//    console.log('lang',lang,'value',value)
//     document.cookie = name + "=" + value;
// }
// //get your item from the localStorage
//     var local = localStorage.getItem('local');
//     setCookie('local', local);

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
