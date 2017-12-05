@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                    <div class="alert alert-success"><p><strong>{{ Session::get('success') }}</strong></p></div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger"><p><strong>{{ Session::get('fail') }}</strong></p></div>
                @endif
                <div class="clearfix"></div>
                <div class="box box-defautl">
                <div class="box-header" style="background-color: #f4f4f4; ">
                        <h3 class="pull-left" style="margin: 4px 5px 0px 5px;">
                            Users
                        </h3>
                        <div class="pull-right" style="margin: 0px 10px;">
                            <a class="btn btn-success pull-right" href="{{ route('users.create') }}"><i class="glyphicon glyphicon-plus"></i> New user</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr>
                                    <th class="text-center">Fullname</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Level</th>
                                    <th class="text-center" colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($users) == 0)
                                <tr>
                                    <td colspan="6" class="text-center text-blue">
                                        <h4>NO USER TO SHOW</h4>
                                    </td>
                                </tr>
                            @else
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{$user->name}}</td>
                                        <td class="text-center">{{$user->email}}</td>
                                        <td class="text-center">{{$user->level}}</td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('users.destroy',$user->id) }}" accept-charset="UTF-8">
                                                <input name="_method" type="hidden" value="DELETE">
                                                {{ csrf_field() }}
                                                <div class='btn-group'>
                                                    <a href="{{ route('users.edit', $user->id) }}" class='btn btn-warning'>Edit</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm(&#039;You want to delete this user?&#039;)">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pagination-sm no-margin pull-right">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop