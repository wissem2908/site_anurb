<?php include 'includes/header.php'; ?>

<link href="assets/css/news.css" rel="stylesheet">
<style>
    .hidden-news {
        display: none !important;
    }

    /* calendar.css */
    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
    }

    .calendar-days span {
        position: relative;
        /* REQUIRED */
        display: flex;
        /* REQUIRED */
        align-items: center;
        justify-content: center;
        height: 38px;
        border-radius: 6px;
        cursor: pointer;
    }

    .calendar-indicator {
        position: absolute;
        /* bottom: 4px; */
        width: 4px;
        height: 2px !important;
        background-color: #28a745;
        border-radius: 50%;
    }


    .calendar-days span.selected {
        background: #007bff;
        color: #fff;
        border-radius: 6px;
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-1 text-white animated slideInDown">Actualités</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Accueil</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Actualités</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Actualités Page Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <!-- LEFT: Main news -->
            <div class="col-lg-8">

                <!-- Featured News -->
                <div class="featured-news mb-4">
                    <div class="featured-overlay">
                        <span class="badge-featured">À la une</span>
                        <h3>Chargement...</h3>
                        <p>Veuillez patienter...</p>
                    </div>
                </div>

                <input type="hidden" id="newsSlug" value="<?php echo isset($_GET['news']) ? htmlspecialchars($_GET['news']) : ''; ?>">
                <div class="news-main">
                    <div id="newsImagesCarousel" class="carousel slide news-carousel mb-3" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#newsImagesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#newsImagesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#newsImagesCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://picsum.photos/seed/anurb1/900/400" class="d-block w-100" alt="News image 1">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/seed/anurb2/900/400" class="d-block w-100" alt="News image 2">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/seed/anurb3/900/400" class="d-block w-100" alt="News image 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#newsImagesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Précédent</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#newsImagesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Suivant</span>
                        </button>
                    </div>
                    <h2>Visite d'étude dans le cadre de la coopération Algéro–Camerounaise</h2>
                    <div class="news-meta">
                        <span>Posté par</span>
                        <a href="#">admin</a>
                        <span>le 14-11-2025</span>
                        <span>|</span>
                        <span>Catégorie:</span>
                        <a href="#">Événement</a>
                    </div>
                    <div class="news-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis faucibus ligula. Nam sit amet dolor non risus ornare molestie. Duis aliquet massa vel leo auctor tristique. Vestibulum eu nibh dignissim, venenatis augue nec, posuere mi. Proin vestibulum massa ac maximus ultricies. Morbi magna nisl, dapibus suscipit neque non, pretium feugiat mauris. Quisque a massa quis elit accumsan tincidunt in ullamcorper turpis.</p>
                        <p>Vestibulum pulvinar odio vel tortor condimentum feugiat. Aliquam scelerisque condimentum auctor. Aliquam erat volutpat. Cras quis erat eget diam placerat varius quis ut urna. Duis quis magna in nisi blandit facilisis eget sed mauris. Cras id ante tellus. Pellentesque luctus nisl gravida eros accumsan, ut congue ligula varius. Proin aliquet, nisi quis efficitur vehicula, leo dolor pulvinar dolor, sodales condimentum elit erat sed arcu. Vestibulum feugiat eros eget metus viverra, nec tincidunt elit ornare.</p>
                        <p>ellentesque fermentum velit nec tellus laoreet, quis aliquet lacus rhoncus. Proin mollis tristique varius. Nam eget risus porttitor, porta dui ut, euismod lectus. Proin eu erat molestie augue porttitor mattis. Vivamus sagittis erat et facilisis viverra. Suspendisse tincidunt purus purus, quis eleifend nisl ullamcorper non. Donec finibus nunc nec auctor molestie. Phasellus at augue ac ante elementum aliquet quis sed felis. Sed eu odio lectus. Cras hendrerit lectus sed lorem facilisis sagittis. Morbi nec diam quis ipsum egestas finibus. Nulla eu quam tortor. Nam cursus, purus a interdum dignissim, augue urna imperdiet risus, id malesuada nibh nunc quis lectus. Pellentesque sit amet malesuada ipsum. Curabitur sed ex a velit maximus auctor. Cras molestie tempus urna id sodales.</p>
                    </div>
                    <div class="share-section">
                        <span>Partager:</span>
                        <div class="share-icons">
                            <i class="bi bi-facebook"></i>
                            <i class="bi bi-twitter"></i>
                            <i class="bi bi-linkedin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Sidebar -->
            <div class="col-lg-4 sidebar">
                <!-- Search -->
                <div class="search-box">
                    <input type="text" class="form-control" id="newsSearch" placeholder="Rechercher une actualité...">
                </div>

                <div class="search-results mt-2 sidebar-card"></div>


                <!-- Tags & Filters -->
                <div class="sidebar-card">
                    <h5>Filtrer par Category</h5>
                    <div class="tags-filters">
                        <button class="btn btn-outline-secondary btn-sm filter-btn" data-tag="urbanisme">Urbanisme</button>
                        <button class="btn btn-outline-secondary btn-sm filter-btn" data-tag="agriculture">Agriculture</button>
                        <button class="btn btn-outline-secondary btn-sm filter-btn" data-tag="evenement">Événement</button>
                        <button class="btn btn-outline-secondary btn-sm filter-btn" data-tag="formation">Formation</button>
                        <button class="btn btn-outline-secondary btn-sm filter-btn" data-tag="projet">Projet</button>
                    </div>
                </div>

                <!-- RELATED NEWS -->
                <div class="sidebar-card">
                    <h5>Articles liés</h5>
                    <div class="related-news-modern">

                        <!-- Empty State for Related News -->
                        <div class="related-news-modern empty-state text-center p-4" id="emptyRelatedNews" style="display:none;">
                            <i class="bi bi-file-earmark-text fs-1 mb-2"></i>
                            <h6>Aucun article lié trouvé</h6>
                            <p>Il n’existe pas encore d’articles liés à cet article.</p>
                        </div>


                        <!-- Article 1 -->
                        <a href="#" class="related-news-modern-item d-flex align-items-center">
                            <div class="thumb">
                                <img src="https://picsum.photos/seed/rel1/80/60" alt="Projet urbain durable">
                            </div>
                            <div class="text ms-3">
                                <small class="title">Projet urbain durable à Béjaïa</small>
                                <small class="date text-muted">20 Novembre 2025</small>
                            </div>
                        </a>

                        <!-- Article 2 -->
                        <a href="#" class="related-news-modern-item d-flex align-items-center">
                            <div class="thumb">
                                <img src="https://picsum.photos/seed/rel2/80/60" alt="Modernisation infrastructures">
                            </div>
                            <div class="text ms-3">
                                <small class="title">Modernisation des infrastructures agricoles</small>
                                <small class="date text-muted">15 Novembre 2025</small>
                            </div>
                        </a>



                        <!-- Article 2 -->
                        <a href="#" class="related-news-modern-item d-flex align-items-center">
                            <div class="thumb">
                                <img src="https://picsum.photos/seed/rel2/80/60" alt="Modernisation infrastructures">
                            </div>
                            <div class="text ms-3">
                                <small class="title">Modernisation des infrastructures agricoles</small>
                                <small class="date text-muted">15 Novembre 2025</small>
                            </div>
                        </a>
                    </div>
                </div>



                <!-- Recent news -->
                <div class="sidebar-card">
                    <h5>Actualités récentes</h5>


                    <div class="recent-news">

                        <!-- Empty State for Recent News -->
                        <div class="recent-news empty-state text-center p-4" id="emptyRecentNews" style="display:none;">
                            <img src="https://picsum.photos/seed/empty/100/100" alt="No news" class="mb-3">
                            <h6>Aucune actualité récente disponible</h6>
                            <p>Les dernières actualités seront affichées ici dès leur publication.</p>
                        </div>


                        <!-- <div class="recent-news-item d-flex align-items-center" style="cursor:pointer;">
                            <img src="https://picsum.photos/seed/anurb2/60/40" alt="">
                            <div class="ms-2">
                                <small>Le DG du BNEDER participe à Agri Invest Algeria 2025</small><br>
                                <small class="text-muted">2025-12-09</small>
                            </div>
                        </div>
                        <div class="recent-news-item d-flex align-items-center" style="cursor:pointer;">
                            <img src="https://picsum.photos/seed/anurb3/60/40" alt="">
                            <div class="ms-2">
                                <small>Une réception en l'honneur de M. MOKHTARI Said à l'occasion de son départ à la retraite</small><br>
                                <small class="text-muted">2025-12-04</small>
                            </div>
                        </div>
                        <div class="recent-news-item d-flex align-items-center" style="cursor:pointer;">
                            <img src="https://picsum.photos/seed/anurb4/60/40" alt="">
                            <div class="ms-2">
                                <small>Programme d'échange d'expertises dans le secteur agricole Algéro-Omanais</small><br>
                                <small class="text-muted">2025-11-30</small>
                            </div>
                        </div>
                        <div class="recent-news-item d-flex align-items-center" style="cursor:pointer;">
                            <img src="https://picsum.photos/seed/anurb5/60/40" alt="">
                            <div class="ms-2">
                                <small>Béjaïa : Vers le classement du massif forestier d'Akfadou en aire protégée</small><br>
                                <small class="text-muted">2025-11-23</small>
                            </div>
                        </div>
                        <div class="recent-news-item d-flex align-items-center" style="cursor:pointer;">
                            <img src="https://picsum.photos/seed/anurb6/60/40" alt="">
                            <div class="ms-2">
                                <small>Validation de l'étude de classement du massif forestier de l'Akfadou</small><br>
                                <small class="text-muted">2025-11-23</small>
                            </div>
                        </div> -->
                    </div>
                    <button class="btn btn-primary btn-view-more w-100 mt-3">Voir plus d'actualités</button>
                </div>

                <!-- Calendar -->
                <div class="sidebar-card">
                    <h5>Calendrier</h5>

                    <div class="modern-calendar">
                        <div class="calendar-header">
                            <button id="prevMonth">&lt;</button>
                            <span id="monthYear"></span>
                            <button id="nextMonth">&gt;</button>
                        </div>

                        <div class="calendar-weekdays">
                            <span>Lu</span><span>Ma</span><span>Me</span><span>Je</span>
                            <span>Ve</span><span>Sa</span><span>Di</span>
                        </div>

                        <div class="calendar-days" id="calendarDays"></div>
                    </div>

                    <div id="calendar-news" class="mt-3">
                        <p><em>Sélectionnez un jour pour afficher les actualités.</em></p>
                    </div>

                    <!-- Empty State for Calendar Day -->
                    <div id="calendar-news-empty" class="empty-state text-center p-3" style="display:none;">
                        <p><em>Aucune actualité pour ce jour.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Actualités Page End -->


<script>
    /*******************************************************************************************/

    const filterButtons = document.querySelectorAll(".filter-btn");
    const newsItems = document.querySelectorAll(".recent-news-item");

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            // toggle active class
            filterButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const tag = btn.getAttribute("data-tag");

            newsItems.forEach(item => {
                const tags = item.getAttribute("data-tags").split(",");
                if (tags.includes(tag)) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        });
    });
