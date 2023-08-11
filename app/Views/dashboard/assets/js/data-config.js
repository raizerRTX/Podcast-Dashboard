const d = new Date();
var variantYear = d.getFullYear();
const baseYear = 2023;
let hash = $("#v_button").attr("data-hash");
var timer = 0;

$(document).ready(function(e) {
    let hash = $("#v_button").attr("data-hash");
    $('#myTable').DataTable( {
        "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
        "pageLength": 10,
        ajax: {
            url: "treeAnalytics",
            type: 'POST',
            data: {
                'csrf_test_name' : hash,
            },
            error: function(data) {
                console.log(data);
            }
        },
        language: {
            searchPlaceholder: "Search by column details..."
        },
        serverSide: false,
        responsive: true,
        "order": []
    });

    $('#forecast_tbl').DataTable( {
        "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
        "pageLength": 10,
        ajax: {
            url: "forecast",
            type: 'POST',
            data: {
                'csrf_test_name' : hash,
            },
            error: function(data) {
                console.log(data);
            }
        },
        language: {
            searchPlaceholder: "Search by column details..."
        },
        serverSide: false,
        responsive: true,
        "order": []
    });

    $('#statusTable').DataTable( {
        "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
        "pageLength": 10,
        ajax: {
            url: "treeStatus",
            type: 'POST',
            data: {
                'csrf_test_name' : hash,
            },
            error: function(data) {
                console.log(data);
            }
        },
        language: {
            searchPlaceholder: "Search by column details..."
        },
        serverSide: false,
        responsive: true,
        "order": []
    });

    setInterval (function () {
        reloadTreeAnalyticsTable();
        reloadForecastTable();
        treeManagement();
        reloadWidget();
    }, 1500);

    setInterval (function () {
        if (timer < 1800) {
            timer++;
        } else {
            location.reload();
        }
    }, 1000);

    $("#v_button").html(variantYear);
    $("#ct_button").html(variantYear);
    $("#beans_button").html(variantYear);
    growthSelectorUpdater();
    getCombinedTotalData();
    getPodsStatsData();
    getBeansStatsData();
    getCalendarEvents();
    treeManagement();
});

$(".v_selector").click(function (e) {
    $("#v_button").html($(this).html());
    variantYear = $(this).html();
    getPodsStatsData();
});

$(".ct_selector").click(function (e) {
    $("#ct_button").html($(this).html());
    variantYear = $(this).html();
    getCombinedTotalData();
});

$(".b_selector").click(function (e) {
    $("#beans_button").html($(this).html());
    variantYear = $(this).html();
    getBeansStatsData();
});

function growthSelectorUpdater() {
    if (variantYear != baseYear) {
        var diff = variantYear - baseYear;

        for (var i = 0; i <= diff; i++) {
            var newYear = baseYear + i;
            $("#cvs_items").append(`<a class="dropdown-item v_selector" >` + newYear + `</a>`);
            $("#ct_items").append(`<a class="dropdown-item ct_selector" >` + newYear + `</a>`);
            $("#b_items").append(`<a class="dropdown-item b_selector" >` + newYear + `</a>`);
        }
    } else {
        $("#cvs_items").html(`<a class="dropdown-item v_selector" >2023</a>`);
        $("#ct_items").html(`<a class="dropdown-item ct_selector" >2023</a>`);
        $("#b_items").append(`<a class="dropdown-item b_selector" >2023</a>`);
    }
}

function getPodsStatsData() {
    var categories = [];
    const url =  "variantAnalytics";
    let hash = $("#v_button").attr("data-hash");
    var postData = {
            "year" : variantYear,
            "csrf_test_name" : hash
    };
    
    getPageInfo(url, postData, function(response) {
        if (response.status != 200) {
            //Swal
        } else {
            const c_month = response.month;
            const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            for (var i = 1; i <= c_month; i++) {
                const d = new Date(String(i));
                let name = month[d.getMonth()];
                categories.push(name);
            }                

            podsStatisticsChart(response.var1.map(Number), response.var4.map(Number), response.var2.map(Number), response.var3.map(Number), response.var5.map(Number), categories);
            podsGrowthChart(parseInt(response.variant_growth));
        }
    }); 
}

function getCombinedTotalData() {
    const url =  "combinedTotal";
    let hash = $("#ct_button").attr("data-hash");
    var postData = {
            "year" : variantYear,
             "csrf_test_name" : hash
    };
    
    getPageInfo(url, postData, function(data) {

        if (data.status != 200) {
            //Swal
        } else {
            let ctCategories = [];
            const c_month = data.month;
            const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            for (var i = 1; i <= c_month; i++) {
                const d = new Date(String(i));
                let name = month[d.getMonth()];
                ctCategories.push(name);
            }
            combinedTotalChart(data.beans_data.map(Number), data.pods_data.map(Number), ctCategories);

            combinedTotalGrowtChart(parseInt(data.total_percentage));
        }
    }); 
}

