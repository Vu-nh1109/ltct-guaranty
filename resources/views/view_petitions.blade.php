<!DOCTYPE html>

<html><head><title></title></head><body>
    <div class="container">
        <h3>View all petition</h3><hr>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">order_id</th>
            <th scope="col">reason</th>
            <th scope="col" colspan = "3">Image</th>
            <th scope="col">Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($petitionData as $data)
            <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->order_id}}</td>
            <td>{{$data->reason}}<td>
            <td colspan = "3">
                <img src="{{ url('Image/'.$data->image1) }}"
    style="height: 100px; width: 150px;">
            @if($data->image2)
                <img src="{{ url('Image/'.$data->image2) }}"
    style="height: 100px; width: 150px;">
            @endif
            @if($data->image3)
                <img src="{{ url('Image/'.$data->image3) }}"
    style="height: 100px; width: 150px;">
            </td>
            @endif
            @if(!$data->type)
            <td>Doi</td>
            @else 
            <td>Tra</td>
            @endif
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</body>
