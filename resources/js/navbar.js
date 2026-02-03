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
            userBtn.title = userName;
        }
    }

    initializeLocation();
});

/* ===========================
   LOCATION DROPDOWN
=========================== */

function initializeLocation() {
    const locationBtn = document.getElementById("location-btn");
    const locationDropdown = document.querySelector(".location-dropdown");
    const dropdownMenu = locationDropdown?.querySelector(".dropdown-menu");
    const countrySearch = document.getElementById("country-search");
    const countriesList = document.getElementById("countries-list");

    loadCurrentLocation();

    // 🔽 فتح / إغلاق dropdown (inline style فقط)
    locationBtn?.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();

        const isOpen = dropdownMenu.style.display === "block";
        console.log(
            "🌍 Location dropdown toggled:",
            isOpen ? "closing" : "opening",
        );
        // سكّر كل dropdowns ثانية
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            menu.style.display = "none";
        });

        // toggle الحالي
        dropdownMenu.style.display = isOpen ? "none" : "block";

        if (!isOpen && countriesList.children.length === 0) {
            loadCountries();
        }

        if (!isOpen) {
            setTimeout(() => countrySearch?.focus(), 100);
        }
    });

    // بحث
    countrySearch?.addEventListener("input", (e) => {
        loadCountries(e.target.value);
    });

    countrySearch?.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    // إغلاق عند الضغط خارجها
    document.addEventListener("click", () => {
        dropdownMenu.style.display = "none";
    });
}

/* ===========================
   LOAD CURRENT LOCATION
=========================== */

function loadCurrentLocation() {
    fetch("/location/current")
        .then((res) => res.json())
        .then((data) => {
            if (data.country) {
                updateCurrentLocation(data.country, data.flag_url);

                console.log("Navbar loaded initial country:", data.country);

                window.dispatchEvent(
                    new CustomEvent("countryChanged", {
                        detail: {
                            countryId: data.country.id,
                            country: data.country,
                        },
                    }),
                );

                window.dispatchEvent(new CustomEvent("navbarReady"));
                console.log("🌍 Navbar dispatched222 navbarReady event");
                initializeLocation();
            }
        })
        .catch(() => {
            const defaultCountry = {
                id: 1,
                name_en: "Jordan",
                name_ar: "الأردن",
            };

            updateCurrentLocation(defaultCountry, "https://flagcdn.com/jo.svg");

            window.dispatchEvent(
                new CustomEvent("countryChanged", {
                    detail: {
                        countryId: defaultCountry.id,
                        country: defaultCountry,
                    },
                }),
            );

            window.dispatchEvent(new CustomEvent("navbarReady"));
        });
}

/* ===========================
   UPDATE FLAG + NAME
=========================== */

function updateCurrentLocation(country, flagUrl) {
    console.log("Updating current location:", country, flagUrl);

    const flagImg = document.getElementById("current-flag");

    if (flagImg && flagUrl) {
        flagImg.src = flagUrl;
        flagImg.style.display = "inline-block";
    }
}

/* ===========================
   LOAD COUNTRIES
=========================== */

function loadCountries(search = "") {
    const countriesList = document.getElementById("countries-list");

    fetch(`/location/countries?search=${encodeURIComponent(search)}`)
        .then((res) => res.json())
        .then((countries) => {
            countriesList.innerHTML = "";

            const seen = new Set();

            countries.forEach((country) => {
                if (seen.has(country.name)) return;
                seen.add(country.name);

                const item = document.createElement("a");
                item.href = "#";
                item.className = "country-item";

                item.innerHTML = `
                    <img src="${country.flag_url}" class="flag">
                    <span>${country.name}</span>
                `;

                item.addEventListener("click", (e) => {
                    e.preventDefault();
                    changeLocation(country.id);
                });

                countriesList.appendChild(item);
            });
        });
}

/* ===========================
   CHANGE LOCATION (🔥 CORE)
=========================== */

function changeLocation(countryId) {
    console.log("🌍 changeLocation", countryId);

    const dropdownMenu = document.querySelector(
        ".location-dropdown .dropdown-menu",
    );
    const locationBtn = document.getElementById("location-btn");

    // ✅ سكّر dropdown فورًا (غصب)
    dropdownMenu.style.display = "none";

    // ⏳ spinner
    locationBtn.classList.add("loading");

    fetch(`/location/change/${countryId}`, {
        method: "POST",
        credentials: "same-origin",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (!data.success) throw new Error();

            updateCurrentLocation(data.country, data.flag_url);
            initializeLocation();
            window.dispatchEvent(
                new CustomEvent("countryChanged", {
                    detail: {
                        countryId,
                        country: data.country,
                    },
                }),
            );
            initializeLocation();
        })
        .catch(() => {
            alert("فشل تغيير الدولة، حاول مرة أخرى");
        })
        .finally(() => {
            locationBtn.classList.remove("loading");
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
        countryItem.addEventListener("click", (e) => {
            e.preventDefault();
            changeLocation(country.id, country, country.flag_url);
        });

        // Close other dropdowns
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            if (menu !== languageMenu) {
                menu.closest(".dropdown")?.classList.remove("active");
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
            window.location.href =
                window.location.protocol +
                "//" +
                window.location.host +
                "/lang/" +
                lang;
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
    const full = document.querySelector(".logo .logo-full");
    const short = document.querySelector(".logo .logo-short");
    if (!full || !short) return;

    if (window.innerWidth <= 900) {
        full.style.display = "none";
        full.setAttribute("aria-hidden", "true");
        short.style.display = "inline-block";
        short.setAttribute("aria-hidden", "false");
    } else {
        full.style.display = "inline-block";
        full.setAttribute("aria-hidden", "false");
        short.style.display = "none";
        short.setAttribute("aria-hidden", "true");
    }
}

// Run on initial load and on resize
document.addEventListener("DOMContentLoaded", updateLogoForViewport);
window.addEventListener("resize", debounce(updateLogoForViewport, 120));
