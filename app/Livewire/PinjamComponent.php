<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PinjamComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $id, $user, $buku, $tgl_pinjam, $tgl_kembali;
    public function render()
    {
        $data['member']=User::where('jenis', 'member')->get();
        $data['book']=Buku::all();
        $data['pinjam']=Pinjam::paginate(10);
        $layout['title'] = 'Pinjam Buku';
        return view('livewire.pinjam-component', $data)->layoutData($layout);
    }
    public function store()
    {
        $this->validate([
            'buku' => 'required',
            'user' => 'required'
        ],[
            'buku.required'=> 'Buku harus dipilih',
            'user.required'=> 'Peminjam harus dipilih'
        ]);
        $this->tgl_sekarang = date('Y-m-d');
        $this->kembali= date('Y-m-d', strtotime($this->tgl_sekarang. '+7 days'));
        Pinjam::create([
            'user_id'=>$this->user,
            'buku_id'=>$this->buku,
            'tgl_pinjam'=>$this->tgl_sekarang,
            'tgl_kembali'=>$this->kembali,
            'status' => 'pinjam'
        ]);
        $this->reset();
        session()->flash('success', 'Berhasil menambah peminjam');
       return redirect()->route('pinjam');
    }
}
