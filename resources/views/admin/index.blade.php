@extends('layout.main')

@section('content')
  <div class="row">
    @php
      $cards = [
        ['icon' => 'fa-users', 'iconColor' => 'primary', 'category' => 'Mahasiswa', 'value' => $mhs, 'moreInfo' => route('admin.mahasiswa')],
        ['icon' => 'fa-user-check', 'iconColor' => 'info', 'category' => 'Progdi', 'value' => $progdi, 'moreInfo' => '#'],
        ['icon' => 'fa-luggage-cart', 'iconColor' => 'success', 'category' => 'Dosen Pembimbing', 'value' => $dosbim, 'moreInfo' => '#'],
        ['icon' => 'fa-check-circle', 'iconColor' => 'secondary', 'category' => 'Judul', 'value' => $judul,  'moreInfo'=> route('admin.tesis.index')],
        ['icon' => 'fa-check-circle', 'iconColor' => 'secondary', 'category' => 'Daftar TA', 'value' => $ta, 'moreInfo' => route('admin.ta.index')],
        ['icon' => 'fa-check-circle', 'iconColor' => 'secondary', 'category' => 'Akademik', 'value' => $mhs, 'moreInfo' => '#'],
        ['icon' => 'fa-check-circle', 'iconColor' => 'secondary', 'category' => 'Dosen', 'value' => $dosen,  'moreInfo'=> '#'],
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
