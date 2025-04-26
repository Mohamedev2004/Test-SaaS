@extends('layouts.dashboard')

@section('content')

<div class="dashboard__content d-flex">
<x-sidebar />
<div class="dashboard__rightt">
    <div class="dash__content ">
        <!-- sidebar menu -->
        <div class="sidebar__menu d-md-block d-lg-none">
            <div class="sidebar__action"><i class="fa-solid fa-bars"></i> Sidebar</div>
        </div>
        <!-- sidebar menu end -->

        <h6 class="fw-semibold mb-30">Marques et leurs pack</h6>
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Rechercher..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                @foreach($brands as $brand)
                <div class="single__shortlist__item flex items-start space-x-6 p-4 border-b border-gray-200">
                    <div class="author__info flex-1">
                        <div class="author__meta">
                            <div class="author__name max-w-xs">
                                <h6 class="fw-semibold text-lg font-semibold text-gray-800">{{ $brand->user->name ?? 'N/A' }}</h6>
                                <p class="text-sm text-gray-500">{{ $brand->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="author__info__list mt-2 text-sm text-gray-600">
                            {{-- <span>Phone: {{ $brand->phone }}</span><br>
                            <span>Statut: {{ $brand->status }}</span><br> --}}

                            @if($brand->brandPacks->isNotEmpty())
                            <span>Pack: {{ $brand->brandPacks->first()->pack->name ?? 'N/A' }}</span><br>
                            <span> {{ $brand->brandPacks->first()->start_date }}</span><br>
                            <span> {{ $brand->brandPacks->first()->end_date }}</span><br>
                        @else
                            <span>No pack assigned</span>
                        @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if(now()->greaterThan(\Carbon\Carbon::parse($brand->brandPacks->first()->end_date)->subDays(7)) && now()->lessThanOrEqualTo(\Carbon\Carbon::parse($brand->brandPacks->first()->end_date)))
                        <form action="{{ route('brandpack.renew', $brand->id) }}" method="POST" onsubmit="return confirm('Renouveler ce pack ?')">
                            @csrf
                            <button type="submit" class="bg-purple-600 hover:bg-purple-900 text-white font-semibold py-1 px-3 rounded">
                                Renouveler
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach

            </div>
        </div>

    <div class="d-flex justify-content-center mt-30">
    <p class="copyright" style="font-size: 15px !important;">Copyright © All Rights Reserved by cocollab</p>
    </div>
</div>
</div>
</div>
<!-- content area end -->

<x-canva />

<!-- Search Filter JS -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.single__shortlist__item').forEach(item => {
            let name = item.querySelector('.author__name h6').innerText.toLowerCase();
            item.style.display = name.includes(filter) ? '' : 'none';
        });
    });
</script>

@endsection
