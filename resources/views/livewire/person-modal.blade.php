{{-- SHOW PERSON MODAL --}}
<div wire:ignore.self class="modal fade" id="showPerson" tabindex="-1" aria-labelledby="showPersonLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showPersonLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <td>{{ $showPerson->name }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan</th>
                        <th>:</th>
                        <td>{{ $showPerson->job }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <th>:</th>
                        <td>{{ date('d/m/Y', strtotime($showPerson->dob)) }}</td>
                    </tr>
                </table>
                <p class="fw-bold">Keterangan</p>
                <ul>
                    <li>{{ $dayStatus }}</li>
                    <li>{{ $weekStatus }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- ADD PERSON MODAL --}}
<div wire:ignore.self class="modal fade" id="addPerson" tabindex="-1" aria-labelledby="addPersonLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPersonLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="addPerson">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" placeholder="masukan nama"/>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="job" class="form-label">Pekerjaan</label>
                    <input wire:model="job" type="text" class="form-control @error('job') is-invalid @enderror"
                    id="job" placeholder="masukan pekerjaan"/>
                    @error('job')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Tanggal Lahir</label>
                    <input wire:model="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                    id="dob"/>
                    @error('dob')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>



{{-- EDIT PERSON MODAL --}}
<div wire:ignore.self class="modal fade" id="updatePerson" tabindex="-1" aria-labelledby="updatePersonLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updatePersonLabel">Edit Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updatePerson">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" placeholder="masukan nama"/>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="job" class="form-label">Pekerjaan</label>
                    <input wire:model="job" type="text" class="form-control @error('job') is-invalid @enderror"
                    id="job" placeholder="masukan pekerjaan"/>
                    @error('job')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Tanggal Lahir</label>
                    <input wire:model="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                    id="dob"/>
                    @error('dob')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>