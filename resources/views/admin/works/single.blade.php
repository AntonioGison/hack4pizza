<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">

    <tr>
        <th>Title</th>
        <td><?php echo $work->name; ?></td>
    </tr><tr>
        <th>Description</th>
        <td><?php echo $work->description; ?></td>
    </tr>
    <tr>
        <th>Image</th>
        <td><img src="{{asset("uploads/works/$work->pic")}}" alt="" alt="" style="width: 100%"></td>
    </tr>




</table>


