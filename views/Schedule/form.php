<h2>Create</h2>

<form action="http://localhost/scheduler/schedule/update" method="post">
    <div>
        <label>id</label>
        <input type="text" name="id">
    </div>
    <div>
        <label>event</label>
        <input type="text" name="event">
    </div>
    <div>
        <label>date</label>
        <input type="date" name="date">
    </div>
    <div>
        <label>time</label>
        <input type="time" name="time">
    </div>
    <div>
        <label>location</label>
        <input type="text" name="location">
    </div>
    <div>
        <label>description</label>
        <textarea name="description"></textarea>
    </div>
    <div>
        <button type="submit">create schedule</button>
    </div>
</form>