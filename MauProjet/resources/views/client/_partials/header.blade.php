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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    :root {
      --primary: #2C3E50;
      --secondary: #ECF0F1;
      --accent: #F39C12;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--secondary);
      color: var(--primary);
      margin: 0;
      padding: 0;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* HERO SECTION */
    .hero {
      position: relative;
      height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      background: var(--primary) url('{{ asset("images/hero-bg.jpg") }}') center/cover no-repeat;
      color: var(--secondary);
      text-align: center;
      padding: 0 1rem;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 600px;
      margin-bottom: 2rem;
    }

    .hero .btn-primary {
      background-color: var(--accent);
      border: none;
      color: var(--secondary);
      border-radius: 50px;
      padding: 0.75rem 2rem;
      font-weight: 600;
      font-size: 1rem;
    }

    .hero .btn-primary:hover {
      background-color: darken(var(--accent), 10%);
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
      transition: all 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(44, 62, 80, 0.15);
    }

    .service-card .icon {
      font-size: 2.5rem;
      color: var(--accent);
      margin-bottom: 1rem;
    }

    .service-card h5 {
      font-weight: 600;
      margin-bottom: 0.8rem;
    }

    .service-card p {
      font-size: 0.95rem;
      color: #555;
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
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.annonce-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
}

.annonce-img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

.annonce-body {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.annonce-title {
  font-weight: 700;
  font-size: 1.3rem;
  margin-bottom: 0.5rem;
  color: var(--primary);
}

.price {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--accent);
  margin-bottom: 0.5rem;
}

.stars {
  color: #f1c40f;
  font-size: 1rem;
  margin-bottom: 0.5rem;
}

.btn-louer {
  background-color: var(--primary);
  color: #fff;
  border: none;
  border-radius: 30px;
  padding: 0.6rem 1.4rem;
  font-weight: 600;
  text-decoration: none;
  align-self: flex-start;
  transition: background-color 0.3s ease;
}

.btn-louer:hover {
  background-color: #1a252f;
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
      .hero h1 { font-size: 2.2rem; }
      .hero p { font-size: 1rem; }
    }
  </style>
</head>
