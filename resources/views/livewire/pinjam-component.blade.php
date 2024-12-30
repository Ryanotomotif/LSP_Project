<div>
    <div class="card">
        <div class="card-header">
          Pinjam Buku
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- <input type="text" wire:model.live="cari" class="form-control w-50" placeholder="Cari..."> --}}
            <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Nama Member</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pinjam as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->buku->judul }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->tgl_pinjam }}</td>
                            <td>{{ $data->tgl_kembali }}</td>
                            <td>{{ $data->status }}</td>
                        </tr>  
                    @endforeach
                </tbody>
              </table>
              {{ $pinjam->links()}}
            </div>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPage">Tambah Peminjam</a>
        </div>
      </div>

      {{-- Tambah Peminjam --}}
      <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Isi Data Buku</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                    <label>Judul Buku</label>
                    <select wire:model="buku" class="form-control">
                        <option value="">--Pilih--</option>
                        @foreach ($book as $data)
                            <option value="{{$data->id}}">{{$data->judul}}</option>
                        @endforeach
                    </select>
                    @error('buku')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Member</label>
                    <select wire:model="user" class="form-control">
                        <option value="">--Pilih--</option>
                        @foreach ($member as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>
                        @endforeach
                    </select>
                    @error('user')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" wire:click="store" class="btn btn-primary" >Save</button>
            </div>
          </div>
        </div>
      </div>
</div>
