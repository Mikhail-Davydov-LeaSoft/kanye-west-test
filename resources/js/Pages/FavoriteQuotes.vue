<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "FavoriteQuotes",
    props: {
        favoriteQuotes: {
            type: Array,
        },
    },
    components: {
        BreezeAuthenticatedLayout,
        Head
    },
    data() {
        return {
            favoriteQuotesData: this.favoriteQuotes
        };
    },
    methods: {
        async removeQuote() {
            await axios.get('/removeQuote').then(response => {
                this.status = response.data.success;
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
                            <li style="margin-bottom: 15px;" v-for="(quote, index) in favoriteQuotesData">
                                {{quote.quote}}
                                <button class="min">remove</button>
                            </li>
                        </ul>
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
