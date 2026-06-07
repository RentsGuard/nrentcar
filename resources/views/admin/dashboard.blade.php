@extends('layout')

@section('content')

<h3>Admin Dashboard</h3>
<p>Dashboard Overview</p>

<div class="row g-3">

    <div class="col-md-3">
        <div class="p-3 bg-dark rounded">
            <h4>8</h4>
            <small>Total Mobil</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-dark rounded">
            <h4>6</h4>
            <small>Tersedia</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-dark rounded">
            <h4>2</h4>
            <small>Disewa</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3 bg-dark rounded">
            <h4>1</h4>
            <small>Pending</small>
        </div>
    </div>

</div>

<div class="mt-4 bg-dark p-3 rounded">
    <h5>Aktivitas Terbaru</h5>
    <ul>
        <li>Customer baru - Siti Nurhaliza</li>
        <li>Mobil disewa - Mercedes</li>
        <li>Mobil kembali - Honda Brio</li>
    </ul>
</div>

@endsection
