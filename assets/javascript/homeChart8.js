const ctx8 = document.getElementById("myChart8");

const data8 = {
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

const chart8 = new Chart(ctx8, {
  type: "pie",
  data: data8,
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
