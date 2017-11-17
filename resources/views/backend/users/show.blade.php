@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-header" style="background-color: #f4f4f4; ">
                        <h3 class="pull-left" style="margin: 4px 5px 0px 5px;">
                            User detail
                        </h3>
                        <div class="pull-right" style="margin: 0px 10px;">
                            <a class="btn btn-success pull-right" href="{{ route('users.create') }}"><i class="glyphicon glyphicon-plus"></i> New user</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr class="info">
                                    <th class="text-center" colspan="2"><h4>User detail</h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Fullname</td>
                                    <td>name</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>email</td>
                                </tr>
                                <tr>
                                    <td>Position</td>
                                    <td>User</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td class="text-success">created_at</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td class="text-danger">>updated_at</td>
                                </tr>
                                <tr>
                                    <td>Avatar</td>
                                    <td><img src="{{ url('storage/avatars/avatar.png') }}" width="200px"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-warning" type="button" onclick="window.location='{{ url()->previous() }}';" style="margin-top: 15px;"><i class="fa fa-reply-all" aria-hidden="true"></i> BACK</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop