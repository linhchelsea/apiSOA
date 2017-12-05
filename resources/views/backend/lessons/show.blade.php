@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="clearfix"></div>
                <div class="box box-default">
                    <div class="box-header" style="background-color: #f4f4f4; ">
                        <h3 class="pull-left" style="margin: 4px 5px 0px 5px;">
                            Service detail
                        </h3>
                        <div class="pull-right" style="margin: 0px 10px;">
                            <a class="btn btn-success pull-right" href="{{ route('service.create') }}"><i class="glyphicon glyphicon-plus"></i> New service</a>
                            <a class="btn btn-primary pull-right" href="{{ route('service.edit',$service->id) }}" style="margin-right: 10px;"><i class="glyphicon glyphicon-edit"></i> Edit service</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            
                            <tbody>
                                <tr>
                                    <td class="text-bold" width="100px">ID</td>
                                    <td>{{ $service->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Name</td>
                                    <td>{{ $service->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Preview</td>
                                    <td>{{ $service->preview }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Description</td>
                                    <td>{{ $service->description }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Created at</td>
                                    <td>{{ $service->created_at }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Updated at</td>
                                    <td>{{ $service->updated_at }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Image</td>
                                    <td>
                                        @if(empty($service->image))
                                            <img src="{{asset('images/noimage-admin.png') }}" alt="noimage" id="noimage" width="400px" height="400px">
                                        @else
                                            <img src="{{asset('/storage/service/'.$service->image)}}" width="400px" height="400px">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <button class="btn btn-warning" type="button" onclick="window.location='{{ route('service.index') }}';" style="margin-top: 15px;"><i class="glyphicon glyphicon-remove"></i> Back</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop