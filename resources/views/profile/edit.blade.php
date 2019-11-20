@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])
@section('css')
    <style>
       /* input[type="file"] {
            position: fixed;
            right: 100%;
            bottom: 100%;
        }*/
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
    @endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Edit Profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                            {{csrf_field()}}
                        <input type="hidden" name="_method" value="put">


                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ _('First Name') }}</label>
                                <input type="text" name="firstname" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('First Name') }}" value="{{ old('name', auth()->user()->firstname) }}">
                                @include('alerts.feedback', ['field' => 'firstname'])
                            </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label >{{ _('Last Name') }}</label>
                            <input id="test" type="text" name="lastname" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('Last Name') }}" value="{{ old('name', auth()->user()->lastname) }}">
                            @include('alerts.feedback', ['field' => 'lastname'])
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ _('Matric No') }}</label>
                            <input type="text" name="matricno" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('Matric No') }}" value="{{ old('name', auth()->user()->matric_no) }}" disabled="disabled">
                            @include('alerts.feedback', ['field' => 'matricno'])
                        </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ _('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                     {{csrf_field()}}
                        <input type="hidden" name="_method" value="put">


                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('storage/'.auth()->user()->image_url) }}" alt="">
                                <form method="post" action="{{route('profile.picture')}}" id="picform" enctype="multipart/form-data">
                                   <input name="_method" type="hidden" value="put"/>
                                    {{csrf_field()}}
                                    <label for="file-upload" id="uploadbutton" class="custom-file-upload">
                                        <i class="tim-icons icon-cloud-download-93"></i> Change Picture
                                    </label>
                                    <input type="file" id="propic" name="propic" style="visibility: hidden"/>

                                    @if($errors->has('propic'))
                                    <p>{{$errors->first('propic')}}</p>
                                   @endif
                                </form>
                                <h5 class="title">{{ auth()->user()->firstname." ".auth()->user()->lastname }}</h5>
                            </a>
                            <p class="description">
                                {{ _('Department: '.auth()->user()->department->name) }}
                            </p>
                    <p class="description">
                        {{ _(auth()->user()->level->name." Level") }}
                    </p>
                        </div>
                    </p>
                    <div class="card-description">
                        {{ _(' ') }}
                    </div>
                </div>
                {{--<div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>

@endsection

