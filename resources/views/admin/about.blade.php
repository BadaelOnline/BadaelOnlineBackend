@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('about.update',1) }}" method="POST" enctype="multipart/form-data">
    @csrf

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
      <input type="text" name='about[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title') ? old('title') : $about->title}}" id="link" placeholder="Title About">
      <input type="text" name='about[en][local]' value='en' hidden>

        <div class="invalid-feedback">
        {{ $errors->first('about.en.title') }}
        </div>
        @error('about.en.title')
            <small class="form-text text-danger"> {{ $message }}</small>
        @enderror
    </div>
  </div>

  <div class="form-group ml-5 ar">
    <label for="title" class="col-sm-2 col-form-label">Title Arabic</label>
    <div class="col-sm-7">
      <input type="text" name='about[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title') ? old('title') : $about->title}}" id="link" placeholder="Title About">
      <input type="text" name='about[ar][local]' value='ar' hidden>

        <div class="invalid-feedback">
        {{ $errors->first('about.ar.title') }}
        </div>
        @error('about.ar.title')
            <small class="form-text text-danger"> {{ $message }}</small>
        @enderror
    </div>
  </div>
  {{-- subject --}}
  <div class="form-group ml-5 en">
    <label for="subject" class="col-sm-2 col-form-label">Slogan English</label>
    <div class="col-sm-7">
      <input type="text" name='about[en][subject]' class="form-control {{$errors->first('subject') ? "is-invalid" : "" }} " value="{{old('subject') ? old('subject') : $about->subject}}" id="link" placeholder="Slogan">
      <input type="text" name='about[en][local]' value='en' hidden>

      <div class="invalid-feedback">
        {{ $errors->first('about.en.subject') }}
        </div>
        @error('about.en.subject')
            <small class="form-text text-danger"> {{ $message }}</small>
        @enderror
    </div>
  </div>

  <div class="form-group ml-5 ar">
    <label for="subject" class="col-sm-2 col-form-label">Slogan Arabic</label>
    <div class="col-sm-7">
      <input type="text" name='about[ar][subject]' class="form-control {{$errors->first('subject') ? "is-invalid" : "" }} " value="{{old('subject') ? old('subject') : $about->subject}}" id="link" placeholder="Slogan">
      <input type="text" name='about[ar][local]' value='ar' hidden>

      <div class="invalid-feedback">
        {{ $errors->first('about.ar.subject') }}
        </div>
        @error('about.ar.subject')
        <small class="form-text text-danger"> {{ $message }}</small>
    @enderror
    </div>
  </div>
    {{-- desc --}}
    <div class="form-group ml-5 en">
        <label for="desc" class="col-sm-2 col-form-label">Desc English</label>
        <div class="col-sm-7">
          <textarea name="about[en][desc]" cols="30" rows="10" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} " id="summernote">{{old('desc') ? old('desc') : $about->desc}}</textarea>
          <input type="text" name='about[en][local]' value='en' hidden>

          <div class="invalid-feedback">
            {{ $errors->first('about.en.desc') }}
            </div>
        </div>
        @error('about.en.desc')
            <small class="form-text text-danger"> {{ $message }}</small>
        @enderror
    </div>

    <div class="form-group ml-5 ar">
        <label for="desc" class="col-sm-2 col-form-label">Desc Arabic</label>
        <div class="col-sm-7">
          <textarea name="about[ar][desc]" cols="30" rows="10" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} " id="summernote">{{old('desc') ? old('desc') : $about->desc}}</textarea>
          <input type="text" name='about[ar][local]' value='ar' hidden>

          <div class="invalid-feedback">
            {{ $errors->first('about.ar.desc') }}
            </div>
            @error('about.ar.desc')
            <small class="form-text text-danger"> {{ $message }}</small>
        @enderror
        </div>

    </div>

    <div class="form-group ml-5">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">Update</button>
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
