@extends('layouts.master')

@section('title') Showing petition @endsection

@section('content')
    <div class="bg-news-list">
        <div class="container p-top50">
            <h2 class="text-center mb-3 h2">Add order</h2>
            <form method="post" action="{{ route('petition.handle', ['id'=> $petition->id ]) }}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="control-label">Order id:</label>
                            <input disabled name="order_id" type="text" class="form-control" value="{{ $petition->order_id }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Product id:</label>
                            <input disabled name="product_id" type="text" class="form-control" value="{{ $petition->product_id }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="reason">Reason:</label>
                            <input disabled name="reason" type="text" class="form-control" value="{{ $petition->reason }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image:</label><br>
                            <img src="{{ url('Image/'.$petition->image1) }}" style="height: 300px">
                            @if($petition->image2)
                                <img src="{{ url('Image/'.$petition->image2) }}" style="height: 300px">
                            @endif
                            @if($petition->image3)
                                <img src="{{ url('Image/'.$petition->image3) }}" style="height: 300px">
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Type:</label>
                            @if(!$petition->type)
                            <input disabled name="reason" type="text" class="form-control" value="Exchange">
                            @else 
                            <input disabled name="reason" type="text" class="form-control" value="Return">
                            @endif
                        </div>

                        @switch($petition->status)
                            @case(2)
                            <div class="form-group">
                            <button disabled type="submit">Processing your request!</button>
                            </div>
                            @break
                            @case(1)
                            <div class="form-group">
                                <button disabled type="submit" class="btn btn-success">Accepted</button>
                            </div>
                            @break
                            @case(0)
                            <div class="form-group">
                                <button disabled type="submit" class="btn btn-danger">Refused</button>
                            </div>
                            @break
                        @endswitch
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection