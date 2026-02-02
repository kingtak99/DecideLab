// Mobile menu toggle
document.getElementById("burger")?.addEventListener("click", () => {
    const burger = document.getElementById("burger");
    const links = document.querySelector(".nav-links");

    burger.classList.toggle("active");
    links.classList.toggle("active");
});

// Close mobile menu when clicking outside
document.addEventListener("click", (e) => {
    const burger = document.getElementById("burger");
    const links = document.querySelector(".nav-links");
    const navbar = document.querySelector(".navbar");

    if (!navbar.contains(e.target)) {
        burger?.classList.remove("active");
        links?.classList.remove("active");
    }
});

// Close mobile menu when clicking on a link
document.querySelectorAll(".nav-links a").forEach((link) => {
    link.addEventListener("click", () => {
        const burger = document.getElementById("burger");
        const links = document.querySelector(".nav-links");

        burger?.classList.remove("active");
        links?.classList.remove("active");
    });
});

// Handle long user names and initialize location
document.addEventListener("DOMContentLoaded", () => {
    const userBtn = document.querySelector(".user-btn");
    if (userBtn) {
        const userName = userBtn.textContent.trim();
        if (userName.length > 15) {
            userBtn.title = userName; // Show full name on hover
        }
    }

    // Initialize location functionality
    initializeLocation();
});

// Location functionality
function initializeLocation() {
    const locationBtn = document.getElementById("location-btn");
    const locationDropdown = document.querySelector(".location-dropdown");
    const dropdownMenu = document.querySelector(
        ".location-dropdown .dropdown-menu",
    );
    const currentFlag = document.getElementById("current-flag");
    const currentCountry = document.getElementById("current-country");
    const countrySearch = document.getElementById("country-search");
    const countriesList = document.getElementById("countries-list");

    // Load current location
    loadCurrentLocation();

    // Handle location button click to toggle dropdown
    locationBtn?.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();

        // Close other dropdowns
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            if (menu !== dropdownMenu) {
                menu.classList.remove("active");
            }
        });

        // Toggle this dropdown
        dropdownMenu.classList.toggle("active");

        // Load countries if not already loaded
        if (countriesList.children.length === 0) {
            loadCountries();
        }

        // Focus search input
        if (dropdownMenu.classList.contains("active")) {
            setTimeout(() => countrySearch?.focus(), 100);
        }
    });

    // Handle search
    countrySearch?.addEventListener("input", (e) => {
        loadCountries(e.target.value);
    });

    // Prevent dropdown from closing when clicking on search input
    countrySearch?.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (!locationDropdown.contains(e.target)) {
            dropdownMenu.classList.remove("active");
        }
    });
}

function loadCurrentLocation() {
    fetch("/location/current")
        .then((response) => response.json())
        .then((data) => {
            if (data.country) {
                updateCurrentLocation(data.country, data.flag_url);
                // Dispatch initial country state event immediately
                console.log("Navbar loaded initial country:", data.country);
                window.dispatchEvent(
                    new CustomEvent("countryChanged", {
                        detail: {
                            countryId: data.country.id,
                            country: data.country,
                        },
                    }),
                );

                // Dispatch navbar ready event
                window.dispatchEvent(new CustomEvent("navbarReady"));
                console.log("🌍 Navbar dispatched navbarReady event");
            }
        })
        .catch((error) => {
            console.error("Error loading current location:", error);
            // Default to Jordan
            const defaultCountry = {
                id: 1, // Assuming Jordan has ID 1
                name:
                    document.documentElement.lang === "ar"
                        ? "الأردن"
                        : "Jordan",
                code: "JOR",
            };
            updateCurrentLocation(defaultCountry, "https://flagcdn.com/jo.svg");
            // Dispatch default country event
            window.dispatchEvent(
                new CustomEvent("countryChanged", {
                    detail: {
                        countryId: defaultCountry.id,
                        country: defaultCountry,
                    },
                }),
            );

            // Dispatch navbar ready event even in error case
            window.dispatchEvent(new CustomEvent("navbarReady"));
            console.log("🌍 Navbar dispatched navbarReady event (fallback)");
        });
}

