<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "Quotes",
    props: {
        quotes: {
            type: Array,
        },
    },
    components: {
        BreezeAuthenticatedLayout,
        Head
    },
    data() {
        return {
            quotesData: this.quotes,
            favoriteQuotes: [],
            success: false
        };
    },
    mounted() {
       axios.get('/favoriteQuotes').then(response => {
                this.favoriteQuotes = response.data;
            });
    },
    methods: {
        async refreshQuotes() {
            await axios.get('/refreshQuotes').then(response => {
                this.quotesData = response.data;
            });
        },
        async addToFavorite(quote) {
            await axios.post('/addToFavorite',{
                quote: quote
            }).then(response => {
                this.success = response.data.success;
            });
        }
    }
}
</script>

<template>
    <Head title="Quotes" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Quotes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            <li style="margin-bottom: 15px;" v-for="(quote, index) in quotesData">
                                {{quote}}
                                <button @click="addToFavorite(quote)" class="min">add to favorites</button>
                            </li>
                        </ul>
                        <button class="" @click="refreshQuotes()">Refresh</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style>
    button {
        border: 1px solid grey;
        border-radius: 15% 15%;
        margin-top: 15px;
        padding: 4px 8px
    }
    button.min {
        padding: 0 5px;
        margin-left: 15px;
        color: blue;

    }
</style>
