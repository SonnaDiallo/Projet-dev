document.addEventListener("DOMContentLoaded", function() {
    var proposerService = document.querySelector('a[href="#proposer-service"]');
    proposerService.addEventListener("mouseover", function() {
        proposerService.textContent = "Chercher un service";
    });
    proposerService.addEventListener("mouseout", function() {
        proposerService.textContent = "Proposer un service";
    });
});


// Ajoutez des animations d'apparition pour les profils
document.addEventListener('DOMContentLoaded', function() {
    const profiles = document.querySelectorAll('.profile');
    profiles.forEach((profile, index) => {
        profile.style.opacity = 0;
        profile.style.transition = `opacity 0.5s ease ${index * 0.2}s`;
        setTimeout(() => {
            profile.style.opacity = 1;
        }, 300);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const filterButton = document.querySelector('.filter-container button');
    const categoryFilter = document.getElementById('category-filter');
    const locationFilter = document.getElementById('location-filter');
    const priceFilter = document.getElementById('price-filter');
    const profiles = document.querySelectorAll('.profile');

    filterButton.addEventListener('click', () => {
        const category = categoryFilter.value;
        const location = locationFilter.value;
        const price = priceFilter.value;

        profiles.forEach(profile => {
            const profileCategory = profile.getAttribute('data-category');
            const profileLocation = profile.getAttribute('data-location');
            const profilePrice = parseInt(profile.getAttribute('data-price'));

            let categoryMatch = !category || profileCategory === category;
            let locationMatch = !location || profileLocation === location;
            let priceMatch = true;

            if (price) {
                const [minPrice, maxPrice] = price.split('-').map(Number);
                priceMatch = (maxPrice ? profilePrice >= minPrice && profilePrice <= maxPrice : profilePrice >= minPrice);
            }

            if (categoryMatch && locationMatch && priceMatch) {
                profile.style.display = '';
            } else {
                profile.style.display = 'none';
            }
        });
    });
});

