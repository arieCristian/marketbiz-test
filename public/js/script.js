window.addEventListener('close-edit-modal', event => {
    $('#updatePerson').modal('hide');
})

window.addEventListener('close-modal', event => {
    $('#addPerson').modal('hide');
})
window.addEventListener('open-edit-modal', event => {
    $('#updatePerson').modal('show');
})

window.addEventListener('open-show-modal', event => {
    $('#showPerson').modal('show');
})

window.addEventListener('success-add', event => {
    Swal.fire({
        icon: "success",
        title: "Berhasil Menambah Data Baru",
    })
})
window.addEventListener('success-updated', event => {
    Swal.fire({
        icon: "success",
        title: "Berhasil Memperbarui Data",
    })
})

window.addEventListener('deleted-confirm', event => {
    Swal.fire({
        title: 'Yakin ?',
        text: "Hapus " + event.detail.name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtontext: 'Batal',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit('destroyPerson')
        } else {
            Livewire.emit('cencelDelete')
        }
    })
})

window.addEventListener('deleted-success', event => {
    Swal.fire({
        icon: "success",
        title: "Berhasil Menghapus Data",
    })
})
