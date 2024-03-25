document.addEventListener('DOMContentLoaded', function () {
    var addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var productId = this.getAttribute('data-product-id');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_popularity.php?product_id=' + productId, true);
            xhr.send();
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var viewMoreButtons = document.querySelectorAll('.view-more');

    viewMoreButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var productId = this.getAttribute('data-product-id');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_view.php?product_id=' + productId, true);
            xhr.send();
        });
    });
});

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function(e) {
        const productId = e.target.getAttribute('data-product-id');
        const productDiv = e.target.closest('.product');
        
        const color = productDiv.querySelector('.product-color').value;
        const size = productDiv.querySelector('.product-size').value;

        fetch('Backend/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `productId=${productId}&color=${color}&size=${size}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateCartCount();
            }
        });
    });
});

function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    const currentCount = parseInt(cartCountElement.textContent, 10);
    cartCountElement.textContent = currentCount + 1;
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.category-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var targetId = this.getAttribute('href').substring(1);

            document.getElementById(targetId).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});

document.getElementById('toggle-button').addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById('toggle-checkbox').click();
});