function getBeansStatsData() {
    var categories = [];
    const url =  "beansAnalytics";
    let hash = $("#v_button").attr("data-hash");
    var postData = {
            "year" : variantYear,
            "csrf_test_name" : hash
    };
    
    getPageInfo(url, postData, function(response) {
        if (response.status != 200) {
            //Swal
        } else {
            const c_month = response.month;
            const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

            for (var i = 1; i <= c_month; i++) {
                const d = new Date(String(i));
                let name = month[d.getMonth()];
                categories.push(name);
            }                

            beansStatisticsChart(response.var1.map(Number), response.var4.map(Number), response.var2.map(Number), response.var3.map(Number), response.var5.map(Number), categories);
            beansGrowthChart(parseInt(response.beans_growth));
            
        }
    }); 
}

function getCalendarEvents() {
    const url =  "calendarAnalytics";
    let hash = $("#v_button").attr("data-hash");
    var postData = {
            "csrf_test_name" : hash
    };
    
    getPageInfo(url, postData, function(response) {
        let eventsData = [{}];
    
        for(var i = 0; i < response.count; i++) {
            eventsData.push({
                date: new Date(response.data[i]['expected_harvest']),
                eventName:"Tree ID: " + response.data[i]['tree_id'] + "<br>Tree Variant: " + response.data[i]['tree_variant'] + "<br>Expected Yield: " + response.data[i]['expected_yield'],
                className:"event_date",
                onclick(e, data) {
    
                },
                dateColor:"orange"
            });

            
        }
        $("#calendar").calendarGC({
            dayBegin: 1,
            events: eventsData,
            onclickDate:function (e, data) {
                console.log(e, data);
            }  
        });
    }); 
}

function treeManagement() {
    const url =  "treeManagement";
    let hash = $("#v_button").attr("data-hash");
    var postData = {
            "csrf_test_name" : hash
    };
    
    getPageInfo(url, postData, function(response) { 
        var farmerSize = response.farmer_data.length;
        var treeSize = response.tree_data.length;
        var counter = 0;
        var tree_id = 0;
        
        if (response.tree_count > 0) {
            $("#tree_management tbody tr").remove();
            if (response.partition > 0) {
                while (counter < farmerSize) { 
                    for(var i = 0; i < response.partition; i++) {
                        if (tree_id < treeSize) {
                            $("#tree_management").append("<tr><td>" + response.farmer_data[counter] + "</td><td>" +  response.tree_data[tree_id]['tree_id'] + "</td><td>" + response.tree_data[tree_id]['last_fertilize'] + "</td><td>" + response.tree_data[tree_id]['expected_yield'] + "</td><td>" + response.tree_data[tree_id]['variant'] + "</td></tr>");
                            tree_id++;
                        }
                    }
                    counter++;
                }
                
            } else {
               
                while (counter < treeSize) {
                    $("#tree_management").append("<tr><td>" + response.farmer_data[counter] + "</td><td>" +  response.tree_data[counter]['tree_id'] + "</td><td>" + response.tree_data[counter]['last_fertilize'] + "</td><td>" + response.tree_data[counter]['expected_yield'] + "</td><td>" + response.tree_data[counter]['variant'] + "</td></tr>");
                    counter++;
                }
                
            }
            
            
            $("#tree_management").rowMerge({
                excludedColumns: [3, 5],
                zeroIndexed:false // or true
            });
        } else {
            $("#tree_management tbody tr").remove();
            $("#tree_management").append(`<tr><td colspan="6">No Harvestable Tree Today</td></tr>`);
        }
    });

    $("#calculate").click(function(e) {
        let beansWeight = parseInt($("#input_weight").val());
        console.log(beansWeight);
        let result = beansWeight * 233;
        $("#resultField").val(numberWithCommas(parseFloat(result).toFixed(2)));
    });

    $("#search").keyup(function(e) {
        let searchValue = $("#search").val();
        if(searchValue != "") {
            if(searchValue.includes("combined")) {
                document.querySelector("#combined_total_panel").scrollIntoView();
            }

            if(searchValue.includes("cacao pods")) {
                document.querySelector("#cacao_pods_panel").scrollIntoView();
            }

            if(searchValue.includes("cacao beans")) {
                document.querySelector("#cacao_beans_panel").scrollIntoView();
            }

            if(searchValue.includes("calendar") || searchValue.includes("harvest")) {
                document.querySelector("#calendar_panel").scrollIntoView();
            }

            if(searchValue.includes("tree analytics") || searchValue.includes("tree")) {
                document.querySelector("#analytics_panel").scrollIntoView();
            }

            if(searchValue.includes("tree management") || searchValue.includes("manage") || searchValue.includes("assign")) {
                document.querySelector("#management_panel").scrollIntoView();
            }

            if(searchValue.includes("forecast") || searchValue.includes("manage") || searchValue.includes("tree forecast")) {
                document.querySelector("#forecast_panel").scrollIntoView();
            }
            
        }
    });
}

