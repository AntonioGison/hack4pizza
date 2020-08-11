<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">

    <tr>
        <th>Name</th>
        <td><?php echo $badge->name; ?></td>
    </tr><tr>
        <th>Description</th>
        <td><?php echo $badge->description; ?></td>
    </tr>
    <tr>
        <th>Image</th>
        <td><img src="{{asset("uploads/master-badges/$badge->pic")}}" alt="" alt="" style="width: 100%"></td>
    </tr>




</table>


