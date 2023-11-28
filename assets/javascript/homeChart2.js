const ctx2 = document.getElementById("myChart2");

const data2 = {
  //Seg 1 to 9
  labels: [
    "Usinagem",
    "Estamparia",
    "Tratamento térmico",
    "Fábrica de mola",
    "Montagem",
  ],
  datasets: [
    {
      label: "Acidentes",
      data: [10, 20, 30, 40, 50],
      backgroundColor: [
        "rgba(255, 99, 132, 0.9)",
        "rgba(54, 162, 235, 0.9)",
        "rgba(255, 206, 86, 0.9)",
        "rgba(75, 192, 192, 0.9)",
        "rgba(153, 102, 255, 0.9)",
      ],
      hoverOffset: 4,
    },
  ],
};

const chart2 = new Chart(ctx2, {
  type: "pie",
  data: data2,
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
  const slice = chart2.getElementsAtEventForMode(
    click,
    "nearest",
    { intersect: true },
    true
  );
  var index = slice[0].index;
  // console.log(index);
  // ? Redirect to './qa_upchart.php' passing $up as GET parameter
  window.location.href = "./qa_upchart.php?planta=1&up=" + index;
}

ctx2.onclick = onClickSlice;