function reloadTreeAnalyticsTable() {
    var url = "treeAnalytics";
    var form = {'csrf_test_name' : hash};

    getPageInfo(url, form, function(data) {
        var table = $('#myTable').DataTable();
        var lastData = $('#myTable').DataTable().row( ':last', { order: 'applied' } );
        var lastId = lastData[0][0] + 1;

        if (lastId < data.size) {
            $("#myTable").DataTable().ajax.reload(null, false);
        } else {
            //Do nothing
        }

    });
}

function reloadForecastTable() {
    var url = "forecast";
    var form = {'csrf_test_name' : hash};

    getPageInfo(url, form, function(data) {
        var table = $('#forecast_tbl').DataTable();
        var lastData = $('#forecast_tbl').DataTable().row( ':last', { order: 'applied' } );
        var lastId = lastData[0][0] + 1;

        if (lastId < data.size) {
            $("#forecast_tbl").DataTable().ajax.reload(null, false);
        } else {
            //Do nothing
        }

    });
}


function reloadWidget() {
    var url = "widget";
    var form = {'csrf_test_name' : hash};

    getPageInfo(url, form, function(data) {
        var beansPercentage = data.beans_percentage;
        var podsPercentage = data.pods_percentage;
        var beansWeight = data.beans_w;
        var beansWeightPercentage = data.beans_w_percentage;
        var podsWeight = data.pods_w;
        var podsWeightPercentage = data.pods_w_percentage;

        if (beansPercentage > 0) {
            $("#beans_prcnt").removeClass("text-warning");
            $("#beans_prcnt").addClass("text-success");
            $("#beans_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + beansPercentage + `%`);
        } else if (beansPercentage < 0) {
            $("#beans_prcnt").removeClass("text-warning");
            $("#beans_prcnt").addClass("text-danger");
            $("#beans_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + beansPercentage + `%`);
        } else {
            $("#beans_prcnt").html(`--%`);
        }

        if (podsPercentage > 0) {
            $("#pods_prcnt").removeClass("text-warning");
            $("#pods_prcnt").addClass("text-success");
            $("#pods_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + podsPercentage + `%`);
        } else if (podsPercentage < 0) {
            $("#pods_prcnt").removeClass("text-warning");
            $("#pods_prcnt").addClass("text-danger");
            $("#pods_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + podsPercentage + `%`);
        } else {
            $("#pods_prcnt").html(`--%`);
        }

        if (beansWeightPercentage > 0) {
            $("#beans_w_prcnt").removeClass("text-warning");
            $("#beans_w_prcnt").addClass("text-success");
            $("#beans_w_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + beansWeightPercentage + `%`);
        } else if (beansWeightPercentage < 0) {
            $("#beans_w_prcnt").removeClass("text-warning");
            $("#beans_w_prcnt").addClass("text-danger");
            $("#beans_w_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + beansWeightPercentage + `%`);
        } else {
            $("#beans_w_prcnt").html(`--%`);
        }

        if (podsWeightPercentage > 0) {
            $("#pods_w_prcnt").removeClass("text-warning");
            $("#pods_w_prcnt").addClass("text-success");
            $("#pods_w_prcnt").html(`<i class="bx bx-up-arrow-alt"></i>+` + podsWeightPercentage + `%`);
        } else if (podsWeightPercentage < 0) {
            $("#pods_w_prcnt").removeClass("text-warning");
            $("#pods_w_prcnt").addClass("text-danger");
            $("#pods_w_prcnt").html(`<i class="bx bx-down-arrow-alt"></i>-` + podsWeightPercentage + `%`);
        } else {
            $("#pods_w_prcnt").html(`--%`);
        }

        if (beansWeight < 1000) {
            $("#beans_weight").html(beansWeight + " g.");
        } else if (beansWeight < 1000000 && beansWeight > 1000) {
            var newWeight = beansWeight * 0.001;
            $("#beans_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " kg.");
        } else if (beansWeight > 1000000) {
            var newWeight = beansWeight * 0.0001;
            $("#beans_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " T.");
        }

        if (podsWeight < 1000) {
            $("#pods_weight").html(podsWeight + " g.");
        } else if (podsWeight < 1000000 && podsWeight > 1000) {
            var newWeight = podsWeight * 0.001;
            $("#pods_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " kg.");
        } else if (podsWeight > 1000000) {
            var newWeight = podsWeight * 0.001;
            $("#pods_weight").html(numberWithCommas(parseFloat(newWeight).toFixed(2)) + " T.");
        } 
    });
}

$("#generate_report_btn").click(function(e) {
   $(this).text("Generating Report");
   
   const url =  "generateReport";
    let hash = $("#v_button").attr("data-hash");
    var postData = {
            "csrf_test_name" : hash
    };
    
    getPageInfo(url, postData, function(response) {
        if (response.response == 200) {
            $("#generate_report_btn").text("Generate Report");
            downloadFile(response.file_name);
        }
    });
   
});


function downloadFile(fileName) {
    fetch("/PodCast-Dashboard/getFile?file=" + fileName)
    .then(resp => resp.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = fileName;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(() => 
        Swal.fire({
            title: "Download Error",
            text: "Something went wrong during download process",
            icon: "error",
        }) .then((value) => {
            if (value) {
               
            } else {
                
            }
        })
    );
}



