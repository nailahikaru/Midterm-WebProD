<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About us — UKM Genshin</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="{{ asset('css/profile-ukm.css') }}">
</head>
<body>

  <!-- Navbar -->

  <x-navbar></x-navbar>
 
  <!-- Akhir Navbar -->

  <main>
    <!-- Jumbotron -->
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="display-4 fw-semibold">Meet our team!</h1>
        <p class="lead fw-medium mb-0">we are delighted to meet you</p>
      </div>
    </section>
    <!-- Akhir Jumbotron -->

    <!-- Profile -->
    <section id="profile">
      <div class="container">
        <div class="d-flex flex-row flex-lg-column align-items-center justify-content-center gap-4 gap-lg-5">

          <div class="profile-card">
            <img src="{{ asset('image/Paimon.png') }}" alt="Paimon photo" loading="paimon">
          </div>

          <h1 class="nama display-4">Hi Traveler!</h1>
          <div class="info">
            <h4 class="poppins-regular">Your journey awaits!</h4>
            <p>
              Teyvat's day and night both seem particularly short. The skies here are full of stars, but they aren't the same as the ones seen from my home‍. I wonder if the fates of people from Teyvat are also related to their constellations.
            </p>
          </div>

        </div>
      </div>
    </section>
    <!-- Akhir Profile -->
  </main>

  <!-- Footer -->
  <x-footer></x-footer>
  <!-- Akhir Footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>