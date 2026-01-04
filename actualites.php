<?php include 'includes/header.php'; ?>

<style>
    .news-main {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .news-main:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.12);
    }
    
    /* carousel styles (added) */
    .news-carousel .carousel-inner {
        border-radius: 10px;
        overflow: hidden;
    }
    .news-carousel .carousel-item img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
    }
    .news-carousel .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(0,0,0,0.35);
    }
    .news-carousel .carousel-indicators .active {
        background-color: #b78d65;
        width: 28px;
        border-radius: 6px;
    }
    @media (max-width: 768px) {
        .news-carousel .carousel-item img { height: 300px; }
    }
    
    .news-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 0;
        border-bottom: 2px solid #f0f0f0;
        font-size: 14px;
        color: #666;
    }
    
    .news-meta a {
        color: #007bff;
        text-decoration: none;
        font-weight: 600;
    }
    
    .news-meta a:hover {
        text-decoration: underline;
    }
    
    .news-content p {
        font-size: 16px;
        line-height: 1.8;
        color: #444;
        margin-bottom: 18px;
        text-align: justify;
    }
    
    .share-section {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid #f0f0f0;
    }
    
    .share-section span {
        font-weight: 600;
        color: #1a1a1a;
        margin-right: 15px;
    }
    
    .share-icons i {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        background: #f8f9fa;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #b78d65;
        font-size: 18px;
    }
    
    .share-icons i:hover {
        background: #b78d65;
        color: white;
        transform: scale(1.1);
    }
    
    .sidebar {
        padding-left: 20px;
    }
    
    .sidebar-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    
    .sidebar-card h5 {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 18px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .search-box {
        position: relative;
        margin-bottom: 25px;
    }
    
    .search-box input {
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }
    
    .search-box input:focus {
        outline: none;
        border-color: #b78d65;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    
    .recent-news {
        max-height: 450px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    .recent-news::-webkit-scrollbar {
        width: 6px;
    }
    
    .recent-news::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .recent-news::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    
    .recent-news::-webkit-scrollbar-thumb:hover {
        background: #999;
    }
    
    .recent-news-item {
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        border-left: 3px solid transparent;
    }
    
    .recent-news-item:hover {
        background: #f8f9fa;
        border-left-color: #b78d65;
        transform: translateX(5px);
    }
    
    .recent-news-item img {
        width: 65px;
        height: 45px;
        object-fit: cover;
        border-radius: 6px;
    }
    
    .recent-news-item small {
        display: block;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 4px;
    }
    
    .recent-news-item .text-muted {
        font-size: 12px;
        color: #999 !important;
    }

    .btn-view-more:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    }
    
   .modern-calendar {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.calendar-header span {
    font-weight: 700;
    font-size: 16px;
    color: #1a1a1a;
}

.calendar-header button {
    background: #b78d65;
    border: none;
    color: #fff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.calendar-header button:hover {
    background: #9c744f;
}

.calendar-weekdays,
.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
}

.calendar-weekdays span {
    font-size: 13px;
    font-weight: 600;
    color: #666;
    padding: 6px 0;
}

.calendar-days span {
    padding: 8px 0;
    margin: 2px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.calendar-days span:hover {
    background: #b78d65;
    color: #fff;
}

.calendar-days .today {
    background: #1a1a1a;
    color: #fff;
    font-weight: 700;
}

.calendar-days .selected {
    background: #b78d65;
    color: #fff;
}

.calendar-days .disabled {
    color: #ccc;
    cursor: default;
}


    @media (max-width: 768px) {
        .sidebar {
            padding-left: 0;
            margin-top: 30px;
        }
        
        .news-main h2 {
            font-size: 22px;
        }
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
                    <input type="text" class="form-control" placeholder="Rechercher une actualité...">
                </div>

                <!-- Recent news -->
                <div class="sidebar-card">
                    <h5>Actualités récentes</h5>
                    <div class="recent-news">
                        <div class="recent-news-item d-flex align-items-center" style="cursor:pointer;">
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
                        </div>
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
</div>
            </div>
        </div>
    </div>
</div>
<!-- Actualités Page End -->


<script>
const monthNames = [
    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
];

let currentDate = new Date();
let selectedDate = null;

const monthYear = document.getElementById("monthYear");
const calendarDays = document.getElementById("calendarDays");
const calendarNews = document.getElementById("calendar-news");

function renderCalendar(date) {
    calendarDays.innerHTML = "";
    monthYear.textContent = `${monthNames[date.getMonth()]} ${date.getFullYear()}`;

    const firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay() || 7;
    const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

    for (let i = 1; i < firstDay; i++) {
        const empty = document.createElement("span");
        empty.classList.add("disabled");
        calendarDays.appendChild(empty);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dayEl = document.createElement("span");
        dayEl.textContent = day;

        const today = new Date();
        if (
            day === today.getDate() &&
            date.getMonth() === today.getMonth() &&
            date.getFullYear() === today.getFullYear()
        ) {
            dayEl.classList.add("today");
        }

        dayEl.addEventListener("click", () => {
            document.querySelectorAll(".calendar-days span").forEach(d => d.classList.remove("selected"));
            dayEl.classList.add("selected");

            selectedDate = `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
            showNewsForDate(selectedDate);
        });

        calendarDays.appendChild(dayEl);
    }
}

function showNewsForDate(date) {
    calendarNews.innerHTML = `
        <strong class="d-block mb-2">Actualités du ${date}</strong>

        <div class="recent-news-item d-flex align-items-center mb-2">
            <img src="https://picsum.photos/seed/cal1/60/40" alt="">
            <div class="ms-2">
                <small>Validation de l'étude de classement du massif forestier de l'Akfadou</small><br>
                <small class="text-muted">${date}</small>
            </div>
        </div>

        <div class="recent-news-item d-flex align-items-center mb-2">
            <img src="https://picsum.photos/seed/cal2/60/40" alt="">
            <div class="ms-2">
                <small>Programme d'échange d'expertises dans le secteur agricole</small><br>
                <small class="text-muted">${date}</small>
            </div>
        </div>
    `;
}


document.getElementById("prevMonth").onclick = () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
};

document.getElementById("nextMonth").onclick = () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
};

renderCalendar(currentDate);
</script>



<?php include 'includes/footer.php'; ?>
