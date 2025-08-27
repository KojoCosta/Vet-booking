{{-- Pet Name --}}
<div class="mb-3">
  <label for="name" class="form-label">Pet Name</label>
  <input type="text" name="name" id="name" class="form-control"
         value="{{ old('name', $pet->name ?? '') }}" required>
  @error('name')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

{{-- Species --}}
<div class="mb-3">
  <label for="species" class="form-label">Species</label>
  <input type="text" name="species" id="species" class="form-control"
         value="{{ old('species', $pet->species ?? '') }}" required>
  @error('species')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

{{-- Breed --}}
<div class="mb-3">
  <label for="breed" class="form-label">Breed</label>
  <input type="text" name="breed" id="breed" class="form-control"
         value="{{ old('breed', $pet->breed ?? '') }}">
  @error('breed')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

{{-- Birthdate --}}
<div class="mb-3">
  <label for="birthdate" class="form-label">Birthdate</label>
  <input type="date" name="birthdate" id="birthdate" class="form-control"
         value="{{ old('birthdate', $pet->birthdate ?? '') }}">
  @error('birthdate')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

{{-- Sex --}}
<div class="mb-3">
  <label for="sex" class="form-label">Sex</label>
  <select name="sex" id="sex" class="form-select" required>
    <option value="">Choose...</option>
    <option value="male" {{ old('sex', $pet->sex ?? '') === 'male' ? 'selected' : '' }}>Male</option>
    <option value="female" {{ old('sex', $pet->sex ?? '') === 'female' ? 'selected' : '' }}>Female</option>
  </select>
  @error('sex')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>