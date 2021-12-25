<div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
                      <h1 class="my-4">Qureka Project Stastics</h1>
                      <div class="form-group">
                            <select class="form-control" name="" id="">
                            <?php for($i=0; $i<count($year); $i++) {
                                if($i == count($year)-1){ ?>
                                <option value="<?php echo $year[$i]['invoice_year']; ?>" selected><?php echo $year[$i]['invoice_year']; ?></option>
                                <?php }else{ ?>
                                <option value="<?php echo $year[$i]['invoice_year']; ?>"><?php echo $year[$i]['invoice_year']; ?></option>
                              <?php }} ?>
                            </select>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                  <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Monthly Income Chart</div>
                                  <div class="card-body">
                                    <canvas id="barChart"></canvas>
                                  </div>
                                </div>
                            </div>
                          <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Monthly Income Chart</div>
                                  <div class="card-body">
                                    <canvas id="lineChart"></canvas>
                                  </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Monthly Income Chart</div>
                                  <div class="card-body">
                                    <canvas id="pieChart"></canvas>
                                  </div>
                                </div>
                            </div>
                          </div>
                          </div>
                         
    </div>
</main>
<script>
function updateChart(amount_array, month_array) {
    var ctxL = document.getElementById("barChart").getContext('2d');

    var myLineChart1 = new Chart(ctxL, {
        type: 'line',
        data: {
            labels:  month_array,
            datasets: [{
                    label: false,
                    data: amount_array,
                    backgroundColor: [
                        'hsla(0, 100%, 70%, 0.3)',
                    ],
                    borderColor: [
                        'rgba(200, 99, 132, .7)',
                    ],
                    borderWidth: 2
                },
            ]
        },
        options: {
            legend: {
            display: false,
            },
            responsive: true,
        }
    });
}
</script>
<script>
function fetch_monthly_sub(data){
var ctxL = document.getElementById("lineChart").getContext('2d');

var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
        datasets: data
    },
    options: {
        responsive: true
    }
});
}
</script>
<script>
function update_pie_chart(domain,total){

var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: domain,
        datasets: [{
            data: total,
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
        }]
    },
    options: {
        responsive: true
    }
});
}
</script>
<!-- fetching all data -->

<script>
    $(document).ready(function() {
              $('select').on('change', function() {
                var year = $('select').val();
                $.ajax({
                    url: '<?php echo base_url('admin/project_stats/fetch_all_stats_data/'); ?>',
                    data: {'year': year,'id' : <?php echo $id; ?>},
                    type: 'POST',
                    success: function(data) {
                      var obj = JSON.parse(data);
                      // console.log(obj);
                      
                      update_pie_chart(obj.total_all.sub_name,obj.total_all.sub_total);
                      updateChart(obj.amount,obj.month);
                      fetch_monthly_sub(obj.sub_project_data);
                    }
                });
          });
        
      });
</script>

<script>
    $(document).ready(function() {
                var year = <?php echo date('Y') ?>;
                $.ajax({
                    url: '<?php echo base_url('admin/project_stats/fetch_all_stats_data/'); ?>',
                    data: {'year': year,'id' : <?php echo $id; ?>},
                    type: 'POST',
                    success: function(data) {
                      var obj = JSON.parse(data);
                      // console.log(obj);
                      update_pie_chart(obj.total_all.sub_name,obj.total_all.sub_total);
                      updateChart(obj.amount,obj.month);
                      fetch_monthly_sub(obj.sub_project_data);
                    }
                });
        
      });
</script>