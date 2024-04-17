window.addEventListener('DOMContentLoaded', event => {
  // Simple-DataTables
  // https://github.com/fiduswriter/Simple-DataTables/wiki

  const datatablesSimple = document.getElementById('datatablesSimple');
  if (datatablesSimple) {
    new DataTable(datatablesSimple);
  }

  var selectElement = document.getElementById("dt-length-0");
  if (selectElement) {
    // Xóa các option hiện tại
    selectElement.innerHTML = "";

    // Tạo và thêm các option mới
    var optionValues = [5, 10, 15, 20];
    for (var i = 0; i < optionValues.length; i++) {
      var option = document.createElement("option");
      option.value = optionValues[i];
      option.text = optionValues[i];
      selectElement.appendChild(option);
    }
  }

});


