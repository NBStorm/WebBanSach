<div class="search-popup">
    <div class="search-popup-container">

        <div role="search" class="search-form">
            <input type="search" name="search-name" id="search-name" class="search-field"
                placeholder="Nhập và nhấn enter" value="" name="s" />
            <button type="submit" class="search-submit" onclick="searchProduct()"><svg class="search">
                    <use xlink:href="#search"></use>
                </svg></button>
        </div>

        <div class="" style="margin-top: 10px">
            <div class="row g-3 align-items-center">
                <div class="col-auto d-flex">
                    <label for="priceFrom" class="col-form-label">Từ: </label>
                    <input type="number" id="priceFrom" class="form-control" placeholder="Nhập giá thấp nhất">
                </div>
                <div class="col-auto d-flex">
                    <label for="priceTo" class="col-form-label">Đến: </label>
                    <input type="number" id="priceTo" class="form-control" placeholder="Nhập giá cao nhất">
                </div>
                <div class="col-auto d-flex">
                    <label for="bookCategory" class="col-form-label">Thể loại: </label>
                    <select id="bookCategory" class="form-select" style="height: 40px; width: 200px;">
                        <option value="0" selected></option>
                        <?php include("includes/theLoai.php") ?>
                        <!-- <option value="1">Tiểu thuyết</option>
                            <option value="2">Khoa học</option>
                            <option value="3">Văn học</option>
                            <option value="4">Lịch sử</option>
                            <option value="5">Kinh tế</option> -->
                    </select>
                </div>
                <!-- <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div> -->
            </div>
        </div>


        <!-- <h5 class="cat-list-title">Browse Categories</h5>

        <ul class="cat-list">
            <li class="cat-list-item">
                <a href="#" title="Mobile Phones">Mobile Phones</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Smart Watches">Smart Watches</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Headphones">Headphones</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Accessories">Accessories</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Monitors">Monitors</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Speakers">Speakers</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Memory Cards">Memory Cards</a>
            </li>
        </ul> -->

        <section id="rs-search" class="product-store position-relative padding-large no-padding-top">

        </section>

    </div>
</div>
<script>
// $(document).ready(function() {

//     $("#search-name").keyup(function() {
//         var search_name = $("#search-name").val();
//         if (search_name != "") {

//             $.ajax({
//                 url: "includes/search.php",
//                 method: "POST",
//                 data: {
//                     search_name: search_name
//                 },
//                 success: function(data) {
//                     $("#rs-search").html(data);
//                     $(".wi").css({
//                         "width": "270px",
//                     });
//                 }
//             });
//         } else $("#rs-search").html("");


//     })
// });

function searchProduct() {
    var priceFrom = document.getElementById('priceFrom').value;
    var priceTo = document.getElementById('priceTo').value;
    var bookCategory = document.getElementById('bookCategory').value;

    var priceFromValue = priceFrom ? parseFloat(priceFrom) : 0;
    var priceToValue = priceTo ? parseFloat(priceTo) : 0;

    if (priceFromValue < 0) {
        alert('Giá thấp nhất không được nhỏ hơn 0.');
        return;
    }

    if (priceToValue < 0) {
        alert('Giá cao nhất không được nhỏ hơn 0.');
        return;
    }

    if ((priceToValue !== 0) && (priceToValue < priceFromValue)) {
        alert('Giá cao nhất không được nhỏ hơn giá thấp nhất.');
        return;
    }

    var search_name = $("#search-name").val();

    $.ajax({
        url: "includes/search.php",
        method: "POST",
        data: {
            search_name: search_name,
            bookCategory: bookCategory,
            priceFrom: priceFromValue,
            priceTo: priceToValue
        },
        success: function(data) {
            $("#rs-search").html(data);
            $(".wi").css({
                "width": "270px",
            });
        }
    });
}
</script>