/**
 * Dashboard Analytics
 */

'use strict';
let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

// Combined Total Chart - Bar Chart
// --------------------------------------------------------------------
function combinedTotalChart(beansData, podsData, categories) {
    var combinedTotalChartOptions = {
      series: [
        {
          name: 'Cacao Pods',
          data: podsData
        },
        {
          name: 'Beans',
          data: beansData
        }
      ],
      chart: {
        height: 300,
        stacked: true,
        type: 'bar',
        toolbar: { show: true }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '33%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      xaxis: {
        categories: categories,
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#combinedTotalChart"), combinedTotalChartOptions);
    chart.render();
}

// Variant Statistics Chart
// --------------------------------------------------------------------
function podsStatisticsChart(value_1, value_2, value_3, value_4, value_5, category) {
    var variantStatisticsOptions = {
      series: [
        {
          name: 'UF-18',
          data: value_1
        },
        {
          name: 'K-2',
          data: value_2
        },
        {
          name: 'PBC-123',
          data: value_4
        },
        {
          name: 'BR-25',
          data: value_3
        },
        {
          name: 'K-9',
          data: value_5
        }
      ],
      chart: {
        height: 350,
        type: 'line',
        toolbar: { 
          show: true 
        },
        zoom: {
          enabled: true
        }
        
      },
      plotOptions: {
        bar: {
          columnWidth: '35%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info, "#E6A5BD", "#7209B7", "#4CC9F0"],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 3
        
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
         // colors: axisColor
        },
        itemMargin: {
          horizontal: 15
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        },
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },  
      },
      xaxis: {
        categories: category,
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: true
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#podsStatistics"), variantStatisticsOptions);
    chart.render();
}

function combinedTotalGrowtChart(percentage) {
    var  growthChartOptions = {
      series: [percentage],
      labels: ['Overall Increase'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '15px',
              fontWeight: '600',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#cGrowthChart"), growthChartOptions);
    chart.render();
}

function beansStatisticsChart(value_1, value_2, value_3, value_4, value_5, category) {
  var beansStatisticsOptions = {
    series: [
      {
        name: 'UF-18',
        data: value_1
      },
      {
        name: 'K-2',
        data: value_2
      },
      {
        name: 'BR-25',
        data: value_4
      },
      {
        name: 'PBC-123',
        data: value_3
      },
      {
        name: 'K-9',
        data: value_5
      }
    ],
    chart: {
      height: 350,
      type: 'line',
      toolbar: { 
        show: true 
      },
      zoom: {
        enabled: true
      }
      
    },
    plotOptions: {
      bar: {
        columnWidth: '35%',
        borderRadius: 12,
        startingShape: 'rounded',
        endingShape: 'rounded'
      }
    },
    colors: [config.colors.primary, config.colors.info, "#E6A5BD", "#7209B7", "#4CC9F0"],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    legend: {
      show: true,
      horizontalAlign: 'left',
      position: 'top',
      markers: {
        height: 8,
        width: 8,
        radius: 12,
        offsetX: -3
      },
      labels: {
       // colors: axisColor
      },
      itemMargin: {
        horizontal: 15
      }
    },
    grid: {
      borderColor: borderColor,
      padding: {
        top: 0,
        bottom: -8,
        left: 20,
        right: 20
      },
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },  
    },
    xaxis: {
      categories: category,
      labels: {
        style: {
          fontSize: '13px',
          colors: axisColor
        }
      },
      axisTicks: {
        show: false
      },
      axisBorder: {
        show: true
      }
    },
    yaxis: {
      labels: {
        style: {
          fontSize: '13px',
          colors: axisColor
        }
      }
    },
    responsive: [
      {
        breakpoint: 1700,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '32%'
            }
          }
        }
      },
      {
        breakpoint: 1580,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '35%'
            }
          }
        }
      },
      {
        breakpoint: 1440,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '42%'
            }
          }
        }
      },
      {
        breakpoint: 1300,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '48%'
            }
          }
        }
      },
      {
        breakpoint: 1200,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '40%'
            }
          }
        }
      },
      {
        breakpoint: 1040,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 11,
              columnWidth: '48%'
            }
          }
        }
      },
      {
        breakpoint: 991,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '30%'
            }
          }
        }
      },
      {
        breakpoint: 840,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '35%'
            }
          }
        }
      },
      {
        breakpoint: 768,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '28%'
            }
          }
        }
      },
      {
        breakpoint: 640,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '32%'
            }
          }
        }
      },
      {
        breakpoint: 576,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '37%'
            }
          }
        }
      },
      {
        breakpoint: 480,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '45%'
            }
          }
        }
      },
      {
        breakpoint: 420,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '52%'
            }
          }
        }
      },
      {
        breakpoint: 380,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 10,
              columnWidth: '60%'
            }
          }
        }
      }
    ],
    states: {
      hover: {
        filter: {
          type: 'none'
        }
      },
      active: {
        filter: {
          type: 'none'
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#beansStatistics"), beansStatisticsOptions);
  chart.render();
}

function podsGrowthChart(percentage) {
    var variantGrowthChartOptions = {
      series: [percentage],
      labels: ['Overall Increase'],
      chart: {
        height: 300,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '12px',
              fontWeight: '600',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#podsGrowthChart"), variantGrowthChartOptions);
    chart.render();
}

function beansGrowthChart(percentage) {
  var beansGrowthChartOptions = {
    series: [percentage],
    labels: ['Overall Increase'],
    chart: {
      height: 300,
      type: 'radialBar'
    },
    plotOptions: {
      radialBar: {
        size: 150,
        offsetY: 10,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '55%'
        },
        track: {
          background: cardColor,
          strokeWidth: '100%'
        },
        dataLabels: {
          name: {
            offsetY: 15,
            color: headingColor,
            fontSize: '12px',
            fontWeight: '600',
            fontFamily: 'Public Sans'
          },
          value: {
            offsetY: -25,
            color: headingColor,
            fontSize: '22px',
            fontWeight: '500',
            fontFamily: 'Public Sans'
          }
        }
      }
    },
    colors: [config.colors.primary],
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        shadeIntensity: 0.5,
        gradientToColors: [config.colors.primary],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 0.6,
        stops: [30, 70, 100]
      }
    },
    stroke: {
      dashArray: 5
    },
    grid: {
      padding: {
        top: -35,
        bottom: -10
      }
    },
    states: {
      hover: {
        filter: {
          type: 'none'
        }
      },
      active: {
        filter: {
          type: 'none'
        }
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#beansGrowthChart"), beansGrowthChartOptions);
  chart.render();
}