function updateCurrentLocation(country, flagUrl) {
    const currentFlag = document.getElementById("current-flag");
    const currentCountry = document.getElementById("current-country");

    if (currentFlag && flagUrl) {
        currentFlag.src = flagUrl;
        currentFlag.style.display = "inline-block";
    }

    if (currentCountry) {
        currentCountry.textContent =
            country.name ||
            (document.documentElement.lang === "ar"
                ? country.name_ar
                : country.name_en) ||
            country.name_en;
    }
}

function loadCountries(search = "") {
    const countriesList = document.getElementById("countries-list");

    fetch(`/location/countries?search=${encodeURIComponent(search)}`)
        .then((response) => response.json())
        .then((countries) => {
            countriesList.innerHTML = "";

            const seen = new Set(); // لتخزين الأسماء اللي ظهرت

            countries.forEach((country) => {
                // إذا الاسم موجود بالفعل، تجاهل هذا العنصر
                if (seen.has(country.name)) return;

                seen.add(country.name);

                const countryItem = document.createElement("a");
                countryItem.href = "#";
                countryItem.className = "country-item";
                // console.log(country.name);
                
                countryItem.innerHTML = `
                    <img src="${country.flag_url}" alt="${country.name}" class="flag">
                    <span>${country.name}</span>
                `;

                countryItem.addEventListener("click", (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    changeLocation(country.id, country, country.flag_url);
                });

                countriesList.appendChild(countryItem);
            });
        })
        .catch((error) => {
            console.error("Error loading countries:", error);
        });
}

function changeLocation(countryId, country, flagUrl) {
    fetch(`/location/change/${countryId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                updateCurrentLocation(data.country, data.flag_url);
                // Close dropdown
                document
                    .querySelector(".location-dropdown .dropdown-menu")
                    .classList.remove("active");

                // Dispatch custom event for other components to listen
                window.dispatchEvent(
                    new CustomEvent("countryChanged", {
                        detail: { countryId: countryId, country: data.country },
                    }),
                );
                console.log("🌍 Navbar dispatched countryChanged event:", {
                    countryId,
                    country: data.country,
                });
            }
        })
        .catch((error) => {
            console.error("Error changing location:", error);
        });
}

// Language switching functionality
document.addEventListener("DOMContentLoaded", () => {
    // Language dropdown functionality
    const languageBtn = document.getElementById("language-btn");
    const languageDropdown = document.querySelector(".dropdown");
    const languageMenu = languageDropdown?.querySelector(".dropdown-menu");

    // Handle language button click
    languageBtn?.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();

        // Close other dropdowns
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            if (menu !== languageMenu) {
                menu.classList.remove("active");
            }
        });

        // Toggle language dropdown
        languageMenu?.classList.toggle("active");
    });

    // Handle language selection - ensure links work correctly
    document.querySelectorAll(".language-link").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const lang = e.currentTarget.getAttribute("data-lang");
            // Force absolute URL to avoid any relative path issues
            window.location.href = window.location.protocol + "//" + window.location.host + "/lang/" + lang;
        });
    });

    // Close language dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (!languageDropdown?.contains(e.target)) {
            languageMenu?.classList.remove("active");
        }
    });
});

/* Logo responsive fix: If a CSS rule elsewhere overrides display, use inline styles on load/resize to guarantee only one logo variant is shown */
function debounce(fn, wait) {
    let t;
    return function (...args) {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, args), wait);
    };
}

function updateLogoForViewport() {
    const full = document.querySelector('.logo .logo-full');
    const short = document.querySelector('.logo .logo-short');
    if (!full || !short) return;

    if (window.innerWidth <= 600) {
        full.style.display = 'none';
        full.setAttribute('aria-hidden', 'true');
        short.style.display = 'inline-block';
        short.setAttribute('aria-hidden', 'false');
    } else {
        full.style.display = 'inline-block';
        full.setAttribute('aria-hidden', 'false');
        short.style.display = 'none';
        short.setAttribute('aria-hidden', 'true');
    }
}

// Run on initial load and on resize
document.addEventListener('DOMContentLoaded', updateLogoForViewport);
window.addEventListener('resize', debounce(updateLogoForViewport, 120));
