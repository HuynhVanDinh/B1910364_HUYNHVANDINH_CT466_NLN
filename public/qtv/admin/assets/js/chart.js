let myChart = document.getElementById("myChart").getContext("2d");
const ngayKhamDataElement = document.querySelector("#month");
const dttDataElement = document.querySelector("#doanhthuthang");
// Lấy dữ liệu về ngày khám từ phần tử HTML data-ngaykham
const redDates = JSON.parse(ngayKhamDataElement.dataset.month);
const redDtt = JSON.parse(dttDataElement.dataset.dtt);
// Global Options
Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = "#777";

let massPopChart = new Chart(myChart, {
  type: "bar", // bar, horizontalBar, pie, line, doughnut, radar, polarArea
  data: {
    labels: redDates,
    datasets: [
      {
        label: "Tổng doanh thu",
        data: redDtt,
        //backgroundColor:'green',
        backgroundColor: [
          "rgba(255, 99, 132, 0.6)",
          "rgba(54, 162, 235, 0.6)",
          "rgba(255, 206, 86, 0.6)",
          "rgba(75, 192, 192, 0.6)",
          "rgba(153, 102, 255, 0.6)",
          "rgba(255, 159, 64, 0.6)",
          "rgba(255, 99, 132, 0.6)",
        ],
        borderWidth: 1,
        borderColor: "#777",
        hoverBorderWidth: 3,
        hoverBorderColor: "#000",
      },
    ],
  },
  options: {
    title: {
      display: true,
      text: "Doanh thu trong 12 tháng",
      fontSize: 25,
    },
    legend: {
      display: true,
      position: "right",
      labels: {
        fontColor: "#000",
      },
    },
    layout: {
      padding: {
        left: 50,
        right: 0,
        bottom: 0,
        top: 0,
      },
    },
    tooltips: {
      enabled: true,
    },
  },
});
