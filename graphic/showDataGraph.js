window.onload = function() {
    showDataGraph();
    setInterval(showDataGraph, 5000);
};

function showDataGraph()
{
    {
        let xhr = new XMLHttpRequest();

        xhr.open('POST', 'data.php');
        xhr.onload = function() 
        {
            console.log(xhr.responseText);
            let data = JSON.parse(xhr.responseText);
            let name = [];
            let points = [];

            for (let i in data) {
                name.push(data[i].name);
                points.push(data[i].points);
            }

            let chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Competition Points',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: points
                    }
                ]
            };

            let graphTarget = document.getElementById("graphCanvas");

            let barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata,
                options: {
                    scales: {
                        yAxes: [{
                                display: true,
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        };
        xhr.send();
    }
}