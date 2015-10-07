<h2>Create</h2>

<form action="http://localhost/scheduler/note/insert" method="post">
    <div>
        <label>user id</label>
        <input type="text" name="user_id">
    </div>
    <div>
        <label>title</label>
        <input type="text" name="title">
    </div>
    <div>
        <label>label</label>
        <input type="text" name="label">
    </div>
    <div>
        <label>note</label>
        <textarea name="note"></textarea>
    </div>
    <div>
        <button type="submit">Insert Note</button>
    </div>
</form>