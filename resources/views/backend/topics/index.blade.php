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
                            Topic
                        </h3>
                        <div class="pull-right" style="margin: 0px 10px;">
                            <a class="btn btn-success pull-right" href="{{ route('topics.create') }}"><i class="glyphicon glyphicon-plus"></i> New topic</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Topic's English Name</th>
                                    <th class="text-center">Topic's VietNamese Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($topics) > 0)
                                @foreach($topics as $topic)
                                    <tr>
                                        <td class="text-center" >{{ $topic->Id }}</td>
                                        <td class="text-center">{{ $topic->EngName }}</td>
                                        <td class="text-center">{{ $topic->VieName }}</td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('topics.destroy', $topic->Id) }}" accept-charset="UTF-8">
                                                <input name="_method" type="hidden" value="DELETE">
                                                {{ csrf_field() }}
                                                <div class='btn-group'>
                                                    <a href="{{ route('topics.edit', $topic->Id) }}" class='btn btn-warning'>Edit</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm(&#039;You want to remove this topic?&#039;)">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-blue">
                                        <h4><span style="font-style: inherit">No topics to show</span></h4>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pagination-sm no-margin pull-right">
                            {{ $topics->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop