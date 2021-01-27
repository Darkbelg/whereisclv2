<x-guest-layout>
    <div class="lg:w-8/12 m-auto">
        @foreach ($events as $event)
        <x-event-videos :event="$event"></x-event-videos>
        @endforeach
        <footer class="grid sm:grid-cols-3 p-5 pl-10 bg-white rounded-lg">
            <div>
                <a class="link" href="http://support.operationsmile.org/site/TR?pg=fund&fr_id=1030&pxfid=39223">To donate, simply smile.</a>
            </div>
            <div>Mail <a class="link" href="mailto:support@whereiscl.com">Support</a></div>
            <div>
                <a class="link" href="https://www.youtube.com/t/terms">YouTube ToS​</a>
            </div>
        </footer>
    </div>
</x-guest-layout>
