function generateDoughnut(canvasID,legendID,year,label,dnData,desc){
    var areaData = {
        labels: label,
        datasets: [{
            data: dnData,
            backgroundColor: [
            "#4B49AC","#FFC100", "#FF4747", "#248AFD"
            ],
            borderColor: "rgba(0,0,0,0)"
        }]
    };
    var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 78,
        elements: {
            arc: {
                borderWidth: 4
            }
        },      
        legend: {
            display: false
        },
        tooltips: {
            enabled: true
        },
        legendCallback: function(chart) { 
        var text = [];
        text.push('<div class="report-chart">');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0 fontLao">'+desc[0]+'</p></div>');
            text.push('<p class="mb-0">'+dnData[0].toLocaleString('en-US')+'</p>');
            text.push('</div>');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0 fontLao">'+desc[1]+'</p></div>');
            text.push('<p class="mb-0">'+dnData[1].toLocaleString('en-US')+'</p>');
            text.push('</div>');
            text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0 fontLao">'+desc[2]+'</p></div>');
            text.push('<p class="mb-0">'+dnData[2].toLocaleString('en-US')+'</p>');
            text.push('</div>');
            // text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[3] + '"></div><p class="mb-0 fontLao">'+desc[3]+'</p></div>');
            // text.push('<p class="mb-0">'+dnData[3].toLocaleString('en-US')+'</p>');
            // text.push('</div>');
        text.push('</div>');
        return text.join("");
        },
    }
    var northAmericaChartPlugins = {
        beforeDraw: function(chart) {
        var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;
    
        ctx.restore();
        var fontSize = 2.525;
        ctx.font = "500 " + fontSize + "em Nunito";
        ctx.textBaseline = "middle";
        ctx.fillStyle = "#13381B";
    
        var text = year,
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;
    
        ctx.fillText(text, textX, textY);
        ctx.save();
        }
    }
    var northAmericaChartCanvas = $("#"+canvasID).get(0).getContext("2d");
    var northAmericaChart = new Chart(northAmericaChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: northAmericaChartPlugins
    });
    document.getElementById(legendID).innerHTML = northAmericaChart.generateLegend();
}
