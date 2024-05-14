document.addEventListener('DOMContentLoaded', function() {
  fetch('thongKeThang.php')
      .then(response => {
          if (!response.ok) {
              throw new Error('Network response was not ok ' + response.statusText);
          }
          return response.json();
      })
      .then(data => {
          console.log('Fetched data:', data); // Log dữ liệu để kiểm tra

          var doanhThuThang = new Array(12).fill(0);
          var vonNhapThang = new Array(12).fill(0);
          
          data.forEach(function(item) {
              var month = parseInt(item.thang.split('-')[1]) - 1; // Lấy tháng từ 'YYYY-MM'
              doanhThuThang[month] = parseFloat(item.tong_doanh_thu);
              vonNhapThang[month] = parseFloat(item.tong_von_nhap);
          });

          var ctx = document.getElementById('lineChart').getContext('2d');
          var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
                          "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                  datasets: [{
                      label: 'Doanh thu',
                      data: doanhThuThang,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1,
                      fill: false,
                  }, {
                      label: 'Vốn nhập',
                      data: vonNhapThang,
                      backgroundColor: 'rgba(255, 159, 64, 0.2)',
                      borderColor: 'rgba(255, 159, 64, 1)',
                      borderWidth: 1,
                      fill: false,
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
      })
      .catch(error => console.error('Fetch error:', error));
});


