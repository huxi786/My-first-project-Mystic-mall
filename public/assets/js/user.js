document.addEventListener('DOMContentLoaded', function() {
    // Toggle mobile menu
    const mobileMenuBtn = document.createElement('div');
    mobileMenuBtn.className = 'mobile-menu-btn';
    mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
    document.querySelector('.dashboard-header').prepend(mobileMenuBtn);
    
    const sidebar = document.querySelector('.sidebar');
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
    
    
    
    // Add active class to nav items
    const navItems = document.querySelectorAll('.dashboard-nav li');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            navItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Add to cart button functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productName = this.closest('.item-details').querySelector('h3').textContent;
            alert(`${productName} added to cart!`);
        });
    });
    
    // Remove item from wishlist
    const removeItemButtons = document.querySelectorAll('.remove-item');
    removeItemButtons.forEach(button => {
        button.addEventListener('click', function() {
            const wishlistItem = this.closest('.wishlist-item');
            if (confirm('Are you sure you want to remove this item from your wishlist?')) {
                wishlistItem.style.transform = 'scale(0)';
                setTimeout(() => {
                    wishlistItem.remove();
                    updateWishlistCount();
                }, 300);
            }
        });
    });
    
    // Track order button functionality
    const trackButtons = document.querySelectorAll('.action-btn');
    trackButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.closest('tr').querySelector('td').textContent;
            alert(`Tracking order ${orderId}`);
        });
    });
    
    // Update wishlist count
    function updateWishlistCount() {
        const wishlistCount = document.querySelectorAll('.wishlist-item').length;
        document.querySelector('.stat-number:nth-child(3)').textContent = wishlistCount;
    }
    
    // Search functionality
    const searchInput = document.querySelector('.search-box input');
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            alert(`Searching for: ${this.value}`);
            this.value = '';
        }
    });
    
  
        
});