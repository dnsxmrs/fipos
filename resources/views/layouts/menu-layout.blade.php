@extends('layouts.admin-layout')

@section('content')
    <!--mainframe-->
    <div>
        <div>
            @include()
        </div>
        <div class="flex h-screen w-screen bg-[rgb(243,243,243)]">
            <!--sidebar-->
            <div class="flex h-screen bg-[rgb(243,243,243)] ">
                @include('sidebar.admin-sidebar')
            </div>


            <!--main content-->
            <main class="flex-1 p-8 overflow-y-auto w-5/6">
                @yield('content')
            </main>

        </div>
    </div>
@endsection
