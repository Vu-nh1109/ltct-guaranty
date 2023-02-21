@extends('layouts.master')

@section('title') Showing petition @endsection

@section('content')
<br></br>
<div class="bg-news-list">
    <div class="container p-top50">
        <h2 class="text-center mb-3 h2">Showing petition</h2>
        <form method="post" action="{{ route('petition.handle', ['id'=> $petition->id ]) }}" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Product name:</label>
                        {{ $product_name }}
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Order id:</label>
                        {{ $petition->order_id }}
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Product id:</label>
                        {{ $petition->product_id }}
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label" for="reason">Reason:</label>
                        {{ $petition->reason }}
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Images:</label><br>
                        <div>
                            <img data-enlargeable src="{{ url('Image/'.$petition->image1) }}" style="width: 300px; cursor: zoom-in">
                        </div>
                        <div>
                            @if($petition->image2)
                            <img data-enlargeable src="{{ url('Image/'.$petition->image2) }}" style="width: 300px; cursor: zoom-in">
                            @endif
                        </div>
                        <div>
                            @if($petition->image3)
                            <img data-enlargeable src="{{ url('Image/'.$petition->image3) }}" style="width: 300px; cursor: zoom-in">
                            @endif
                        </div>
                    </div>
                    <br></br>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Type:</label>
                        @if(!$petition->type)
                        Exchange
                        @else
                        Return
                        @endif
                    </div>
                    @switch($petition->status)
                    @case(2)
                    <div class="form-group">
                        @if(!$petition->type)
                        <label style="font-weight: bold;" class="control-label" for="quantity">Product Quantity in Warehouse:</label>
                        {{ $warehouse_quantity }}
                        @endif
                    </div>

                    <div class="form-group">
                        @if(!$petition->type)
                        <label style="font-weight: bold;" class="control-label" for="quantity">Number of product to be exchanged:</label>
                        {{ $order_quantity }}
                        @endif
                    </div>

                    <div class="form-group">
                        @if(!$warehouse_quantity)
                        <button disabled class="btn btn-success" data-toggle="tooltip" title="Not enough quantity to accept">Accept</button>
                        @else
                        <button type="submit" class="btn btn-success" name="action" value="accept">Accept</button>
                        @endif
                        <button type="submit" class="btn btn-danger" name="action" value="refuse">Refuse</button>
                        @if(!$petition->type)
                        <button type="submit" class="btn btn-primary" name="action" value="return">Switch to return</button>
                        @endif
                    </div>
                    @break
                    @case(1)
                    <div class="form-group">
                        <button disabled class="btn btn-success">Accepted</button>
                    </div>
                    @break
                    @case(0)
                    <div class="form-group">
                        <button disabled class="btn btn-danger">Refused</button>
                    </div>
                    @break
                    @endswitch
                </div>
            </div>
        </form>

    </div>
</div>
<br></br>

<script type="text/javascript">
    $('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
        var src = $(this).attr('src');
        var modal;

        function removeModal() {
            modal.remove();
            $('body').off('keyup.modal-close');
        }

        modal = $('<div>').css({
            background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
            backgroundSize: 'contain',
            width: '100%',
            height: '100%',
            position: 'fixed',
            zIndex: '10000',
            top: '0',
            left: '0',
            cursor: 'zoom-out'
        }).click(function() {
            removeModal();
        }).appendTo('body');
        //handling ESC
        $('body').on('keyup.modal-close', function(e) {
            if (e.key === 'Escape') {
                removeModal();
            }
        });
    });
</script>
@endsection