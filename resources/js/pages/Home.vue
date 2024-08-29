<template>
    <with-header>
        <h1 class="font-bold text-slate-500 text-2xl mt-8 mb-4">
            <span class="tracking-[-4px]">---</span>
            <span class="px-2">All Product</span>
        </h1>
        <div class="w-full flex flex-wrap items-center justify-center gap-3">
            <div
                v-for="(product, index) in products"
                :key="index"
                class="w-full sm:w-[32.5%] p-2 bg-white rounded-md border border-solid border-slate-300 shadow-[0px_2px_4px_0px_rgba(0,0,0,0.08)]"
            >
                <figure
                    class="before:content-[''] before:pt-[75%] before:block relative"
                >
                    <img
                        :src="asset(product.image)"
                        :alt="product.name"
                        class="w-full rounded-md absolute inset-0 h-full object-cover"
                    />
                </figure>

                <h3 class="text-lg font-medium text-slate-700 pt-4 px-2">
                    {{ product.name }}
                </h3>

                <div class="flex gap-2 px-2 my-2">
                    <h4 class="text-md font-medium text-slate-400">
                        Categories:
                    </h4>
                    <p
                        class="text-sm flex flex-wrap w-full gap-2 items-start justify-start"
                    >
                        <span
                            v-for="(category, index) in product.categories"
                            :key="index"
                            class="bg-slate-100 px-2 p-1 text-sm block shadow-md"
                            >{{ category.name }}</span
                        >
                    </p>
                </div>
                <div class="flex gap-2 px-2">
                    <h4 class="text-md font-medium text-slate-400">
                        Features:
                    </h4>
                    <p
                        class="text-sm flex flex-wrap w-full gap-2 items-start justify-start"
                    >
                        <span
                            v-for="(feature, index) in product?.features"
                            :key="index"
                            class="bg-slate-100 px-2 p-1 text-sm block shadow-md"
                            >{{ feature.description }}</span
                        >
                    </p>
                </div>
            </div>
        </div>
    </with-header>
</template>
<script>
import axios from "../utils/axios";
import { notificationWrong, notification } from "../utils/swal-tost";

import { ref } from "vue";

export default {
    data() {
        return {
            products: ref([]),
            asset:
                "asset" in window.asset ? window.asset : (endpoint) => endpoint,
        };
    },

    async created() {
        await this.getProducts();
    },

    methods: {
        async getProducts() {
            try {
                const result = await axios.get("/product");

                if (result.data?.status === "success") {
                    this.products = result.data.data;
                } else notificationWrong();
            } catch (error) {
                notification("Failed to get categories!", "error");
            }
        },
    },
};
</script>
