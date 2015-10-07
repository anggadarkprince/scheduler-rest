
<h3><?=(isset($title)?$title:"")?> ::  <a href="home/add"class="btn btn-default">ADD NEW DATA</a></h3>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur eveniet ipsa molestiae. A aspernatur consequatur, deleniti distinctio ducimus earum esse expedita magnam modi, nesciunt perferendis quisquam reiciendis rem sequi ut.</p>

<?php if(isset($this->urlParams["id"]) && $this->urlParams["id"] == 'error'){ ?>
    <div class="alert alert-warning alert-dismissable">
        <span>Something is getting wrong!</span>
    </div>
<?php } if(isset($this->urlParams["id"]) && $this->urlParams["id"] == 'success'){ ?>
    <div class="alert alert-success alert-dismissable">
        <span>Database has updated successfully!</span>
    </div>
<?php } ?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>State</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if(isset($data)){ ?>
    <?php foreach($data as $user): ?>
        <tr>
            <td><?=$user["ply_id"]?></td>
            <td><?=$user["ply_name"]?></td>
            <td><?=$user["ply_email"]?></td>
            <td><?=$user["ply_state"]?></td>
            <td class="text-center">
                <a href="home/detail" class="btn btn-default">DETAIL</a>
                <a href="home/edit/<?=$user["ply_id"]?>" class="btn btn-default">EDIT</a>
                <a href="home/delete/<?=$user["ply_id"]?>" class="btn btn-default">DELETE</a>
            </td>
        </tr>
    <?php endforeach;?>
    <?php }?>
    </tbody>
</table>
