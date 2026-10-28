<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About us — UKM Genshin</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <link rel="stylesheet" href="{{ asset('css/profile-ukm.css') }}">
</head>
<body>

  <x-navbar></x-navbar>

  <main>
    <!-- Jumbotron -->
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="display-4">Welcom to our beloved UKM</h1>
        <p class="lead fw-medium mb-0">we are delighted to meet you</p>
      </div>
    </section>

    <!-- Profile About -->
    <section id="profile-about">
      <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center gap-4 gap-lg-5">
          <div class="profile-card">
            <img src="{{ asset('image/paimon-bingung.svg') }}" alt="Paimon confused" loading="lazy">
          </div>

          <div class="profile-content">
            <h2 class="nama">What is UKM Genshin?</h2>
            <div class="info">
              <p>
                UKM or Unit Kegiatan Mahasiswa, is a student activity unit established specifically for students of Akademiya Institute. Designed as a creative hub, this UKM brings together students who share a passion for gaming and the arts, offering a space where creativity, collaboration, and self-expression can thrive.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Jumbotron team -->
    <section class="jumbotron-team text-center">
      <div class="container">
        <h1 class="display-4">Meet our team!</h1>
        <p class="lead fw-medium mb-0">get to know us!</p>
      </div>
    </section>

    <!-- Profile -->
    <section id="profile">
      
      <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center gap-4 gap-lg-5">
          <div class="profile-card">
            <img src="{{ asset('image/Rafifah.png') }}" alt="Rafifah photo" loading="lazy">
          </div>

          <div class="profile-content">
            <h2 class="nama">Rafifah Rahmah Admayana</h2>
            <div class="info">
              <h4 class="poppins-regular">Engineer 1</h4>
              <p>
                She handle our Announcements, portfolio gallery, and event registration information!
              </p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center gap-4 gap-lg-5">
          <div class="profile-card">
            <img src="{{ asset('image/Naila.png') }}" alt="Rafifah photo" loading="lazy">
          </div>

          <div class="profile-content">
            <h2 class="nama">Naila Hikaru</h2>
            <div class="info">
              <h4 class="poppins-regular">Engineer 2</h4>
              <p>
                She handle our Login, Register, Logout, UKM profile, and Member profiles!
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center gap-4 gap-lg-5">
          <div class="profile-card">
            <img src="{{ asset('image/Hasna.png') }}" alt="Rafifah photo" loading="lazy">
          </div>

          <div class="profile-content">
            <h2 class="nama">Hasna Nabila Hanim</h2>
            <div class="info">
              <h4 class="poppins-regular">Engineer 3</h4>
              <p>
                She handle our Schedule, Cash Flow, and Activity attendance!
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <x-footer></x-footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>