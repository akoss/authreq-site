(function($) {
  'use strict';
  $(function() {

  var doughnutPieData = {
      datasets: [{
        data: [25, 15, 30, 43, 82, 11],
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(54, 162, 235, 0.5)',
          'rgba(255, 206, 86, 0.5)',
          'rgba(75, 192, 192, 0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(255, 159, 64, 0.5)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
      }],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: [
        'Groceries',
        'Dining Out',
        'Communication',
        'Utility',
        'Clothing',
        'Fee',
      ]
    };
    var doughnutPieOptions = {
      responsive: true,
      animation: {
        animateScale: true,
        animateRotate: true
      }
    };

    if ($("#pieChart").length) {
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
    }

    if ($("#sales-chart").length) {
      var ctx = document.getElementById('sales-chart').getContext("2d");

      var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, 'rgba(83, 227 ,218, 0.6)');
      gradientStroke1.addColorStop(1, 'rgba(45, 180 ,235, 0.6)');

      var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, 'rgba(132, 179 ,247, 0.6)');
      gradientStroke2.addColorStop(1, 'rgba(164, 90 ,249, 0.6)');

      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: ["Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan"],
              datasets: [
                {
                  yAxisID: 'Spendings',
                  label: "Spendings",
                  borderColor: gradientStroke2,
                  backgroundColor: gradientStroke2,
                  pointRadius: 0,
                  fill: false,
                  borderWidth: 1,
                  fill: 'origin',
                  data: [1700, 2000, 1620, 1400, 1200, 1000, 1800, 1000]
                },
                {
                  yAxisID: 'Savings',
                  label: "Savings",
                  borderColor: gradientStroke1,
                  borderColor: gradientStroke1,
                  backgroundColor: gradientStroke1,
                  pointRadius: 0,
                  fill: false,
                  borderWidth: 1,
                  fill: 'origin',
                  data: [5103.20,6303.20,6803.20,7903.20,8103.20,9103.20,10003.20,10109.30]
                }
            ]
          },
          options: {
              legend: {
                  position: "bottom"
              },
              scales: {
                xAxes: [{
                  ticks: {
                    display: true,
                    beginAtZero:true,
                    fontColor: 'rgba(0, 0, 0, 1)'
                  },
                  gridLines: {
                    display:false,
                    drawBorder: false,
                    color: 'transparent',
                    zeroLineColor: '#eeeeee'
                  }
                }],
                yAxes: [{
                  id: 'Spendings',
                  gridLines: {
                    drawBorder: false,
                    display:true,
                    color: '#eeeeee',
                  },
                  categoryPercentage: 0.5,
                  ticks: {
                    display: true,
                    beginAtZero: true,
                    stepSize: 500,
                    max: 2500,
                    fontColor: 'rgba(132, 179 ,247, 1.0)'
                  }
                }, {
                  id: 'Savings',
                  position: 'right',
                  gridLines: {
                    drawBorder: false,
                    display:true,
                    color: '#eeeeee',
                  },
                  categoryPercentage: 0.5,
                  ticks: {
                    display: true,
                    beginAtZero: false,
                    stepSize: 2000,
                    min: 5000,
                    max: 11000,
                    fontColor: 'rgba(83, 227 ,218, 1.0)'
                  }
                }]
              },
              },
              elements: {
                point: {
                  radius: 0
                }
              }
            })
    }
    if ($("#satisfaction-chart").length) {
      var ctx = document.getElementById('satisfaction-chart').getContext("2d");

      var gradientStrokeBluePurple = ctx.createLinearGradient(0, 0, 0, 250);
      gradientStrokeBluePurple.addColorStop(0, '#5607fb');
      gradientStrokeBluePurple.addColorStop(1, '#9425eb');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26],
              datasets: [
                {
                  label: "Audi",
                  borderColor: gradientStrokeBluePurple,
                  backgroundColor: gradientStrokeBluePurple,
                  hoverBackgroundColor: gradientStrokeBluePurple,
                  pointRadius: 0,
                  fill: false,
                  borderWidth: 1,
                  fill: 'origin',
                  data: [50, 45, 25, 35, 40, 25, 15, 40, 20, 15, 30, 50, 26, 45, 37, 26]
                }
            ]
          },
          options: {
              legend: {
                  display: false
              },
              scales: {
                  yAxes: [{
                      ticks: {
                          display: false,
                          min: 0,
                          stepSize: 10
                      },
                      gridLines: {
                        drawBorder: false,
                        display: true
                      }
                  }],
                  xAxes: [{
                      gridLines: {
                        display:false,
                        drawBorder: false,
                        color: 'rgba(0,0,0,1)',
                        zeroLineColor: '#eeeeee'
                      },
                      ticks: {
                          padding: 20,
                          fontColor: "rgba(0,0,0,1)",
                          autoSkip: true,
                          maxTicksLimit: 6
                      },
                      barPercentage: 0.7
                  }]
                }
              },
              elements: {
                point: {
                  radius: 0
                }
              }
            })
    }
  });
})(jQuery);