@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.role.update',$role->id) }}" method="POST">
    @csrf

    <div class="form-group m-4">
        <h2>{{ __('user.Urole') }}</h2>
    </div>

    <div class="container">

        <div class="form-group ml-5">

            <label for="name" class="col-sm-2 col-form-label">{{ __('user.name') }}</label>

            <div class="col-sm-9">

                <input type="text" name='name' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $role->name}}" id="name" placeholder="Ex: Susi Similikiti">

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        {{-- role --}}

        <div class="form-group ml-5">

            <label for="permissions" class="col-sm-2 col-form-label">{{ __('user.perm') }}</label>

            <div class="col-sm-9">

                <select name='permissions[]' class="form-control {{$errors->first('permissions') ? "is-invalid" : "" }} select2" id="permissions" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            @foreach ($role->permissions as $role_premit)
                            @if ($role_premit->id == $permission->id)
                                selected
                            @endif
                        @endforeach >{{ $permission->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('permissions') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <div class="col-sm-3">

                <button type="submit" class="btn btn-primary">{{ __('user.update') }}</button>

            </div>

        </div>

    </div>

  </form>
@endsection
