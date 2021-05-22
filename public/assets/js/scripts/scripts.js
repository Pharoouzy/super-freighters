function loadFile(preview) {
    var fileName = this.event.target.files[0].name;
    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.querySelector("." + preview).src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.event.target.files[0]);
}

function addToCart(menu_id, quantity = 1, action = "cart") {
    let id = menu_id;
    axios
        .post("/cart", {
            id,
            quantity,
        })
        .then((response) => {
            $(".cart-count").text(response.data.data.total_item);
            toastr.success(response.data.message);

            if (response.status === 200) {
                toastr.success("Please login to your account.");
            }

            if (action === "order") {
                window.location = "/checkout";
            }
        });
}

function updateCart(menu_id, quantity, type = "plus") {
    let id = menu_id;
    axios
        .put(`/cart/${menu_id}/update`, {
            id,
            quantity,
            type,
        })
        .then((response) => {
            $(".cart-count").text(response.data.data.total_item);
            $(".total_item").text(response.data.data.total_item);
            $(".total_amount").text(response.data.data.total_amount);
            $(".platform_fee").text(response.data.data.platform_fee);
            $(".subtotal").text(response.data.data.subTotal);
            toastr.success(response.data.message);
        });
}

function removeFromCart(menu_id) {
    let id = menu_id;
    axios.delete("/cart/" + id).then((response) => {
        if (response.status === 200) {
            $(".cart-count").text(response.data.data.total_item);
            $(".total_item").text(response.data.data.total_item);
            $(".total_amount").text(response.data.data.total_amount);
            $(".platform_fee").text(response.data.data.platform_fee);
            $(".subtotal").text(response.data.data.subTotal);
            toastr.success(response.data.message);
            $("#" + menu_id).css("background", "#CCCCCC");
            $("#" + menu_id).fadeOut("slow");
            $("#menu" + menu_id).css("background", "#CCCCCC");
            $("#menu" + menu_id).fadeOut("slow");

            if (response.data.total === 0) {
                location.reload();
            }
        }
    });
}
