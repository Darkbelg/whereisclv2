<template>
    <div class="lg:w-8/12 m-auto" :class="{'loading':loading}">
        <div class="bg-gray-100 lg:p-2 lg:p-10 mb-2 shadow-sm rounded-lg" v-for="event in events">
            <div class="text-4xl leading-6 p-2 font-medium text-gray-900 lg:flex lg:justify-between">
                <h1 class="font-serif">{{ event.title }}</h1>
                <p class="text-sm text-right lg:left text-gray-700">{{ event.date }}</p>
            </div>
            <p class="text-gray-700 lg:mt-3 ml-5"><span class="w-1/2 lg:w-0">Location:</span> {{ event.location }}</p>

            <div class="lg:mt-2 flex flex-col sm:flex-row flex-wrap" v-if="event.videos">
                <div class="flex flex-col sm:w-1/3 rounded-lg hover:bg-white" v-for="video in event.videos">
                    <div class="lg:m-3 mb-3">
                        <a target="_blank" :href="video.url">
                            <div v-for="thumbnail in video.thumbnails" v-if="thumbnail.size == 'high'">
                                <img  :src="thumbnail.url" alt="" :width="thumbnail.width" :height="thumbnail.height">
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

        <footer class="grid sm:grid-cols-3 p-5 pl-10 bg-white rounded-lg">
            <div>
                <a class="link" href="http://support.operationsmile.org/site/TR?pg=fund&fr_id=1030&pxfid=39223">To
                    donate, simply smile.</a>
            </div>
            <div>Mail <a class="link" href="mailto:support@whereiscl.com">Support</a></div>
            <div>
                <a class="link" href="https://www.youtube.com/t/terms">YouTube ToS​</a>
            </div>
        </footer>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            events: [],
            loading: true
        }
    },
    mounted() {
        this.loadEvents();
    },
    methods: {
        loadEvents: function () {
            axios.get('/api/events').then((response) => {
                this.events = response.data.data;
                this.loading = false;
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>
