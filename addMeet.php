<div class="row col-xs-3">
<h3> Add Result </h3>
    <form action= "addResults.php" method= "post" id="newResult" class="well">
        <div id= "id_athlete" class="form-group">
            <label>Athlete ID</label>
            <input type="text" name= "id_athlete" class="form-control">
        </div>
        <div id= "id_season" class="form-group">
            <label>Season ID</label>
            <input type="text" name= "id_season" class="form-control">
        </div>
        <div id= "id_event" class="form-group">
            <label>Event ID</label>
            <input type="text" name="id_event" class="form-control">
        </div>
        <div id= "performance" class="form-group">
            <label>Performance (time/distance)</label>
            <input type="text" name= "performance" class="form-control">
        </div>
        <div id= "place" class="form-group">
            <label>Place</label>
            <input type="text" name= "place" class="form-control">
        </div>
        <div id= "points" class="form-group">
            <label>Points</label>
            <input type="text" name= "points" class="form-control">
        </div>
        <div id= "wind" class="form-group">
            <label>Wind</label>
            <input type="text" name= "wind" class="form-control">
        </div>
        <div id= "FAT" class="form-group">
            <select name= "FAT" class="form-control">
                <option value= "">Select One</option>
                <option>Field Event</option>
                <option>Hand Time</option>
                <option>FAT</option>
            </select>
        </div>
        <div id= "round" class="form-group">
            <select name= "round" class="form-control">
                <option value= "">Round</option>
                <option>P</option>
                <option>F</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Post</button>
    </form>
</div>