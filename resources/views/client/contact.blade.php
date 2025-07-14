@extends('layouts.client')

@section('title', 'Contactez-nous')

@section('content')
<section class="hero d-flex align-items-center justify-content-center text-center text-white" style="background: linear-gradient(135deg, rgba(211, 84, 0, 0.85), rgba(243, 156, 18, 0.8)), url('{{ asset('images/contact-bg.jpg') }}') center/cover no-repeat; height: 60vh; box-shadow: inset 0 0 60px rgba(0,0,0,0.4);">
  <div class="container">
    <h1 class="display-4 fw-bold">Contactez LocaPlus</h1>
    <p class="lead mt-3">Nous sommes à votre écoute pour toute question ou suggestion.</p>
  </div>
</section>

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
