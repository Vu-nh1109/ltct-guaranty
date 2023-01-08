<!DOCTYPE html>
<html><head><title></title></head><body>
    <div class="container">
    <form method="post" action="{{ route('petition.store', ['order_id'=> $order_id]) }}" enctype="multipart/form-data">
    @csrf
        <label><h4>Order Id = <?php echo $order_id; ?></h4></label>

        <div class="text">
        <label><h4>Add Reason</h4></label>
        <input type="text" required name="reason">
        </div>

        <div class="image">
        <label><h4>Add image</h4></label>
        <input type="file" required name="image1">
        </div>

        <div class="image">
        <input type="file" name="image2">
        </div>

        <div class="image">
        <input type="file" name="image3">
        </div>

        <div class="radio">
        <input type="radio" name="type" value=0> doi hang 
        <input type="radio" name="type" value=1> tra hang
        </div>

        <div class="post_button">
        <button type="submit" class="btn btn-success">Add</button>
        </div>
    </form>
    </div>
</body>