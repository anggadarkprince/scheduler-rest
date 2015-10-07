<h3><?=(isset($title)?$title:"")?> ::  <a href="home"class="btn btn-default">MEMBER LIST</a></h3>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur eveniet ipsa molestiae. A aspernatur consequatur, deleniti distinctio ducimus earum esse expedita magnam modi, nesciunt perferendis quisquam reiciendis rem sequi ut.</p>

<div class="row">
    <div class="col-md-6">
        <form class="form-horizontal" action="home/save" method="post">
            <div class="control-group">
                <label class="control-label" for="frm-name">Name</label>
                <input class="form-control" type="text" name="frm-name" required>
            </div>
            <div class="">
                <label class="control-label" for="frm-email">Email</label>
                <input class="form-control" type="email" name="frm-email" required>
            </div>
            <div class="">
                <label class="control-label" for="frm-email">Password</label>
                <input class="form-control" type="password" name="frm-password" required>
            </div>
            <div class="control-group">
                <label class="control-label" for="frm-state">State</label>
                <select class="dropdown dropdown-header" name="frm-state">
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="PENDING">PENDING</option>
                    <option value="SUSPEND">SUSPEND</option>
                </select>
            </div>
            <button type="submit" class="btn btn-embossed pull-right">SAVE DATA</button>
        </form>
    </div>
</div>
