<div class="text-center">
    <h1>Juan's Auto Paint</h1>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="new_paint_tab" data-toggle="tab" href="#new_paint" role="tab" aria-controls="new_paint" aria-selected="true">New Paint Jobs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="paint_tab" data-toggle="tab" href="#paint" role="tab" aria-controls="paint" aria-selected="false">Paint Jobs</a>
  </li>
</ul>
<div class="tab-content" id="paint_job_content">
  <div class="tab-pane fade show active" id="new_paint" role="tabpanel" aria-labelledby="new_paint">
    <div class="row mt-5">
        <div class="col-5 text-right">
            <img src="<?=base_url('assets/img/DefaultCar.png')?>" id="curr_color_car" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-2 text-center">
            <img src="<?=base_url('assets/img/Shape1.png')?>" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-5 text-left">
            <img src="<?=base_url('assets/img/DefaultCar.png')?>" id = "target_color_car" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div>
        <strong>Car Details</strong>
        <div class="row mt-2"> 
            <div class="col-2">
                <label for="plate_num">Plate No:</label> 
            </div>
            <div class="col-2">
                <input type="text" id="plate_num" class="form-control" name="plate_num">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-2">
                <label for="curr_color">Current Color:</label> 
            </div>
            <div class="col-2">
                <select type="text" id="curr_color" class="form-control" name="curr_color">
                    <option value=""></option>
                    <option value="blue">Blue</option>
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-2">
                <label for="target_color">Target Color:</label> 
            </div>
            <div class="col-2">
                <select type="text" id="target_color" class="form-control" name="target_color">
                    <option value=""></option>
                    <option value="blue">Blue</option>
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <button type="button" id="submit" class="btn btn-danger">Submit</button>
        </div>
    </div>
  </div>
  <div class="tab-pane fade" id="paint" role="tabpanel" aria-labelledby="paint_tab">
    <div class="text-center mt-5">
        <h2>Paint Jobs</h2>
    </div>
    <div class="row">
        <div class="col-8">
            <h6>Paint Jobs In Progress</h6>
            <table class="table mt-3">
                <tr>
                    <th>Plate Number</th>
                    <th>Current Color</th>
                    <th>Target Color</th>
                    <th>Action</th>
                </tr>
                <tbody id="car_queue">
                    <?php
                        $row = "";
                        foreach($car_queue as $car){
                            $queue = $car['car_queue'];
                            if($queue == 0){
                                $row .= "<tr>";
                                $row .= "<td>".$car['plate_number']."</td>";
                                $row .= "<td>".$car['current_color']."</td>";
                                $row .= "<td>".$car['target_color']."</td>";
                                $row .= "<td><button type='button' class='btn btn-secondary btn-sm' id='car_done' value='".$car['id']."'>Mark As Completed</button></td>";
                                $row .= "</tr>";
                            } else {
                                break;
                            }
                        }
                        echo $row;
                    ?>
                    
                </tbody>
            </table>
        </div>
        <div class="col-4">
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <h6>Paint Queue</h6>
            <table class="table mt-3">
                <tr>
                    <th>Plate Number</th>
                    <th>Current Color</th>
                    <th>Target Color</th>
                    <th></th>
                </tr>
                <tbody id="car_queue">
                    <?php
                        $row = "";
                        foreach($car_queue as $car){
                            $queue = $car['car_queue'];
                            if($queue == 1){
                                $row .= "<tr>";
                                $row .= "<td>".$car['plate_number']."</td>";
                                $row .= "<td>".$car['current_color']."</td>";
                                $row .= "<td>".$car['target_color']."</td>";
                                $row .= "<td></td>";
                                $row .= "</tr>";
                            }
                        }
                        echo $row;
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>

  </div>
  
</div>

<script>
    $('#submit').click(function(){
        var plate_num = $("#plate_num").val(),
            curr_color = $("#curr_color").val(),
            target_color = $("#target_color").val();

        $.ajax({
            type: 'POST',
            url: '<?=base_url("index.php/Car/check_queue"); ?>',
            data: {
                'plate_num': plate_num,
                'curr_color':curr_color,
                'target_color': target_color,
            },
            dataType: 'json',
            success: function () {
                alert("Sucessfully Added.");
                $("#plate_num").val("");
                $("#curr_color").val("");
                $("#target_color").val("");
            }
        });
    });

    $('#curr_color').change(function(){
        var color = $(this).val();
        var src = "<?=base_url('assets/img/')?>"+color+"Car.png";
        $("#curr_color_car").attr("src", src);
    });

    $('#target_color').change(function(){
        var color = $(this).val();
        var src = "<?=base_url('assets/img/')?>"+color+"Car.png";
        $("#target_color_car").attr("src", src);
    });
    

    $(document).on('click', '#car_done', function(){
        var id = $(this).val();

        $.ajax({
            type: 'POST',
            url: '<?=base_url("index.php/Car/car_completed"); ?>',
            data: {
                'id': id,
            },
            dataType: 'json',
            success: function () {
            }
        });
    });
</script>