<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'LocaPlus')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
    --primary: #2C3E50;
    --secondary: #ECF0F1;
    --accent: #F39C12;
    --accent-dark: #c87e0a;
    --text-muted: #6c757d;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--secondary);
    color: var(--primary);
    margin: 0;
    padding: 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s ease;
}

a:hover,
a:focus {
    color: var(--accent);
    outline: none;
}

/* HERO SECTION */
.hero {
    position: relative;
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background: var(--primary) url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat;
    color: var(--secondary);
    text-align: center;
    padding: 0 1rem;
    user-select: none;
}

.hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 6px rgba(0,0,0,0.5);
}

.hero p {
    font-size: 1.25rem;
    max-width: 600px;
    margin-bottom: 2rem;
    text-shadow: 0 1px 3px rgba(0,0,0,0.4);
}

.hero .btn-primary {
    background-color: var(--accent);
    border: none;
    color: var(--secondary);
    border-radius: 50px;
    padding: 0.85rem 2.5rem;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 6px 15px rgba(243, 156, 18, 0.4);
    transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
}

.hero .btn-primary:hover,
.hero .btn-primary:focus {
    background-color: var(--accent-dark);
    box-shadow: 0 8px 25px rgba(200, 126, 10, 0.7);
    transform: scale(1.05);
    outline: none;
}

/* SERVICES */
.services-row {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
    padding: 3rem 1rem;
}

.service-card {
    flex: 1 1 280px;
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 6px 20px rgba(44, 62, 80, 0.1);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.service-card:hover,
.service-card:focus-within {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(44, 62, 80, 0.2);
}

.service-card .icon {
    font-size: 2.75rem;
    color: var(--accent);
    margin-bottom: 1rem;
}

.service-card h5 {
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--primary);
}

.service-card p {
    font-size: 1rem;
    color: var(--text-muted);
}

/* ANNONCES MODERNES */
.annonces-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    padding: 3rem 1rem;
}

.annonce-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
    cursor: pointer;
}

.annonce-card:hover,
.annonce-card:focus-within {
    transform: translateY(-6px);
    box-shadow: 0 18px 36px rgba(0, 0, 0, 0.12);
}

/* Cœur favori */
.favorite-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 1.6rem;
    color: #ddd;
    background: rgba(255, 255, 255, 0.85);
    padding: 6px;
    border-radius: 50%;
    transition: color 0.25s ease, transform 0.25s ease;
    user-select: none;
    z-index: 10;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.favorite-icon:hover,
.favorite-icon:focus {
    color: var(--accent);
    transform: scale(1.2);
    outline: none;
}

/* Active favorite (exemple d'état actif) */
.favorite-icon.active {
    color: var(--accent);
    text-shadow: 0 0 6px var(--accent);
}

/* Image */
.annonce-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.annonce-card:hover .annonce-img,
.annonce-card:focus-within .annonce-img {
    transform: scale(1.05);
}

/* Corps */
.annonce-body {
    padding: 1.5rem 1.75rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.annonce-title {
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 0.75rem;
    color: var(--primary);
    line-height: 1.2;
}

.price {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 1rem;
}

.stars {
    color: #f1c40f;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.btn-louer {
    background-color: var(--primary);
    color: #fff;
    border: none;
    border-radius: 30px;
    padding: 0.6rem 1.5rem;
    font-weight: 600;
    text-decoration: none;
    align-self: flex-start;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.3);
}

.btn-louer:hover,
.btn-louer:focus {
    background-color: #1a252f;
    transform: scale(1.05);
    outline: none;
}

/* FOOTER */
footer {
    background-color: var(--primary);
    color: var(--secondary);
    text-align: center;
    padding: 2rem 1rem;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.2rem;
    }

    .hero p {
        font-size: 1rem;
    }

    .annonce-body {
        padding: 1rem 1.25rem;
    }
}

    </style>
</head>
