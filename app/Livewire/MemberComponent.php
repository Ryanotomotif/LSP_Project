<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $nama, $alamat, $telepon, $email, $password, $cari, $id;
    public function render()
    {
/*         if ($this->cari != ""){
            $data['member'] = User::Where('nama', 'like', '%' . $this->cari . '%')
                ->paginate(10);
        } else {
            $data['member'] = User::where('jenis', 'member')->paginate(10);
        } */
        $layout['title'] = "Member Dashboard";
        $data['member']=User::where('jenis', 'member')->paginate(10);
        return view('livewire.member-component', $data)->layoutData($layout);
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email'
        ],[
            'nama.required'=> 'Nama tidak Boleh Kosong',
            'alamat.required'=> 'Alamat tidak Boleh Kosong',
            'telepon.required'=> 'Nomor telepon tidak Boleh Kosong',
            'email.required'=> 'Email tidak Boleh Kosong',
            'email.email'=> 'Gunakan format email'
        ]);
        User::create([
            'nama'=>$this->nama,
            'alamat'=>$this->alamat,
            'telepon'=>$this->telepon,
            'email'=>$this->email,
            'jenis' => 'member'
        ]);
         session()->flash('success', 'Berhasil menambah member');
        return redirect()->route('member');
    }
    public function edit($id)
    {
        $member = User::find($id);
        $this->nama=$member->nama;
        $this->alamat=$member->alamat;
        $this->telepon=$member->telepon;
        $this->email=$member->email;
        $this->id=$member->id;
    }
    public function update()
    {
        $member = User::find($this->id);
        $member->update([
            'nama'=>$this->nama,
            'alamat'=>$this->alamat,
            'telepon'=>$this->telepon,
            'email'=>$this->email,
            ]);
            session()->flash('success', 'Berhasil ubah');
            return redirect()->route('member');
    }
    public function confirm($id)
    {
        $this->id=$id;
    }
    public function destroy()
    {
        $member=User::find($this->id);
        $member->delete();
        session()->flash('success', 'Berhasil Dihapus');
        return redirect()->route('member');
    }
}

