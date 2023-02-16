<div>
    @include('livewire.person-modal')

    <button data-bs-toggle="modal" data-bs-target="#addPerson"
        class="btn icon icon-left btn-primary rounded-pill">Tambah Data</button>

    <div class="row">
        <div class="col-lg-5 form-group">
            <label for=""> </label>
            <input wire:model="search" type="text" class="form-control"
                placeholder="Cari nama seseorang ..">
        </div>
        <div class="col-lg-2 form-group">
            <label for="">Usia Minimal</label>
            <input wire:model="age" type="number" class="form-control" min="0">
        </div>
        <div class="col-lg-3 form-group">
            <label for="orderBy">Urutkan Berdasarkan</label>
            <select wire:model="orderBy" class="form-select" id="orderBy">
                <option value="created_at">Data ditambahkan</option>
                <option value="name">Nama</option>
                <option value="job">Pekerjaan</option>
                <option value="dob">Tanggal lahir</option>
            </select>
        </div>
        <div class="col-lg-2 form-group">
            <label for="asc"></label>
            <select wire:model="asc" class="form-select" id="asc">
                <option value="desc" selected>Descending</option>
                <option value="asc">Ascending</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Pekerjaan</th>
                    <th>Tanggal Lahir</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($people) > 0)
                @foreach ($people as $person)
                <tr>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->job }}</td>
                    <td>{{ date('d/m/Y', strtotime($person->dob)) }}</td>
                    <td>
                        <button wire:click="showPerson('{{ $person->id }}')" type="button" class="btn btn-info text-dark block" data-toggle="modal" data-target="#showPerson"><i class="fa fa-info"></i>
                        </button>
                        <button wire:click="editPerson('{{ $person->id }}')" type="button" class="btn btn-warning text-dark block" data-toggle="modal" data-target="#updatePerson"><i class="fa fa-edit"></i>
                        </button>
                        <button wire:click="deletePerson('{{ $person->id }}')" type="button" class="btn btn-danger text-dark block"><i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @else
                <th colspan="4" class="text-center">Tidak ada data</th>
                @endif
            </tbody>
        </table>
    </div>

    {!! $people->links() !!}
</div>
