@extends('layout.main')

@section('content')
  <div class="row">
    @php
      $cards = [
        ['icon' => 'fa-users', 'iconColor' => 'success', 'category' => 'Mahasiswa', 'value' => $mhs, 'moreInfo' => route('admin.mahasiswa')],
        ['icon' => 'fa-user-check', 'iconColor' => 'success', 'category' => 'Progdi', 'value' => $progdi, 'moreInfo' => '#'],
        ['icon' => 'fa-user-friends', 'iconColor' => 'success', 'category' => 'Dosen Pembimbing', 'value' => $dosbim, 'moreInfo' => '#'],
        ['icon' => 'fa-book-reader', 'iconColor' => 'success', 'category' => 'Judul', 'value' => $judul,  'moreInfo'=> route('admin.tesis.index')],
        ['icon' => 'fa-calendar-alt', 'iconColor' => 'success', 'category' => 'Daftar TA', 'value' => $ta, 'moreInfo' => route('admin.ta.index')],
        ['icon' => 'far fa-list-alt', 'iconColor' => 'success', 'category' => 'Akademik', 'value' => $mhs, 'moreInfo' => '#'],
        ['icon' => 'fa-user-tie', 'iconColor' => 'success', 'category' => 'Dosen', 'value' => $dosen,  'moreInfo'=> '#'],
      ];
    @endphp 
    @foreach ($cards as $card)
      <x-card-admin
        :icon="$card['icon']"
        :iconColor="$card['iconColor']"
        :category="$card['category']"
        :value="$card['value']"
        :moreInfo="$card['moreInfo']"
      />
    @endforeach
  </div>
@endsection
