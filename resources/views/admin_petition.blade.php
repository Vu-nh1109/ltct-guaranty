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
                        <button type="submit" class="btn btn-success" name="action" value="accept">Accept</button>
                        <button type="submit" class="btn btn-danger" name="action" value="refuse">Refuse</button>
                        @if(!$petition->type)
                        <button type="submit" class="btn btn-primary" name="action" value="return">Switch to return</button>
                        @endif
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