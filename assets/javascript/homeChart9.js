const ctx9 = document.getElementById("myChart9");

var arrLabels = [
  "UP01",
  "UP02",
  "UP07",
  "UP12",
  "UP15",
  "UP22",
  "UP28",
  "UP32.1",
  "UP32.2",
];
var arrData = [12, 12, 12, 12, 12, 12, 12, 12, 12];
var arrColors = [
  "rgba(255, 99, 132, 0.9)",
  "rgba(54, 162, 235, 0.9)",
  "rgba(255, 206, 86, 0.9)",
  "rgba(75, 192, 192, 0.9)",
  "rgba(153, 102, 255, 0.9)",
  "rgba(255, 159, 64, 0.9)",
  "rgba(255, 99, 132, 0.9)",
  "rgba(54, 162, 235, 0.9)",
  "rgba(255, 206, 86, 0.9)",
];

const data = {
  //Seg 1 to 9
  labels: arrLabels,
  datasets: [
    {
      label: "Acidentes",
      data: arrData,
      backgroundColor: arrColors,
      hoverOffset: 4,
    },
  ],
};

const chart9 = new Chart(ctx9, {
  type: "doughnut",
  data: data,
  options: {
    plugins: {
      tooltip: {
        enabled: false,
      },
      legend: {
        position: "top",
        align: "center",
        labels: {
          boxWidth: 15,
          boxHeight: 15,
          usePointStyle: true,
          padding: 11,
          font: {
            weight: "bold",
            size: 18,
          },
        },
      },
    },
    responsive: true,
    scales: {
      x: {
        display: false,
        grid: {
          display: false,
        },
      },
      y: {
        display: false,
        beginAtZero: true,
        grid: {
          display: false,
        },
      },
    },
  },
  plugins: [
    {
      beforeInit: function (chart, args, options) {
        const fitValue = chart.legend.fit;
        chart.legend.fit = function fit() {
          fitValue.bind(chart.legend)();
          return (this.height += 15);
        };
      },
    },
  ],
});

function onClickSlice(click) {
  const slice = chart9.getElementsAtEventForMode(
    click,
    "nearest",
    { intersect: true },
    true
  );
  var index = slice[0].index;
  // console.log(index);
  // ? Redirect to './qa_upchart.php' passing $up as GET parameter
  window.location.href = "./acd_chart.php?planta=0&up=" + index;
}

ctx9.onclick = onClickSlice;
