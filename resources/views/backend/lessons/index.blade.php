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
                            Lessons
                        </h3>
                        <div class="pull-right" style="margin: 0px 10px;">
                            <a class="btn btn-success pull-right" href="{{ route('lessons.create') }}"><i class="glyphicon glyphicon-plus"></i> New lesson</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Lesson's English Name</th>
                                    <th class="text-center">Lesson's VietNamese Name</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($lessons) > 0)
                                @foreach($lessons as $lesson)
                                    <tr>
                                        <td class="text-center" >{{ $lesson->Id }}</td>
                                        <td class="text-center">{{ $lesson->LessonNameEn }}</td>
                                        <td class="text-center">{{ $lesson->LessonNameVi }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/lesson/'.$lesson->LessonPathImage) }}" alt="image" id="lesson" width="150px" height="150px" class="indexImage">
                                        </td>
                                        <td class="text-center">
                                            <form method="POST" action="{{ route('lessons.destroy', $lesson->Id) }}" accept-charset="UTF-8">
                                                <input name="_method" type="hidden" value="DELETE">
                                                {{ csrf_field() }}
                                                <div class='btn-group'>
                                                    <a href="{{ route('lessons.edit', $lesson->Id) }}" class='btn btn-warning'>Edit</a>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm(&#039;You want to remove this lesson?&#039;)">
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
                                        <h4><span style="font-style: inherit">No Lessons to show</span></h4>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pagination-sm no-margin pull-right">
                            {{ $lessons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop