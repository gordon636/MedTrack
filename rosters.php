
<div class="row col-xs-3">
    <form action="index.php" method="get" id="rosterSelect" class="well">
        <?php 
            $inOutSelected = isset($_GET['inOut']) ? $_GET['inOut'] : 1;
            $yearSelected = isset($_GET['year']) ? $_GET['year'] : 2017;
         ?>
        <div id="inOut" class="form-group">
            <label>Indoor or Outdoor</label>
            <select name= "inOut" class="form-control">
                <option value= 1 <?php if($inOutSelected == 1){echo ("selected");}?>>Indoor</option>
                <option value= 0 <?php if($inOutSelected == 0){echo ("selected");}?>>Outdoor</option>
            </select>
        </div>
        <div>
            <label>Year</label>
            <select name= "year" class="form-control">
                <option <?php if($yearSelected == 2017){echo ("selected");}?>>2017</option>
                <option <?php if($yearSelected == 2016){echo ("selected");}?>>2016</option>
                <option <?php if($yearSelected == 2015){echo ("selected");}?>>2015</option>
                <option <?php if($yearSelected == 2014){echo ("selected");}?>>2014</option>
            </select>
        </div>
        <input type="hidden" name="team" value=<?php echo (isset($_GET['team'])) ? $_GET['team'] : 'medfield';?>>
        <input type="hidden" name="s" value=<?php echo (isset($_GET['s'])) ? $_GET['s'] : 'm';?>>
        <button type="submit" class="btn btn-default">See Roster</button>
    </form>
    
    <table class="table table-hover">
        <thead>
            <th>Name</th>
            <th>Grad Year</th>
        </thead>
        
        <tbody>
            <?php 
            if($table_rows){
                foreach($table_rows as $tr): ?>
                <tr><td>
                    <?php
                    $athlete = $athletes->getAthleteInfo($tr['id_athlete']);
                    $athleteFName = $athlete[0]['firstName'];
                    $athleteLName = $athlete[0]['lastName'];
                    echo "<a href=\" index.php?athlete=" . $tr['id_athlete'] . "\">" . $athleteFName . " " . $athleteLName . " " . "</a>";?>
                </td><td>
                    <?php echo $athlete[0]['gradYear']; ?>
                </td>
                <?php endforeach; 
            } else{echo "No data for this season.";}?>
        </tbody>
    </table>

    
    <?php if($_SESSION['privileges']):?>
    <h3> Add an Athlete </h3>
    <form action= "addAthletes.php" method= "post" id="newAthlete" class="well">
        <div id= "firstName" class="form-group">
            <label>First Name</label>
            <input type="text" name= "firstName" class="form-control">
        </div>
        <div id= "lastName" class="form-group">
            <label>Last Name</label>
            <input type="text" name= "lastName" class="form-control">
        </div>
        <div id= "gradYear" class="form-group">
            <label>Graduation Year</label>
            <input type="text" name= "gradYear" class="form-control">
        </div>
        <div id= "gender" class="form-group">
            <label>Competing as:</label>
            <select name= "gender" class="form-control">
                <option value= "">Choose One</option>
                <option value="m">m</option>
                <option value="f">f</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Post</button>
    </form>
    <?php endif;?>
</div>