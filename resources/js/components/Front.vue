<template>
    <div class="lg:w-8/12 m-auto">
        <div class="bg-gray-100 lg:p-2 lg:p-10 mb-2 shadow-sm rounded-lg" v-for="(event, $index) in events"
             :key="$index">
            <div class="text-4xl leading-6 p-2 font-medium text-gray-900 lg:flex lg:justify-between">
                <h1 class="font-serif">{{ event.title }}</h1>
                <p class="text-sm text-right lg:left text-gray-700">{{ event.date }}</p>
            </div>
            <p class="text-gray-700 lg:mt-3 ml-5"><span class="w-1/2 lg:w-0">Location:</span> {{ event.location }}</p>

            <div class="lg:mt-2 flex flex-col sm:flex-row flex-wrap" v-if="event.videos">
                <div class="flex flex-col sm:w-1/3 rounded-lg hover:bg-white" v-for="video in event.videos">
                    <div class="lg:m-3 mb-3">
                        <a target="_blank" rel="noopener" :href="video.url">
                            <div v-for="thumbnail in video.thumbnails">
                                <img loading=lazy :src="thumbnail.url" alt="" :width="thumbnail.width"
                                     :height="thumbnail.height">
                            </div>
                            <div class="pl-2 justify-between">
                                <div>
                                    <div class="text-lg leading-6 font-medium flex justify-between">
                                        <h1>{{ video.title }}</h1>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-700">
                                    <p>{{ video.views }} Views</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <infinite-loading @infinite="infiniteHandler">
            <div slot="spinner" class="w-1 m-auto p-10">
                <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div slot="no-more"></div>
            <div slot="no-results"></div>
        </infinite-loading>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            events: [],
            page: 1
        }
    },
    methods: {
        infiniteHandler($state) {
            axios.get('/api/events', {
                params: {
                    page: this.page,
                },
            }).then(({data}) => {
                if (data.data.length) {
                    this.page += 1;
                    this.events.push(...data.data);
                    $state.loaded();
                } else {
                    $state.complete();
                }
            });
        },
    }
}
</script>
