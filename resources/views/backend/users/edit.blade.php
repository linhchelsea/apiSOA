@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content">
        @if($errors->count()>0)
            <ul class="alert alert-danger" style="list-style-type: none">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border" style="background-color: #c4e3f3;" >
                <h3 style="margin: 0px 5px; color: #0d6496;">
                    Update user
                </h3>
            </div>
            <div class="box-body">
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <div class="row">
                    <form method="POST" action="{{ route('users.update',$user->id) }}" accept-charset="UTF-8" id="user_update" class="userUpdateForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <!-- Email Field -->
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <p class="form-control" id="email">{{$user->email}}</p>
                            </div>
                            <!-- Fullname Field -->
                            <div class="col-sm-6">
                                <label for="fullname">Full name</label>
                                <input class="form-control" name="fullname" type="text" id="fullname" value="{{$user->name}}">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Password Field -->
                            <div class="col-sm-6">
                                <label for="password">New password</label>
                                <input class="form-control" name="password" type="password" id="password" value="">
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="col-sm-6">
                                <label for="password_confirmation">Confirm new password</label>
                                <input class="form-control" name="password_confirmation" type="password" id="password_confirmation" value="">
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Submit Field -->
                            <div class="col-sm-12">
                                <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-left: 5px;"><i class="fa fa-reply-all" aria-hidden="true"></i> BACK</button>
                                <button type="submit" form="user_update" class="btn btn-primary" name="submit" value="Update"><i class="glyphicon glyphicon-edit"></i> UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
@stop