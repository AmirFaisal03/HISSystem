document.querySelectorAll('.delete-from-cart').forEach(button => {
    button.addEventListener('click', function(e) {
        const cartKey = e.target.getAttribute('data-cart-key');

        fetch('Backend/remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cartKey=${cartKey}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload(); 
            }
        });
    });
});
