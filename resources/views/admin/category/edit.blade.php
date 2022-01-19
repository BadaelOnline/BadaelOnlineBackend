@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.category.update',$category->id) }}" method="POST">
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

        {{-- name --}}
        <div class="form-group ml-5 en">

            <label for="name" class="col-sm-2 col-form-label">Name English</label>

            <div class="col-sm-7">

                <input type="text" name='category[en][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $category->name}}" id="name" placeholder="Name">
                <input type="text" name='category[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="name" class="col-sm-2 col-form-label">Name Arabic</label>

            <div class="col-sm-7">

                <input type="text" name='category[ar][name]' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $category->name}}" id="name" placeholder="Name">
                <input type="text" name='category[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        {{-- keyword --}}
        <div class="form-group ml-5 en">

            <label for="keyword" class="col-sm-2 col-form-label">Keyword English</label>

            <div class="col-sm-7">

                <input type="text" name='category[en][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword') ? old('keyword') : $category->keyword}}" id="keyword" placeholder="Keyword">
                <input type="text" name='category[en][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('keyword') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="keyword" class="col-sm-2 col-form-label">Keyword Arabic</label>

            <div class="col-sm-7">

                <input type="text" name='category[ar][keyword]' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword') ? old('keyword') : $category->keyword}}" id="keyword" placeholder="Keyword">
                <input type="text" name='category[ar][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('keyword') }}
                </div>

            </div>

        </div>

        {{-- meta desc --}}
        <div class="form-group ml-5 en">

            <label for="meta_desc" class="col-sm-2 col-form-label">Meta Desc English</label>

            <div class="col-sm-7">

                <input type="text" name='category[en][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc') ? old('meta_desc') : $category->meta_desc}}" id="meta_desc" placeholder="Meta Description">
                <input type="text" name='category[en}][local]' value='en' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('meta_desc') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5 ar">

            <label for="meta_desc" class="col-sm-2 col-form-label">Meta Desc Arabic</label>

            <div class="col-sm-7">

                <input type="text" name='category[ar][meta_desc]' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc') ? old('meta_desc') : $category->meta_desc}}" id="meta_desc" placeholder="Meta Description">
                <input type="text" name='category[ar}][local]' value='ar' hidden>

                <div class="invalid-feedback">
                    {{ $errors->first('meta_desc') }}
                </div>

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
