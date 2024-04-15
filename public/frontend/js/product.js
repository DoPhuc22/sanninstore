// refresh cart after add product
setInterval(function () {
    $("#cartParent").load('/cart #myCart');
}, 1000);

// add to cart
$("#addToCartAjax").click(function (ev) {
    // lay id
    let productId = window.location.pathname.split('/')[2];
    let url = "/addToCartAjax/" + productId
    //add
    $.ajax({
        type: "GET", url: url, data: {}, success: function (data) {
            // Ajax call completed successfully
            alert("Add item to cart successfully");

        }, error: function (data) {
            // Some error in ajax call
            alert("Error");
        }
    });
});



