<div class="search-popup">
    <div class="search-popup-container">

        <div role="search" class="search-form">
            <input type="search" name="search-name" id="search-name" class="search-field"
                placeholder="Nhập và nhấn enter" value="" name="s" />
            <button type="submit" class="search-submit"><svg class="search">
                    <use xlink:href="#search"></use>
                </svg></button>
        </div>

        <div class="container mt-5">
        <form>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="priceFrom" class="col-form-label">Giá từ</label>
                    <input type="number" id="priceFrom" class="form-control" placeholder="Nhập giá từ">
                </div>
                <div class="col-auto">
                    <label for="priceTo" class="col-form-label">Giá đến</label>
                    <input type="number" id="priceTo" class="form-control" placeholder="Nhập giá đến">
                </div>
                <div class="col-auto">
                    <label for="bookCategory" class="col-form-label">Thể loại</label>
                    <select id="bookCategory" class="form-select">
                        <option value="" selected>Chọn thể loại</option>
                        <option value="1">Tiểu thuyết</option>
                        <option value="2">Khoa học</option>
                        <option value="3">Văn học</option>
                        <option value="4">Lịch sử</option>
                        <option value="5">Kinh tế</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
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
<script type="text/javascript">
$(document).ready(function() {

    $("#search-name").keyup(function() {
        var search_name = $("#search-name").val();
        if (search_name != "") {

            $.ajax({
                url: "includes/search.php",
                method: "POST",
                data: {
                    search_name: search_name
                },
                success: function(data) {
                    $("#rs-search").html(data);
                    $(".wi").css({
                        "width": "270px",
                    });
                }
            });
        } else $("#rs-search").html("");


    })
});
</script>