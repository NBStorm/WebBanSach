document.addEventListener('DOMContentLoaded', function () {
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

            data.forEach(function (item) {
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

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('thongke')) {
    document.addEventListener('DOMContentLoaded', (event) => {
        // Set the start date to 1/1/2023
        const startDate = document.getElementById('start-date');
        startDate.value = '2023-01-01';

        // Set the end date to today's date
        const endDate = document.getElementById('end-date');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        endDate.value = `${year}-${month}-${day}`;
    });

    var productChart;
    $(document).ready(function () {
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();

            let startDate = $('#start-date').val();
            let endDate = $('#end-date').val();

            if (!startDate || !endDate) {
                alert('Vui lòng chọn cả ngày bắt đầu và ngày kết thúc.');
                return;
            }
    
            if (new Date(startDate) > new Date(endDate)) {
                alert('Ngày kết thúc phải lớn hơn ngày bắt đầu.');
                return;
            }

            $.ajax({
                url: 'sanphambanchay.php',
                method: 'POST',
                dataType: 'json', // Ensure the response is parsed as JSON
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (response) {
                    console.log(response); // Log the response for debugging
                    // Ensure response is an array
                    if (Array.isArray(response)) {
                        let labels = [];
                        let data = [];
                        let tableContent = '';

                        response.forEach(function (item) {
                            labels.push(item.TenSP);
                            data.push(item.total_quantity);

                            tableContent += '<tr>';
                            tableContent += '<td>' + item.MaSP + '</td>';
                            tableContent += '<td>' + item.TenSP + '</td>';
                            tableContent += '<td>' + item.total_quantity + '</td>';
                            tableContent += '</tr>';
                        });
                        if (productChart) {
                            productChart.destroy();
                        }
                        var ctx = document.getElementById('productChart').getContext('2d');
                        productChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total Quantity Sold',
                                    data: data,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        // Add more colors depending on the number of data
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        // Add more colors depending on the number of data
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                animation: {
                                    animateScale: true,
                                    animateRotate: true
                                }
                            }
                        });

                        $('#value tbody').html(tableContent);
                    } else {
                        console.error('Unexpected response format', response);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error: ' + textStatus + ' - ' + errorThrown);
                    console.error('Response text: ', jqXHR.responseText); // Add this line to log the response text
                }
            });
        });
    });

    $(document).ready(function () {
        // Hàm để lấy dữ liệu mặc định từ máy chủ
        function getDefaultData() {
            var startDate = '2023-01-01'; // Ngày bắt đầu mặc định
            var endDate = getCurrentDate(); // Ngày kết thúc là ngày hiện tại
            $.ajax({
                url: 'sanphambanchay.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (response) {
                    console.log(response); // Log the response for debugging
                    // Vẽ biểu đồ với dữ liệu nhận được
                    renderChartAndTable(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error: ' + textStatus + ' - ' + errorThrown);
                    console.error('Response text: ', jqXHR.responseText);
                }
            });
        }

        // Hàm để vẽ biểu đồ và cập nhật bảng
        function renderChartAndTable(data) {
            let labels = [];
            let dataset = [];
            let tableContent = ''; // Chuỗi HTML để cập nhật bảng

            // Xử lý dữ liệu để vẽ biểu đồ và cập nhật bảng
            data.forEach(function (item) {
                labels.push(item.TenSP);
                dataset.push(item.total_quantity);

                // Tạo dòng mới trong bảng
                tableContent += '<tr>';
                tableContent += '<td>' + item.MaSP + '</td>';
                tableContent += '<td>' + item.TenSP + '</td>';
                tableContent += '<td>' + item.total_quantity + '</td>';
                tableContent += '</tr>';
            });

            // Hủy bỏ biểu đồ cũ (nếu có)
            if (productChart) {
                productChart.destroy();
            }

            // Vẽ biểu đồ mới
            var ctx = document.getElementById('productChart').getContext('2d');
            productChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Quantity Sold',
                        data: dataset,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            // Add more colors depending on the number of data
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            // Add more colors depending on the number of data
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            // Cập nhật nội dung của bảng
            $('#value tbody').html(tableContent);
        }

        // Hàm để lấy ngày hiện tại
        function getCurrentDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
            var yyyy = today.getFullYear();
            return yyyy + '-' + mm + '-' + dd;
        }

        // Gọi hàm getDefaultData khi trang được tải
        getDefaultData();
    });

}
