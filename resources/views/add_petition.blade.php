@extends('layouts.master')

@section('title') Add order @endsection

@section('content')
    <div class="bg-news-list">
        <div class="container p-top50">
            <h2 class="text-center mb-3 h2">Add order</h2>
            <form method="post" action="{{ route('petition.store', ['order_id'=> $order_id]) }}" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="control-label">Order id:</label>
                            <input disabled name="order_id" type="text" class="form-control" value="{{ $order_id }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="reason">Reason: <span class="text-danger">*</span></label>
                            <input name="reason" type="text" class="form-control" id="reason" required placeholder="Enter reason">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image: <span class="text-danger">*</span></label>
                            <input name="image1" type="file" class="form-control" placeholder="Enter image">
                            <input name="image2" type="file" class="form-control" placeholder="Enter image">
                            <input name="image3" type="file" class="form-control" placeholder="Enter image">
                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type-exchange" value="0" checked>
                                <label class="form-check-label" for="type-exchange">Exchange </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type-return" value="1">
                                <label class="form-check-label" for="type-return">Return</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection