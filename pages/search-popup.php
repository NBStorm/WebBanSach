<div class="search-popup">
    <div class="search-popup-container">

        <div role="search" class="search-form">
            <input type="search" name="search-name" id="search-name" class="search-field"
                placeholder="Type and press enter" value="" name="s" />
            <button type="submit" class="search-submit"><svg class="search">
                    <use xlink:href="#search"></use>
                </svg></button>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            <span>Giá:</span>
            <label for="lowestPrice">Từ</label>
            <input id="lowestPrice" type="number">
            <label for="highestPrice"> đến </label>
            <input id="highestPrice" type="number">
            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false" style="width: 100px;">Thể loại</a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item">About</a>
                </li>
                <li>
                    <a href="blog.html" class="dropdown-item">Blog</a>
                </li>
                <li>
                    <a href="shop.html" class="dropdown-item">Shop</a>
                </li>
                <li>
                    <a href="cart.html" class="dropdown-item">Cart</a>
                </li>
                <li>
                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                </li>
                <li>
                    <a href="single-post.html" class="dropdown-item">Single Post</a>
                </li>
                <li>
                    <a href="single-product.html" class="dropdown-item">Single Product</a>
                </li>
                <li>
                    <a href="contact.html" class="dropdown-item">Contact</a>
                </li>
            </ul>
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