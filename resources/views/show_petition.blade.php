@extends('layouts.master')

@section('title') Showing petition @endsection

@section('content')
<br></br>
<div class="bg-news-list">
    <div class="container p-top50">
        <h2 class="text-center mb-3 h2"> Showing petition </h2>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label style="font-weight: bold;"class="control-label">Order id:</label>
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
                        @if($petition->image2)
                    </div>
                    <div>
                        <img data-enlargeable src="{{ url('Image/'.$petition->image2) }}" style="width: 300px; cursor: zoom-in">
                        @endif
                    </div>
                    <div>
                        @if($petition->image3)
                        <img data-enlargeable src="{{ url('Image/'.$petition->image3) }}" style="width: 300px; cursor: zoom-in">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-weight: bold;" class="control-label">Type:</label>
                    @if(!$petition->type)
                    Exchange
                    @else
                    Return
                    @endif
                </div>

                <br></br>
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

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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