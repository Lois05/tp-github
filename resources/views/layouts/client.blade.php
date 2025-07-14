<!DOCTYPE html>
<html lang="fr">
@include('client._partials.header') {{-- Head + début de <body> --}}

@include('client._partials.navbar')

<main>
    @yield('content') {{-- contenu propre à chaque page --}}
</main>

@include('client._partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
