<h3><?=(isset($title)?$title:"")?> ::  <a href="home"class="btn btn-default">MEMBER LIST</a></h3>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur eveniet ipsa molestiae. A aspernatur consequatur, deleniti distinctio ducimus earum esse expedita magnam modi, nesciunt perferendis quisquam reiciendis rem sequi ut.</p>

<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal" action="home/update/<?=$data->ply_id?>" method="post">
            <div class="control-group">
                <label class="control-label" for="frm-name">Name</label>
                <input class="form-control" type="text" name="frm-name" required value="<?=$data->ply_name?>">
            </div>
            <div class="">
                <label class="control-label" for="frm-email">Email</label>
                <input class="form-control" type="email" name="frm-email" required value="<?=$data->ply_email?>">
            </div>
            <div class="control-group">
                <label class="control-label" for="frm-state">State</label>
                <select class="dropdown dropdown-header btn-block" name="frm-state">
                    <option value="ACTIVE" <?=($data->ply_state=="ACTIVE")?"selected":""?>>ACTIVE</option>
                    <option value="PENDING" <?=($data->ply_state=="PENDING")?"selected":""?>>PENDING</option>
                    <option value="SUSPEND" <?=($data->ply_state=="SUSPEND")?"selected":""?>>SUSPEND</option>
                </select>
            </div>
            <div class="control-group">
                <button type="submit" class="btn" style="margin-top: 15px">SAVE DATA</button>
            </div>
        </form>
    </div>
</div>