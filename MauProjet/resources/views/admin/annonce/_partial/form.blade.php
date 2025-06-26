<div>
    <label for="title">Titre</label>
    <input type="text" id="title" name="title" value="{{ old('title', $annonce->title ?? '') }}" required>
</div>

<div>
    <label for="description">Description</label>
    <textarea id="description" name="description" required>{{ old('description', $annonce->description ?? '') }}</textarea>
</div>
