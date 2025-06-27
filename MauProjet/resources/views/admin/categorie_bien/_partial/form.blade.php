@csrf

<div class="form-group mb-3">
    <label for="nom">Nom</label>
    <input
        type="text"
        name="nom"
        id="nom"
        class="form-control @error('nom') is-invalid @enderror"
        value="{{ old('nom', $categorie->nom ?? '') }}"
        required
    >
    @error('nom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="description">Description</label>
    <textarea
        name="description"
        id="description"
        class="form-control @error('description') is-invalid @enderror"
        rows="4"
        required
    >{{ old('description', $categorie->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
