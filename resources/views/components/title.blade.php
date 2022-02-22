<div class="text-white hover:text-white">
    @if(!request()->routeIs('home'))
        <a href="{{ route('home')  }}" class="hover:underline hover:text-white">
    @endif
        <h1 class="text-6xl p-2 font-serif ">#WhereIsCL
            <span class="hidden xl:inline-block leading-none font-sans text-base pl-2">Cherry Picked Videos &amp; Fancams</span>
        </h1>
    @if(!request()->routeIs('home'))
        </a>
    @endif

</div>
