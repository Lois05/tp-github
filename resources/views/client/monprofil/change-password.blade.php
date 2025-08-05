@extends('layouts.client')

@section('title', 'Changer le mot de passe')

@section('content')
<div class="container py-5">
    <h1>Changer le mot de passe</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="current_password" class="form-label">Mot de passe actuel</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            @error('current_password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
    </form>
</div>
@endsection
