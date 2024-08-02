@extends('layout.main')

@section('content')
  <div class="row">
    @php
      $cards = [
        ['icon' => 'fa-users', 'iconColor' => 'success', 'category' => 'Mahasiswa', 'value' => $mhs, 'moreInfo' => route('admin.mahasiswa'),'backgroundClass'=> ''],
        ['icon' => 'fa-user-friends', 'iconColor' => 'success', 'category' => 'Dosen Pembimbing', 'value' => $dosbim, 'moreInfo' => route('admin.dosen.listDosen'),'backgroundClass'=> 'bg-secondary'],
        ['icon' => 'fa-book-reader', 'iconColor' => 'success', 'category' => 'Judul', 'value' => $judul,  'moreInfo'=> route('admin.tesis.index'),'backgroundClass'=> 'bg-warning'],
        ['icon' => 'fa-calendar-alt', 'iconColor' => 'success', 'category' => 'Daftar TA', 'value' => $ta, 'moreInfo' => route('admin.ta.index'),'backgroundClass'=> 'bg-success'],
        ['icon' => 'far fa-list-alt', 'iconColor' => 'success', 'category' => 'Akademik', 'value' => 5, 'moreInfo' => route('admin.index-akademik-mhs'),'backgroundClass'=> 'bg-info'],
        ['icon' => 'fa-user-tie', 'iconColor' => 'success', 'category' => 'Dosen', 'value' => $dosen,  'moreInfo'=> route('admin.dosen.listDosen'),'backgroundClass'=> 'bg-success'],
      ];
    @endphp 
    @foreach ($cards as $card)
      <x-card-admin
        :icon="$card['icon']"
        :iconColor="$card['iconColor']"
        :category="$card['category']"
        :value="$card['value']"
        :moreInfo="$card['moreInfo']"
        :backgroundClass="$card['backgroundClass']"
      />
    @endforeach
  </div>
@endsection
