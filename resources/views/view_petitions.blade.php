@extends('layouts.default')

@section('title') Manage petition @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">List petition</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Manage</a></li>
                                    <li class="breadcrumb-item active">List petition</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">Id</th>
                                                <th style="width: 70px;" class="text-center">Order Id</th>
                                                <th>Reason</th>
                                                <th>Image</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($petitionData as $data)
                                                <tr>
                                                    <td class="text-center">{{ $data->id }}</td>
                                                    <td class="text-center">{{ $data->order_id }}</td>
                                                    <td>{{ $data->reason }}</td>
                                                    <td>
                                                        <img src="{{ url('Image/'.$data->image1) }}" style="height: 100px; width: 150px;">
                                                        @if($data->image2)
                                                            <img src="{{ url('Image/'.$data->image2) }}"
                                                        style="height: 100px; width: 150px;">
                                                        @endif
                                                        @if($data->image3)
                                                            <img src="{{ url('Image/'.$data->image3) }}" style="height: 100px; width: 150px;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!$data->type)
                                                            Exchange
                                                        @else 
                                                            Return
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection