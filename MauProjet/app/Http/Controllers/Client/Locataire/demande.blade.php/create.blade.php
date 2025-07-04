@extends('layouts.client')

@section('title', 'Demande de location')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <h2 class="mb-4">Demande de location pour : <strong>{{ $annonce->titre }}</strong></h2>

    @if ($errors->any())
      <div class="alert alert-danger mb-4">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <form action="{{ route('locataire.demande.store') }}" method="POST" novalidate>
        @csrf
        <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">

        <div class="mb-3">
            <label for="nom" class="form-label">Votre nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Votre email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message (optionnel)</label>
            <textarea name="message" id="message" rows="4" class="form-control">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer la demande</button>
    </form>
</div>
@endsection
