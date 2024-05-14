<div class="search-popup">
    <div class="search-popup-container">

        <form role="search" method="get" class="search-form" action="">
            <input type="search" name="search-name" id="search-name" class="search-field"
                placeholder="Type and press enter" value="" name="s" />
            <button type="submit" class="search-submit"><svg class="search">
                    <use xlink:href="#search"></use>
                </svg></button>
        </form>

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

    var action = "search";

    $("#search-name").keyup(function() {
        var search_name = $("#search-name").val();
        if (search_name != "") {

            $.ajax({
                url: "includes/search.php",
                method: "POST",
                data: {
                    action: action,
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