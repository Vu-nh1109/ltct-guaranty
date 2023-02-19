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
                        <h4 class="mb-0 font-size-18">Petition List</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                                <div class="table-responsive">
                                    <table style="display: table; table-layout: fixed;" class="table table-centered table-nowrap" id="tableID">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">Id</th>
                                                <th style="width: 70px;" class="text-center">Order Id</th>
                                                <th style="width: 80px;" class="text-center">Product Id</th>
                                                <th style="width: 250px;" class="text-center">Reason</th>
                                                <th style="width: 200px;" class="text-center">Created at</th>
                                                <th style="width: 100px;" class="text-center">Type</th>
                                                <th style="width: 100px;" class="text-center">Status</th>
                                                <th style="width: 70px;" class="text-center">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" name="id" class="form-control" /></td>
                                                <td><input type="text" name="order_id" class="form-control" /></td>
                                                <td><input type="text" name="product_id" class="form-control" /></td>
                                                <td><input type="text" name="reason" class="form-control" /></td>
                                                <td></td>
                                                <td>
                                                    <select class="form-control" name="type">
                                                        <option value=''></option>
                                                        <option value=0>Exchange</option>
                                                        <option value=1>Return</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="status">
                                                        <option value=''></option>
                                                        <option value=2>Waiting</option>
                                                        <option value=1>Accepted</option>
                                                        <option value=0>Refused</option>
                                                    </select>
                                                </td>
                                                <td><input type="submit" class="btn btn-primary" value="Search" /></td>
                                            </tr>
                                            @foreach($petitionData as $data)
                                            <tr>
                                                <td class="text-center">{{ $data->id }}</td>
                                                <td class="text-center">{{ $data->order_id }}</td>
                                                <td class="text-center">{{ $data->product_id }}</td>
                                                <td style="white-space: normal;">{{ $data->reason }}</td>
                                                <td class="text-center">{{ $data->created_at }}</td>
                                                <td class="text-center">
                                                    @if(!$data->type)
                                                    Exchange
                                                    @else
                                                    Return
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @switch($data->status)
                                                    @case(0)
                                                    Refused
                                                    @break
                                                    @case(1)
                                                    Accepted
                                                    @break
                                                    @case(2)
                                                    Waiting
                                                    @break
                                                    @endswitch
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ URL::to('/petitions/'.$data->id) }}">Link</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- 		End of Container -->
                                
                            </form>
                            
                            {{ $petitionData->appends(request()->input())->links() }}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->

        <!-- End Page-content -->
    </div>
</div>

@endsection