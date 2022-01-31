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

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.general.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group m-4">
        <h2>{{__('general.Ugeneral')}}</h2>
    </div>

    <div class="container">

        <div class="form-group">

            <div class="picture-container">

                <div class="picture">

                    <img src="{{asset('storage/' . $general->logo)}}" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                    <input type="file" id="wizard-picture" name="logo" class="form-control {{$errors->first('logo') ? "is-invalid" : "" }} ">

                    @error('logo')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror

                </div>

                <h6>{{ __('general.Scover') }}</h6>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="favicon" class="col-sm-2 col-form-label">{{ __('general.favicon') }}</label>

            <div class="col-sm-7">

                <img src="{{asset('storage/' . $general->favicon)}}" alt="">
                <input type="file" name='favicon' class="form-control {{$errors->first('favicon') ? "is-invalid" : "" }} " value="{{old('favicon') ? old('favicon') : $general->favicon}}" id="favicon" placeholder="Title">

                @error('favicon')
                    <small class="form-text text-danger"> {{ $message }}</small>
                @enderror

            </div>

        </div>

        {{-- title --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.Tenglish') }}</label>

                        <input type="text" name='general[en][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title') ? old('title') : $general->title}}" id="title" placeholder="Title">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                        @error('general.en.title')
                            <small class="form-text text-danger"> {{ $message }}</small>
                        @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.Tarabic') }}</label>

                    <input type="text" name='general[ar][title]' class="form-control {{$errors->first('title') ? "is-invalid" : "" }} " value="{{old('title') ? old('title') : $general->title}}" id="title" placeholder="Title">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                    @error('general.ar.title')
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

        {{-- address 1 --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.A1english') }}</label>

                        <input type="text" name='general[en][address1]' class="form-control {{$errors->first('address1') ? "is-invalid" : "" }} " value="{{old('address1') ? old('address1') : $general->address1}}" id="address1" placeholder="Address 1">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('address1') }}
                        </div>
                        @error('general.en.address1')
                            <small class="form-text text-danger"> {{ $message }}</small>
                        @enderror
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.A1arabic') }}</label>

                    <input type="text" name='general[ar][address1]' class="form-control {{$errors->first('address1') ? "is-invalid" : "" }} " value="{{old('address1') ? old('address1') : $general->address1}}" id="address1" placeholder="Address 1">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('address1') }}
                    </div>
                    @error('general.ar.address1')
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

        {{-- address 2 --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.A2english') }}</label>

                        <input type="text" name='general[en][address2]' class="form-control {{$errors->first('address2') ? "is-invalid" : "" }} " value="{{old('address2') ? old('address2') : $general->address2}}" id="address2" placeholder="Address 2">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.address2') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.A2arabic') }}</label>

                    <input type="text" name='general[ar][address2]' class="form-control {{$errors->first('address2') ? "is-invalid" : "" }} " value="{{old('address2') ? old('address2') : $general->address2}}" id="address2" placeholder="Address 2">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.address2') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- Tawk to --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.Tawkenglish') }}</label>

                        <textarea name="general[en][tawkto]" id="tawkto" cols="30" rows="10" class="form-control {{$errors->first('tawkto') ? "is-invalid" : "" }} ">{{old('tawkto') ? old('tawkto') : $general->tawkto}}</textarea>
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.tawkto') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.Tawkarabic') }}</label>

                    <textarea name="general[ar][tawkto]" id="tawkto" cols="30" rows="10" class="form-control {{$errors->first('tawkto') ? "is-invalid" : "" }} ">{{old('tawkto') ? old('tawkto') : $general->tawkto}}</textarea>
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.tawkto') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- disgus --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.disgusenglish') }}</label>

                        <textarea name="general[en][disqus]" id="disqus" cols="30" rows="10" class="form-control {{$errors->first('disqus') ? "is-invalid" : "" }} ">{{old('disqus') ? old('disqus') : $general->disqus}}</textarea>
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.disqus') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.disgusarabic') }}</label>

                    <textarea name="general[ar][disqus]" id="disqus" cols="30" rows="10" class="form-control {{$errors->first('disqus') ? "is-invalid" : "" }} ">{{old('disqus') ? old('disqus') : $general->disqus}}</textarea>
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.disqus') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- Sharethis --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.sharethisenglish') }}</label>

                        <textarea name="general[en][sharethis]" id="sharethis" cols="30" rows="10" class="form-control {{$errors->first('sharethis') ? "is-invalid" : "" }} ">{{old('sharethis') ? old('sharethis') : $general->sharethis}}</textarea>
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.sharethis') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.sharethisarabic') }}</label>

                    <textarea name="general[ar][sharethis]" id="sharethis" cols="30" rows="10" class="form-control {{$errors->first('sharethis') ? "is-invalid" : "" }} ">{{old('sharethis') ? old('sharethis') : $general->sharethis}}</textarea>
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.sharethis') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- Google Verification --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.googleverifenglish') }}</label>

                        <input type="text" name='general[en][gverification]' class="form-control {{$errors->first('gverification') ? "is-invalid" : "" }} " value="{{old('gverification') ? old('gverification') : $general->gverification}}" id="footer" placeholder="Google Verification">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.gverification') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.googleverifarabic') }}</label>

                    <input type="text" name='general[ar][gverification]' class="form-control {{$errors->first('gverification') ? "is-invalid" : "" }} " value="{{old('gverification') ? old('gverification') : $general->gverification}}" id="footer" placeholder="Google Verification">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.gverification') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- footer --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.footerenglish') }}</label>

                        <input type="text" name='general[en][footer]' class="form-control {{$errors->first('footer') ? "is-invalid" : "" }} " value="{{old('footer') ? old('footer') : $general->footer}}" id="footer" placeholder="Footer">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.footer') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.footerarabic') }}</label>

                    <input type="text" name='general[ar][footer]' class="form-control {{$errors->first('footer') ? "is-invalid" : "" }} " value="{{old('footer') ? old('footer') : $general->footer}}" id="footer" placeholder="Footer">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.footer') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- Keyword --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.kenglish') }}</label>

                        <input type="text" name='general[en][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword') ? old('keyword') : $general->keyword}}" id="keyword" placeholder="Keyword">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.keyword') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.karabic') }}</label>

                    <input type="text" name='general[ar][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword') ? old('keyword') : $general->keyword}}" id="keyword" placeholder="Keyword">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.keyword') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        {{-- description --}}
        <div class="form-group ml-2 col-sm-7">
            <div class="rowInput">

                <div class="en col-sm-9">
                    <label class="col-sm-6 col-form-label"{{ __('general.Menglish') }}</label>

                        <input type="text" name='general[en][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc') ? old('meta_desc') : $general->meta_desc}}" id="meta_desc" placeholder="Meta Description">
                        <input type="text" name='general[en][local]' value='en' hidden>

                        <div class="invalid-feedback">
                            {{ $errors->first('general.en.meta_desc') }}
                        </div>
                </div>

                <div class="ar col-sm-9">
                    <label class="col-sm-6 col-form-label">{{ __('general.Marabic') }}</label>

                    <input type="text" name='general[ar][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc') ? old('meta_desc') : $general->meta_desc}}" id="meta_desc" placeholder="Meta Description">
                    <input type="text" name='general[ar][local]' value='ar' hidden>

                    <div class="invalid-feedback">
                        {{ $errors->first('general.ar.meta_desc') }}
                    </div>
                </div>

                <select class="form-control col-sm-2 selectLang" id="selectLang">
                    @foreach(config('app.languages') as $index => $lang)
                    <option id="lang">{{ $lang }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="form-group ml-5">

            <label for="email" class="col-sm-2 col-form-label">{{ __('general.email') }}</label>

            <div class="col-sm-7">

                <input type="email" name='email' class="form-control {{$errors->first('email') ? "is-invalid" : "" }} " value="{{old('email') ? old('email') : $general->email}}" id="email" placeholder="Email">

                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="phone" class="col-sm-2 col-form-label">{{ __('general.phone') }}</label>

            <div class="col-sm-7">

                <input type="text" name='phone' class="form-control {{$errors->first('phone') ? "is-invalid" : "" }} " value="{{old('phone') ? old('phone') : $general->phone}}" id="phone" placeholder="098765432">

                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="twitter" class="col-sm-2 col-form-label">{{ __('general.twitter') }}</label>

            <div class="col-sm-7">

                <input type="text" name='twitter' class="form-control {{$errors->first('twitter') ? "is-invalid" : "" }} " value="{{old('twitter') ? old('twitter') : $general->twitter}}" id="twitter" placeholder="Twitter">

                <div class="invalid-feedback">
                    {{ $errors->first('twitter') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="facebook" class="col-sm-2 col-form-label">{{ __('general.facebook') }}</label>

            <div class="col-sm-7">

                <input type="text" name='facebook' class="form-control {{$errors->first('facebook') ? "is-invalid" : "" }} " value="{{old('facebook') ? old('facebook') : $general->facebook}}" id="facebook" placeholder="Facebook">

                <div class="invalid-feedback">
                    {{ $errors->first('facebook') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="instagram" class="col-sm-2 col-form-label">{{ __('general.instagram') }}</label>

            <div class="col-sm-7">

                <input type="text" name='instagram' class="form-control {{$errors->first('instagram') ? "is-invalid" : "" }} " value="{{old('instagram') ? old('instagram') : $general->instagram}}" id="instagram" placeholder="Instagram">

                <div class="invalid-feedback">
                    {{ $errors->first('instagram') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="linkedin" class="col-sm-2 col-form-label">{{ __('general.linkedin') }}</label>

            <div class="col-sm-7">

                <input type="text" name='linkedin' class="form-control {{$errors->first('linkedin') ? "is-invalid" : "" }} " value="{{old('linkedin') ? old('linkedin') : $general->linkedin}}" id="linkedin" placeholder="Linkedin">

                <div class="invalid-feedback">
                    {{ $errors->first('linkedin') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="gmaps" class="col-sm-2 col-form-label">{{ __('general.linkgmaps') }}

            <div class="col-sm-7">

                <input type="text" name='gmaps' class="form-control {{$errors->first('gmaps') ? "is-invalid" : "" }} " value="{{old('gmaps') ? old('gmaps') : $general->gmaps}}" id="gmaps" placeholder="Link Gmaps">

                <div class="invalid-feedback">
                    {{ $errors->first('gmaps') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('general.update') }}</button>

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
