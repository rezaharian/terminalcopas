<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '' }}</label>
    <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>

<div class="mb-3">
    <label class="form-label">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role" class="form-select" required>
        <option value="">-- Pilih Role --</option>
        @foreach ($roles as $role)
            <option value="{{ $role->name }}"
                {{ old('role', isset($user) && $user->roles->first() ? $user->roles->first()->name : '') == $role->name ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
</div>
