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
  /* width: 800px; */
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
.image {
    display: flex;
    margin: auto;
    justify-content: center;
    align-items: center;
}
</style>
@endsection
@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="container">

        {{-- image --}}
        <div class="image">
                {{-- image desktop --}}
        <div class="form-group col-md-6">

            <div class="picture-container">

                <div class="picture">

                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture" name="cover" class="form-control {{$errors->first('cover') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                        {{ $errors->first('cover') }}
                    </div>

                </div>

                <h6>Pilih Cover</h6>

            </div>

        </div>

        {{-- image mobile --}}
        <div class="form-group col-md-6">

            <div class="picture-container">

                <div class="picture">

                    <img src="" class="picture-src" id="wizardPicturePreview1" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture1" name="mobileImage" class="form-control {{$errors->first('mobileImage') ? "is-invalid" : "" }} ">

                    <div class="invalid-feedback">
                        {{ $errors->first('mobileImage') }}
                    </div>

                </div>

                <h6>Mobile Image</h6>

            </div>

        </div>
        </div>
        {{--  --}}
        <div class="form-group ml-5">

            <label for="category" class="col-sm-2 col-form-label">Category</label>

            <div class="col-sm-9">

                <select name='category' class="form-control {{$errors->first('category') ? "is-invalid" : "" }} " id="category">
                    <option disabled selected>Choose One!</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
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

            <label for="lang" class="col-sm-2 col-form-label">Languages</label>

            <div class="col-sm-9">
                <select class="form-control" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- name --}}
        <div class="form-group ml-5 en">

            <label for="name" class="col-sm-2 col-form-label">Name English</label>

            <div class="col-sm-9">

                <input type="text" name='portfolio[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="Project Name">
                <input type="text" name='portfolio[en][local]' value='en' hidden>

                @error('portfolio.en.name')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="name" class="col-sm-2 col-form-label">Name Arabic</label>

            <div class="col-sm-9">

                <input type="text" name='portfolio[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name')}}" id="name" placeholder="Project Name">
                <input type="text" name='portfolio[ar][local]' value='ar' hidden>

                @error('portfolio.ar.name')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- client --}}
        <div class="form-group ml-5 en">

            <label for="client" class="col-sm-2 col-form-label">Client English</label>

            <div class="col-sm-9">

                <input type="text" name='portfolio[en][client]' class="form-control {{$errors->first('client') ? "is-invalid" : "" }} " value="{{old('client')}}" id="client" placeholder="client">
                <input type="text" name='portfolio[en][local]' value='en' hidden>

                @error('portfolio.en.client')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="client" class="col-sm-2 col-form-label">Client Arabic</label>

            <div class="col-sm-9">

                <input type="text" name='portfolio[ar][client]' class="form-control {{$errors->first('client') ? "is-invalid" : "" }} " value="{{old('client')}}" id="client" placeholder="client">
                <input type="text" name='portfolio[ar][local]' value='ar' hidden>

                @error('portfolio.ar.client')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- desc --}}
        <div class="form-group ml-5 en">

            <label for="desc" class="col-sm-2 col-form-label">Desc English</label>

            <div class="col-sm-9">

                <textarea name="portfolio[en][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('desc')}}</textarea>
                <input type="text" name='portfolio[en][local]' value='en' hidden>

                @error('portfolio.en.desc')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="desc" class="col-sm-2 col-form-label">Desc Arabic</label>

            <div class="col-sm-9">

                <textarea name="portfolio[ar][desc]" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('desc')}}</textarea>
                <input type="text" name='portfolio[ar][local]' value='ar' hidden>

                @error('portfolio.ar.desc')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="date" class="col-sm-2 col-form-label">Project Date</label>

            <div class="col-sm-9">

                <input type="date" name='date' class="form-control {{$errors->first('date') ? "is-invalid" : "" }} " value="{{old('date')}}" id="date" >

                <div class="invalid-feedback">
                    {{ $errors->first('date') }}
                </div>

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
//image mobile
  // Prepare the preview for profile picture
  $("#wizard-picture1").change(function(){
      readURL1(this);
  });
  //Function to show image before upload
function readURL1(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#wizardPicturePreview1').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