</script>



<?php include 'includes/footer.php'; ?>


<script>
    $(document).ready(function() {
        $.ajax({
            url: 'assets/php/get_featured_news.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.news) {
                    const news = response.news;
                    const html = `
                    <div class="featured-news mb-4">
                        <img src="admin/assets/uploads/news/${news.main_image}" alt="${news.title}" class="w-100">
                        <div class="featured-overlay">
                            <span class="badge-featured">À la une</span>
                            <h3>${news.title}</h3>
                            <p>${news.description}</p>
                            <a href="actualites.php?slug=${news.slug}" class="btn btn-light btn-sm">Lire l’article</a>
                        </div>
                    </div>
                `;
                    $('.featured-news').replaceWith(html);
                } else {
                    console.log('No featured news found');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        /************************************* get categories**************************************** */

        const $categoriesContainer = $(".tags-filters");

        // Load categories from the server
        $.ajax({
            url: 'assets/php/get_categories.php', // PHP file that returns JSON
            type: 'GET',
            dataType: 'json',
            success: function(categories) {
                // Clear container
                $categoriesContainer.empty();

                // Optional: Add "All" button
                $categoriesContainer.append(
                    `<button class="btn btn-outline-secondary btn-sm filter-btn active" data-category="all">Toutes</button>`
                );

                // Add buttons for each category
                categories.forEach(cat => {
                    $categoriesContainer.append(
                        `<button class="btn btn-outline-secondary btn-sm filter-btn" data-category="${cat.id_category}">${cat.category_name}</button>`
                    );
                });
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement des catégories:", error);
            }
        });


        /****************************************************** get clicked news ************************************ */

        const slug = $('#newsSlug').val();



        $.ajax({
            url: 'assets/php/get_news_single.php',
            type: 'GET',
            data: {
                slug: slug
            },
            dataType: 'json',
            success: function(news) {
                if (!news) return;

                // Set title
                $('.news-main h2').text(news.title);

                // Set author and date
                $('.news-meta').html(`
                    <span>Posté par</span>
                    <a href="#">${news.author_name}</a>
                    <span>le ${news.published_at}</span>
                    <span>|</span>
                    <span>Catégorie:</span>
                    <a href="#">${news.category_name}</a>
                    <span>|</span>
                    <span class="news-views">
                       ${news.views + 1} vues
                    </span>
                `);

                // Set content
                $('.news-content').html(news.description);

                // Set carousel images
                const carouselInner = $('#newsImagesCarousel .carousel-inner');
                carouselInner.empty();
                news.images.forEach((img, index) => {
                    carouselInner.append(`
                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img src="admin/assets/uploads/news/${img}" class="d-block w-100" alt="News image ${index + 1}">
                    </div>
                `);
                });

                // Set carousel indicators
                const indicators = $('#newsImagesCarousel .carousel-indicators');
                indicators.empty();
                news.images.forEach((_, index) => {
                    indicators.append(`
                    <button type="button" data-bs-target="#newsImagesCarousel" data-bs-slide-to="${index}" class="${index === 0 ? 'active' : ''}" aria-label="Slide ${index + 1}"></button>
                `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement de l'article:", error);
            }
        });

        /************************************************* actualités lieés******************************************************************** */



        if (!slug) return;

        $.ajax({
            url: 'assets/php/get_related_news.php',
            type: 'GET',
            data: {
                slug: slug
            },
            dataType: 'json',
            success: function(relatedNews) {
                const container = $('.related-news-modern');
                const emptyState = $('#emptyRelatedNews');

                container.find('.related-news-modern-item').remove(); // remove existing placeholder items

                if (!relatedNews || relatedNews.length === 0) {
                    emptyState.show();
                    return;
                } else {
                    emptyState.hide();
                }

                relatedNews.forEach(news => {
                    container.append(`
                    <a href="actualites.php?news=${news.slug}" class="related-news-modern-item d-flex align-items-center">
                        <div class="thumb">
                            <img src="admin/assets/uploads/news/${news.main_image}" alt="${news.title}">
                        </div>
                        <div class="text ms-3">
                            <small class="title">${news.title}</small>
                            <small class="date text-muted">${news.published_at}</small>
                        </div>
                    </a>
                `);
                });
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement des articles liés:", error);
            }
        });




        /************************************************* actualités récentes*********************************************************************/
        const recentContainer = $('.recent-news');
        const emptyState = $('#emptyRecentNews');
        const viewMoreBtn = $('.btn-view-more');
        const newsPerPage = 3; // Number of news to show at a time

        // Load all recent news
        $.ajax({
            url: 'assets/php/get_recent_news.php',
            type: 'GET',
            dataType: 'json',
            success: function(recentNews) {
                if (!recentNews || recentNews.length === 0) {
                    emptyState.show();
                    viewMoreBtn.hide();
                    return;
                }

                emptyState.hide();

                // Track how many are currently visible
                let visibleCount = 0;

                // Function to render next batch
                function renderNextBatch() {
                    let nextBatch = recentNews.slice(visibleCount, visibleCount + newsPerPage);
                    nextBatch.forEach(news => {
                        recentContainer.append(`
                    <div class="recent-news-item d-flex align-items-center" 
                         style="cursor:pointer;" 
                         onclick="window.location='actualites.php?news=${news.slug}'">
                        <img src="admin/assets/uploads/news/${news.main_image}" alt="${news.title}">
                        <div class="ms-2">
                            <small>${news.title}</small><br>
                            <small class="text-muted">${news.published_at}</small>
                        </div>
                    </div>
                `);
                    });

                    visibleCount += nextBatch.length;

                    // Hide button if all news are displayed
                    if (visibleCount >= recentNews.length) {
                        viewMoreBtn.hide();
                    }
                }

                // Show first batch
                renderNextBatch();

                // Show more button click
                viewMoreBtn.off('click').on('click', function() {
                    renderNextBatch();
                });
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du chargement des actualités récentes:", error);
            }
        });


        /****************************************** search news *************************************** */

        $('#newsSearch').on('input', function() {
            const query = $(this).val().trim();
            console.log("Recherche de :", query);
            const resultsContainer = $('.search-results');

            if (query.length < 2) { // minimum 2 characters to search
                resultsContainer.empty();
                return;
            }

            $.ajax({
                url: 'assets/php/search_news.php',
                type: 'GET',
                data: {
                    q: query
                },
                dataType: 'json',
                success: function(newsList) {
                    resultsContainer.empty();

                    if (!newsList || newsList.length === 0) {
                        resultsContainer.append('<div class="p-2 text-muted">Aucune actualité trouvée.</div>');
                        return;
                    }

                    newsList.forEach(news => {
                        resultsContainer.append(`
                    <div class="search-item d-flex align-items-center p-2" style="cursor:pointer;" onclick="window.location='actualites.php?news=${news.slug}'">
                        <img src="admin/assets/uploads/news/${news.main_image}" alt="${news.title}" style="width:50px; height:40px; object-fit:cover; margin-right:8px;">
                        <div>
                            <small>${news.title}</small><br>
                            <small class="text-muted">${news.published_at}</small>
                        </div>
                    </div>
                `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Erreur lors de la recherche :", error);
                }
            });
        });
    });

    /***************************calendar news ************************************************************************ */
    let currentDate = new Date();
    let selectedDate = null;

    const monthNames = [
        "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
        "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
    ];

    const monthYear = document.getElementById("monthYear");
    const calendarDays = document.getElementById("calendarDays");
    const calendarNews = document.getElementById("calendar-news");

    let newsDates = [];

    /* ===============================
       LOAD NEWS DATES (INDICATORS)
    ================================ */
    $.getJSON('assets/php/get_news_dates.php', function(dates) {
        newsDates = dates || [];
        renderCalendar(currentDate);
    });

    /* ===============================
       RENDER CALENDAR
    ================================ */
    function renderCalendar(date) {
        calendarDays.innerHTML = "";
        monthYear.textContent = `${monthNames[date.getMonth()]} ${date.getFullYear()}`;

        const firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay() || 7;
        const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

        // Empty slots before first day
        for (let i = 1; i < firstDay; i++) {
            const empty = document.createElement("span");
            empty.classList.add("disabled");
            calendarDays.appendChild(empty);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayEl = document.createElement("span");
            dayEl.textContent = day;

            const dayStr = `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;



            console.log("Checking date:", dayStr);
            console.log("News dates:", newsDates);
            /* Indicator if news exists */
            if (newsDates.includes(dayStr)) {

                const indicator = document.createElement("span");
                indicator.classList.add("calendar-indicator");
                dayEl.appendChild(indicator);
            }

            /* Highlight today */
            const today = new Date();
            if (
                day === today.getDate() &&
                date.getMonth() === today.getMonth() &&
                date.getFullYear() === today.getFullYear()
            ) {
                dayEl.classList.add("today");
            }

            /* Click event */
            dayEl.addEventListener("click", () => {
                document.querySelectorAll(".calendar-days span")
                    .forEach(d => d.classList.remove("selected"));

                dayEl.classList.add("selected");
                selectedDate = dayStr;
                fetchNewsByDate(selectedDate);
            });

            calendarDays.appendChild(dayEl);
        }
    }

    /* ===============================
       FETCH NEWS BY DATE
    ================================ */
    function fetchNewsByDate(date) {
        $.ajax({
            url: 'assets/php/get_news_by_date.php',
            type: 'GET',
            data: {
                date: date
            },
            dataType: 'json',
            success: function(newsList) {
                calendarNews.innerHTML = "";

                if (!newsList || newsList.length === 0) {
                    calendarNews.innerHTML = `<p><em>Aucune actualité pour ce jour.</em></p>`;
                    return;
                }

                calendarNews.innerHTML = `<strong class="d-block mb-2">Actualités du ${date}</strong>`;

                newsList.forEach(news => {
                    calendarNews.innerHTML += `
                    <div class="recent-news-item d-flex align-items-center mb-2"
                         style="cursor:pointer;"
                         onclick="window.location='actualites.php?news=${news.slug}'">

                        <img src="admin/assets/uploads/news/${news.main_image}"
                             alt="${news.title}"
                             width="50"
                             height="40"
                             style="object-fit:cover;margin-right:10px;">

                        <div>
                            <small>${news.title}</small><br>
                            <small class="text-muted">${news.pub_date}</small>
                        </div>
                    </div>
                `;
                });
            },
            error: function(err) {
                console.error("Erreur chargement actualités :", err);
            }
        });
    }

    /* ===============================
       NAVIGATION
    ================================ */
    document.getElementById("prevMonth").onclick = () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    };

    document.getElementById("nextMonth").onclick = () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    };
</script>