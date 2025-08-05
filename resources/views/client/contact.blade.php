@extends('layouts.client')

@section('title', 'Contactez-nous')

@section('content')

<!-- Hero Section -->
    <header class="hero text-white d-flex align-items-center"
        style="background: url('{{ asset('assets/images/about.jpg') }}') center/cover no-repeat; height: 400px;">
        <div class="container text-center">
            <h1>Contactez-nous facilement</h1>
            <p>Nous sommes là pour vous accompagner et répondre à toutes vos questions. Discutons de votre besoin !</p>
            <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
        </div>
    </header>


<section class="py-5">
  <div class="container" style="max-width: 600px;">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.contact.send') }}" method="POST" novalidate>
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Nom complet</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
        @error('message')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2">Envoyer</button>
    </form>
  </div>
</section>
@endsection
