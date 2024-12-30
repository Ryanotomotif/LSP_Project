<?php

use App\Livewire\BukuComponent;
use App\Livewire\HomeComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\KembaliComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MemberComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/',HomeComponent::class)->middleware('auth')->name('home');

Route::get('/user',action: UserComponent::class)->name('user')->middleware('auth');
Route::get('/member',action: MemberComponent::class)->name('member')->middleware('auth');

Route::get('/kategori',action: KategoriComponent::class)->name('kategori')->middleware('auth');
Route::get('/buku',action: BukuComponent::class)->name('buku')->middleware('auth');

Route::get('/pinjam',action: PinjamComponent::class)->name('pinjam')->middleware('auth');
Route::get('/kembali',action: KembaliComponent::class)->name('kembali')->middleware('auth');


Route::get('/login',LoginComponent::class)->name('login');
Route::get('/logout',[LoginComponent::class,'keluar'])->name('logout');
