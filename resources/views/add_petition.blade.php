@extends('layouts.master')

@section('title') Add petition @endsection

@section('content')
<br></br>
<div class="bg-news-list">
    <div class="container p-top50">
        <h2 class="text-center mb-3 h2">Add petition</h2>
        <form method="post" action="{{ route('petition.store', ['order_id'=> $order_id, 'product_id'=>$product_id]) }}" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Order id:</label>
                        <input disabled name="order_id" type="text" class="form-control" value="{{ $order_id }}">
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Product_id:</label>
                        <input disabled name="product_id" type="text" class="form-control" value="{{ $product_id }}">
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label" for="reason">Reason: <span class="text-danger">*</span></label>
                        <input name="reason" type="text" class="form-control" id="reason" required placeholder="Enter reason">
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;" class="control-label">Image: <span class="text-danger">*</span></label>
                        <input name="image1" accept="image/*" id="imgInp1" type="file" class="form-control" required placeholder="Enter image">
                        <img id="blah1" src="#" alt="" style="width: 200px;" />
                        <input name="image2" accept="image/*" id="imgInp2" type="file" class="form-control" placeholder="Enter image">
                        <img id="blah2" src="#" alt="" style="width: 200px;" />
                        <input name="image3" accept="image/*" id="imgInp3" type="file" class="form-control" placeholder="Enter image">
                        <img id="blah3" src="#" alt="" style="width: 200px;" />
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

                    <br></br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>

<script type="text/javascript">
    imgInp1.onchange = evt => {
        const [file] = imgInp1.files
        if (file) {
            blah1.src = URL.createObjectURL(file)
        }
    }

    imgInp2.onchange = evt => {
        const [file] = imgInp2.files
        if (file) {
            blah2.src = URL.createObjectURL(file)
        }
    }

    imgInp3.onchange = evt => {
        const [file] = imgInp3.files
        if (file) {
            blah3.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection