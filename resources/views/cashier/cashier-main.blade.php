@extends('layouts.cashier-layout')

@section('cashier_content')
    <div class="content">
        <div class="header">
            <h1>Dashboard</h1>
            <div>
                <p>Welcome, {{ Auth::user()->first_name }}</p>
                <p>Sunday, October 20, 2024</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <div>
                <h1 class="title">Cashier Page</h1>
            </div>
            <div>
                {{-- sample button for logout --}}
                <a href="{{ route('logout.confirm') }}" class="big-button">Logout</a>
            </div>
        </div>
    </div>
@endsection
