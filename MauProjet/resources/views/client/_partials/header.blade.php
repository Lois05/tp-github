<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'LocaPlus')</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />


  <style>
    /* Reset & global */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f7f1; /* beige très clair */
      color: #444;
      margin: 0;
      padding: 0;
      line-height: 1.6;
    }
    a {
      text-decoration: none;
      color: inherit;
    }

    /* Navbar */
    /* Hero Section - Version moderne et attractive */
.hero {
  position: relative;
  height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  background: linear-gradient(
      to right,
      rgba(52, 152, 219, 0.85),
      rgba(155, 89, 182, 0.85)
    ),
    url('{{ asset("images/hero-bg.jpg") }}') center/cover no-repeat;
  color: #fff;
  overflow: hidden;
  padding: 0 1rem;
}

.hero::after {
  content: "";
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 100%;
  height: 80px;
  background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 320' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,224L48,192C96,160,192,96,288,74.7C384,53,480,75,576,90.7C672,107,768,117,864,122.7C960,128,1056,128,1152,122.7C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat bottom center;
  background-size: cover;
}

.hero h1 {
  font-size: 3.5rem;
  font-weight: 800;
  max-width: 800px;
  margin: 0 auto 1rem;
  text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  animation: fadeInUp 1s ease-out forwards;
}

.hero p {
  font-size: 1.3rem;
  font-weight: 500;
  max-width: 600px;
  margin: 0 auto 2rem;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  animation: fadeInUp 1.3s ease-out forwards;
}

.hero .btn-primary {
  background-color: #ffffff;
  color: #9b59b6;
  border-radius: 50px;
  padding: 0.75rem 2.5rem;
  font-weight: 700;
  font-size: 1.1rem;
  border: none;
  transition: all 0.3s ease;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  animation: fadeInUp 1.6s ease-out forwards;
}

.hero .btn-primary:hover {
  background-color: #f1f1f1;
  color: #8e44ad;
}

/* Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

     /* Services */
     /* Services stylisés avec icônes Bootstrap */
.services-row {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  justify-content: center;
  padding: 2rem 0;
}

.service-card {
  flex: 1 1 300px;
  background: #fff;
  border-radius: 16px;
  padding: 2rem 1.5rem;
  box-shadow: 0 6px 20px rgba(243, 156, 18, 0.15);
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 28px rgba(243, 156, 18, 0.3);
}

.service-card .icon {
  font-size: 3rem;
  color: #e67e22;
  margin-bottom: 1rem;
}

.service-card h5 {
  font-size: 1.35rem;
  font-weight: 700;
  color: #e67e22;
  margin-bottom: 0.8rem;
}

.service-card p {
  color: #555;
  font-size: 1rem;
  font-weight: 500;
  line-height: 1.6;
}

.annonces-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}

.annonce-card {
  position: relative;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
  display: flex;
  flex-direction: column;
}

.annonce-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 14px 38px rgba(0, 0, 0, 0.2);
}

/* Coeur favori */
.annonce-card .favorite-icon {
  position: absolute;
  top: 12px;
  right: 12px;
  background: rgba(255, 255, 255, 0.85);
  border-radius: 50%;
  padding: 8px;
  z-index: 10;
  font-size: 1.2rem;
  color: #e74c3c;
  transition: transform 0.3s ease;
}

.annonce-card .favorite-icon:hover {
  transform: scale(1.2);
}

.annonce-img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}

.annonce-body {
  padding: 1.4rem 1.5rem 1.8rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.annonce-title {
  font-weight: 700;
  font-size: 1.25rem;
  color: #2c3e50;
  margin: 0;
}

.price {
  font-size: 1.2rem;
  font-weight: 700;
  color: #d35400;
}

.stars {
  color: #f1c40f;
  font-size: 1.1rem;
  display: flex;
  gap: 3px;
}

.btn-louer {
  background-color: #2c3e50;
  color: white;
  border: none;
  border-radius: 30px;
  padding: 0.6rem 1.6rem;
  font-weight: 600;
  align-self: flex-start;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.btn-louer:hover {
  background-color: #1a252f;
}



.about-section {
  background: #fef9f4;
  color: #2c3e50;
}

.about-section .section-title {
  font-weight: 700;
  font-size: 2.5rem;
  color: #d35400;
  letter-spacing: 1px;
}

.about-section p.lead {
  font-size: 1.25rem;
  font-weight: 600;
  color: #34495e;
}

.about-section p {
  font-size: 1rem;
  line-height: 1.6;
  color: #555;
}

.about-section img {
  max-width: 100%;
  border-radius: 16px;
  box-shadow: 0 8px 24px rgb(211 84 0 / 0.3);
  transition: transform 0.3s ease;
}

.about-section img:hover {
  transform: scale(1.05);
}

.btn-primary {
  background-color: #d35400;
  border: none;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #e67e22;
}




/* Bootstrap est déjà chargé, ajoute juste ces petits ajustements */

.form-label {
  font-weight: 600;
  color: #d35400;
}

.btn-primary {
  background-color: #d35400;
  border: none;
  border-radius: 30px;
  font-weight: 700;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #e67e22;
}





    /* Footer */
    footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 1.8rem 1rem;
      font-weight: 500;
      font-size: 0.95rem;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.2rem;
      }
      .hero p {
        font-size: 1.1rem;
      }
      nav .nav-link {
        font-size: 0.95rem;
      }
    }
  </style>
</head>

