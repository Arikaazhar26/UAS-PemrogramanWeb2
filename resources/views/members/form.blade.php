<div class="mb-3">
    <label class="form-label">Kode Anggota</label>
    <input type="text"
           name="member_code"
           class="form-control"
           value="{{ old('member_code', $member->member_code ?? '') }}"
           required>
</div>

<div class="mb-3">
    <label class="form-label">Nama Anggota</label>
    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $member->name ?? '') }}"
           required>
</div>

<div class="mb-3">
    <label class="form-label">Jenis Kelamin</label>

    <select name="gender" class="form-control" required>

        <option value="">-- Pilih --</option>

        <option value="Laki-laki"
        {{ old('gender', $member->gender ?? '') == 'Laki-laki' ? 'selected' : '' }}>
            Laki-laki
        </option>

        <option value="Perempuan"
        {{ old('gender', $member->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>
            Perempuan
        </option>

    </select>
</div>

<div class="mb-3">
    <label class="form-label">Nomor HP</label>

    <input type="text"
           name="phone"
           class="form-control"
           value="{{ old('phone', $member->phone ?? '') }}"
           required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>

    <input type="email"
           name="email"
           class="form-control"
           value="{{ old('email', $member->email ?? '') }}"
           required>
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>

    <textarea name="address"
              class="form-control"
              rows="3"
              required>{{ old('address', $member->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Foto</label>

    <input type="file"
           name="photo"
           class="form-control">

    @if(isset($member) && $member->photo)
        <div class="mt-2">
            <img src="{{ asset('storage/'.$member->photo) }}"
                 width="120"
                 class="img-thumbnail">
        </div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Status</label>

    <select name="status" class="form-control">

        <option value="Aktif"
        {{ old('status', $member->status ?? '') == 'Aktif' ? 'selected' : '' }}>
            Aktif
        </option>

        <option value="Nonaktif"
        {{ old('status', $member->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>
            Nonaktif
        </option>

    </select>
</div>