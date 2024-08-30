<template>
    <with-header>
        <div class="w-full mt-6 p-10 bg-white rounded-2xl">
            <h1 class="font-bold text-slate-500 text-2xl">
                <span class="tracking-[-4px]">---</span>
                <span class="px-2">Manage Product</span>
            </h1>

            <form
                @submit.prevent="addProduct"
                class="flex w-full flex-col items-center justify-between py-2 my-2 bg-slate-50 pt-5 px-3 rounded-lg mt-6 gap-6"
            >
                <div class="w-full flex flex-col gap-4">
                    <div
                        class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                    >
                        <label
                            for="name"
                            class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                            >Product Name</label
                        >
                        <input
                            type="text"
                            v-model="formData.product_name"
                            placeholder="e.g Mackbook pro"
                            class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                        />
                    </div>
                    <div
                        class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                    >
                        <label
                            for="name"
                            class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                            >Select Category</label
                        >

                        <!-- Show All Selected Category -->
                        <div
                            class="w-full flex flex-wrap gap-2 pt-4 px-2 pb-1"
                            v-if="selectedCategories.length"
                        >
                            <div
                                class="bg-slate-100 flex items-center gap-3 px-4 text-md font-medium py-1.5 border border-dashed duration-300 text-slate-600 hover:border-primary-main hover:text-primary-main border-slate-300 rounded-full"
                                v-for="(category, index) in selectedCategories"
                                :key="index"
                            >
                                <p class="text-nowrap">{{ category.name }}</p>
                                <button
                                    @click="cancelSelectedCategory(category)"
                                    class="bg-white text-xl px-1 pb-1 leading-4 rounded-full border border-red-500 text-yellow-500 duration-300 hover:bg-red-500 hover:text-white"
                                >
                                    &times;
                                </button>
                            </div>
                        </div>

                        <!-- Category Select Box -->
                        <!-- <ul class="flex flex-col gap-2 px-2 bg-slate-100">
                            <li
                                v-for="(category, index) in categories"
                                :value="JSON.stringify(category)"
                                :key="index"
                                class="bg-slate-100 px-2 py-1"
                            >
                                {{ category.name }}
                            </li>
                        </ul> -->
                        <p
                            class="pt-1"
                            v-if="selectedCategories.length <= 0"
                        ></p>
                        <select
                            id="category"
                            @change="selectCategoryHandler"
                            class="outline-none placeholder:text-slate-400 placeholder:font-normal border-t border-none border-slate-300 font-medium w-full bg-white capitalize rounded-sm block pt-2 focus:outline-none focus:border-none"
                        >
                            <option hidden selected>Select Category</option>
                            <option
                                v-for="(category, index) in categories"
                                :value="JSON.stringify(category)"
                                :key="index"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <!-- </select> -->
                    </div>
                </div>

                <!-- Add Product Features -->
                <div class="w-full">
                    <div class="w-full flex justify-between items-center gap-4">
                        <div
                            class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                        >
                            <label
                                :for="features[0].name"
                                class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                                >Add Features</label
                            >
                            <!-- v-model="formData.product_name" -->
                            <input
                                type="text"
                                placeholder="e.g Mackbook pro"
                                name="feature_1"
                                v-model="features[0].description"
                                class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                            />
                        </div>
                        <button
                            @click="addFeatureMoreHandler"
                            type="button"
                            class="text-nowrap bg-green-500/80 hover:bg-green-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                        >
                            add more
                        </button>
                    </div>

                    <!-- More features options -->
                    <div
                        class="w-full"
                        v-for="(feature, index) in features"
                        :key="index"
                    >
                        <div
                            class="w-full flex justify-between items-center gap-4 mt-3"
                            v-if="index !== 0"
                        >
                            <div
                                class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                            >
                                <label
                                    :for="feature.name"
                                    class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                                    >Add Features {{ feature.id }}</label
                                >
                                <!-- v-model="formData.product_name" -->
                                <input
                                    name="{{ feature.name }}"
                                    v-model="feature.description"
                                    type="text"
                                    placeholder="e.g Mackbook pro"
                                    class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                                />
                            </div>
                            <button
                                @click="cancelMoreFeature(feature.id)"
                                type="button"
                                class="text-nowrap bg-red-500/80 hover:bg-red-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                            >
                                cancel
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                >
                    <label
                        for="name"
                        class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                        >Product Image</label
                    >
                    <input
                        @change="productImageHandler"
                        type="file"
                        placeholder="e.g Electronics"
                        class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                    />

                    <div
                        class="relative flex max-w-[200px]"
                        v-if="previewImage(formData.product_image)"
                    >
                        <img
                            :src="previewImage(formData.product_image)"
                            alt="Product Image"
                            width="200"
                            class="m-2 rounded-md border border-solid border-primary-main/30 p-1"
                        />

                        <button
                            class="absolute top-4 right-4 bg-white text-red-500 px-1.5 hover:bg-red-500 hover:text-slate-100 duration-300 pb-2 rounded-full border border-solid border-red-500 leading-5 text-2xl z-10"
                        >
                            &times;
                        </button>
                    </div>
                </div>

                <!-- Submit buttons -->
                <div class="w-full flex items-end justify-end">
                    <button
                        type="submit"
                        class="text-nowrap bg-primary-main/80 hover:bg-primary-main px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                    >
                        add Product
                    </button>
                </div>
            </form>

            <!-- Showcase Product Table -->
            <div class="w-full pt-10">
                <h1
                    class="text-slate-400 text-sm font-bold pb-1.5 mb-3 border-b border-dashed border-slate-300 block"
                >
                    <span class="tracking-[-4px]">---</span>
                    <span class="px-2">All Products</span>
                </h1>

                <div class="mt-6 w-full">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th
                                    class="border border-solid border-slate-300 p-1"
                                >
                                    Image
                                </th>
                                <th
                                    class="border border-solid border-slate-300 p-1"
                                >
                                    Name
                                </th>
                                <th
                                    class="border border-solid border-slate-300 p-1"
                                >
                                    Categories
                                </th>
                                <th
                                    class="border border-solid border-slate-300 p-1"
                                >
                                    Features
                                </th>
                                <th
                                    class="border border-solid border-slate-300 p-1"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <td
                                    class="border border-solid border-slate-300 p-1"
                                >
                                    <img
                                        :src="product.image"
                                        :alt="product.name"
                                        width="80"
                                    />
                                </td>
                                <td
                                    class="border border-solid border-slate-300 p-1 text-center"
                                >
                                    {{ product.name }}
                                </td>
                                <td
                                    class="border border-solid border-slate-300 p-1 text-center"
                                >
                                    {{ showSerializeItem(product.categories) }}
                                </td>
                                <td
                                    class="border border-solid border-slate-300 p-1 text-center"
                                >
                                    <p>
                                        {{
                                            showSerializeItem(
                                                product.features,
                                                "description"
                                            )
                                        }}
                                    </p>
                                    <button
                                        @click="featureHandler(product)"
                                        class="text-sm font-medium px-3 rounded-md text-slate-50 bg-cyan-500 duration-200 hover:bg-cyan-700 ml-2 text-nowrap"
                                    >
                                        Add More
                                    </button>
                                </td>
                                <td
                                    class="border border-solid border-slate-300 p-1 text-center"
                                >
                                    <button
                                        @click="editHandler(product)"
                                        class="text-sm font-medium px-3 rounded-md text-slate-50 bg-yellow-500 duration-200 hover:bg-yellow-700 mr-2"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        @click="deleteProduct(product.id)"
                                        class="text-sm font-medium px-3 rounded-md text-slate-50 bg-red-500 duration-200 hover:bg-red-700"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div
            v-if="isEdit.status"
            class="fixed top-0 left-0 w-full min-h-screen flex flex-col items-center justify-center bg-black/40 z-10"
        >
            <div class="max-w-3xl w-full bg-slate-100 p-10 rounded-3xl">
                <form
                    @submit.prevent="updateProduct"
                    class="flex w-full flex-col items-center justify-between py-2 my-2 bg-slate-50 pt-5 px-3 rounded-lg mt-6 gap-6 max-w-3xl"
                >
                    <div
                        class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                    >
                        <label
                            for="name"
                            class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                            >Product Name</label
                        >
                        <input
                            type="text"
                            v-model="isEdit.product_name"
                            placeholder="e.g Mackbook pro"
                            class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                        />
                    </div>
                    <div
                        class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                    >
                        <label
                            for="image"
                            class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                            >Product Image</label
                        >
                        <input
                            @change="productImageHandler"
                            type="file"
                            placeholder="e.g Electronics"
                            class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                        />

                        <div
                            class="relative flex max-w-[200px]"
                            v-if="makeImage(isEdit.product_image)"
                        >
                            <img
                                :src="makeImage(isEdit.product_image)"
                                alt="Product Image"
                                width="200"
                                class="m-2 rounded-md border border-solid border-primary-main/30 p-1"
                            />

                            <button
                                class="absolute top-4 right-4 bg-white text-red-500 px-1.5 hover:bg-red-500 hover:text-slate-100 duration-300 pb-2 rounded-full border border-solid border-red-500 leading-5 text-2xl z-10"
                            >
                                &times;
                            </button>
                        </div>
                    </div>
                    <div class="flex gap-3 w-full items-end justify-end">
                        <button
                            type="submit"
                            class="text-nowrap bg-cyan-500/80 hover:bg-cyan-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                        >
                            update Product
                        </button>
                        <button
                            type="button"
                            @click="cancelEdit"
                            class="text-nowrap bg-red-500/80 hover:bg-red-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                        >
                            cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div
            v-if="productFeature.status"
            class="fixed top-0 left-0 w-full min-h-screen flex flex-col items-center justify-center bg-black/40 z-10"
        >
            <div class="max-w-3xl w-full bg-slate-100 p-10 rounded-3xl">
                <h1 class="font-bold text-slate-500 text-2xl">
                    <span class="tracking-[-4px]">---</span>
                    <span class="px-2">Add More Product Feature</span>
                </h1>

                <form
                    @submit.prevent="addFeature"
                    class="flex w-full flex-col items-center justify-between py-2 my-2 bg-slate-50 pt-5 px-3 rounded-lg mt-6 gap-6 max-w-3xl"
                >
                    <div
                        class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                    >
                        <label
                            for="name"
                            class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                            >Feature Title</label
                        >
                        <input
                            type="text"
                            v-model="productFeature.feature_description"
                            placeholder="e.g special"
                            class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                        />
                    </div>
                    <div class="flex gap-3 w-full items-end justify-end">
                        <button
                            type="submit"
                            class="text-nowrap bg-cyan-500/80 hover:bg-cyan-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                        >
                            Add Feature
                        </button>
                        <button
                            type="button"
                            @click="cancelAddFeature"
                            class="text-nowrap bg-red-500/80 hover:bg-red-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                        >
                            cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </with-header>
</template>

<script>
import { ref } from "vue";
import axios from "@/utils/axios";
import {
    makeAlert,
    notificationWrong,
    notification,
    axiosCatchErrorNotify,
} from "@/utils/swal-tost";

export default {
    name: "Product",

    data() {
        const categories = ref([]);
        const products = ref([]);
        const selectedCategories = ref([]);
        const isEdit = ref({
            status: false,
            id: undefined,
            product_name: "",
            product_image: null,
        });
        const formData = ref({
            product_name: "",
            product_image: null,
            product_category: 1,
        });

        const productFeature = ref({
            status: false,
            product_id: undefined,
            feature_description: "",
        });

        const features = ref([{ id: 1, name: "feature_1", description: "" }]);

        return {
            isEdit,
            formData,
            categories,
            selectedCategories,
            products,
            productFeature,
            features,
        };
    },

    async created() {
        await this.getCategories();
        await this.getProducts();
    },

    methods: {
        // get all categories from api request
        async getCategories() {
            try {
                const result = await axios.get("/category");

                if (result.data?.status === "success") {
                    this.categories = result.data.data;
                } else notificationWrong();
            } catch (error) {
                // console.log(error);
                notification("Failed to get categories!", "error");
            }
        },

        async getProducts() {
            try {
                const result = await axios.get("/product");
                // console.log("result-products", result.data);

                if (result.data?.status === "success") {
                    this.products = result.data.data;
                } else notificationWrong();
            } catch (error) {
                notification("Failed to get categories!", "error");
            }
        },

        productImageHandler(event) {
            if (this.isEdit.status) {
                this.isEdit.product_image = event.target.files[0];
            } else this.formData.product_image = event.target.files[0];
        },

        previewImage(obj) {
            if (obj && Object.isExtensible(obj)) {
                return URL.createObjectURL(obj);
            }

            return null;
        },

        selectCategoryHandler(event) {
            const category = JSON.parse(event.target.value);
            const index = this.selectedCategories.findIndex(
                (cat) => cat.id === category.id
            );
            if (index !== -1) {
                this.selectedCategories.splice(index, 1);
            } else {
                this.selectedCategories.unshift(category);
            }
            // console.log(category);
        },

        clearIsEdit() {
            this.isEdit.status = false;
            this.isEdit.id = undefined;
            this.isEdit.product_name = "";
            this.isEdit.product_image = null;
        },

        async cancelSelectedCategory(category) {
            // console.log(category);
            const index = this.selectedCategories.findIndex(
                (cat) => cat.id === category.id
            );
            if (index !== -1) this.selectedCategories.splice(index, 1);
        },

        // delete product handler/form-submit/api-request
        async deleteProduct(productId) {
            const alertConfirm = await makeAlert(
                "Delete Product!",
                "Are you sure to delete the product!",
                "warning"
            );

            if (alertConfirm)
                try {
                    const result = await axios.delete(
                        `/product/${productId}/delete`
                    );

                    if (result.data?.status === "success") {
                        const index = this.products.findIndex(
                            (pdt) => pdt.id === productId
                        );
                        if (index !== -1) {
                            this.products.splice(index, 1);
                        }

                        notification(result.data?.message);
                    } else {
                        notificationWrong();
                    }
                } catch (error) {
                    axiosCatchErrorNotify(error);

                    // console.log(error);
                }
        },

        // add product's name & image handler/form-submit/api-request
        async updateProduct() {
            try {
                const formData = new FormData();
                formData.append("product_name", this.isEdit.product_name);
                formData.append("product_image", this.isEdit.product_image);

                for (let pair of formData.entries()) {
                    console.log(`${pair[0]}: ${pair[1]}`);
                }

                const update = await axios.post(
                    `/product/${this.isEdit.id}/update`,
                    formData
                );
                // console.log("Product Update", update.data);

                if (update.data?.status === "success") {
                    const index = this.products.findIndex(
                        (pdt) => pdt.id === update?.data?.data?.id
                    );
                    if (index !== -1) {
                        this.products[index].name = update.data?.data?.name;
                        this.products[index].image = update.data?.data?.image;
                    }

                    this.clearIsEdit();
                    notification(update.data?.message);
                } else {
                    notificationWrong();
                }
            } catch (error) {
                axiosCatchErrorNotify(error);

                // console.log(error);
            }
        },

        // add new product handler/form-submit/api-request
        async addProduct(event) {
            try {
                const formData = new FormData();
                formData.append("product_name", this.formData.product_name);
                formData.append("product_image", this.formData.product_image);
                formData.append(
                    "product_categories",
                    JSON.stringify(this.selectedCategories)
                );
                formData.append(
                    "product_features",
                    JSON.stringify(this.features)
                );

                const create = await axios.post("/product/store", formData);
                console.log("Product Create", create.data);

                if (create.data?.status === "success") {
                    this.products.unshift(create.data.data);

                    event.target.reset();
                    this.selectedCategories = [];
                    this.formData.product_category = "";
                    this.formData.product_name = "";
                    this.formData.product_image = null;
                    this.features = [
                        { id: 1, name: "feature_1", description: "" },
                    ];
                    notification(create.data?.message);
                } else {
                    notificationWrong();
                }
            } catch (error) {
                axiosCatchErrorNotify(error);

                console.log(error);
            }
        },

        showSerializeItem(items = [], key = "name") {
            if (items.length <= 0) return "";

            return items.map((item) => item[key]).join(", ");
        },

        async cancelEdit(event) {
            event.preventDefault();
            this.clearIsEdit();
        },

        editHandler(product = {}) {
            this.isEdit.status = true;
            this.isEdit.id = product?.id;
            this.isEdit.product_name = product?.name;
            this.isEdit.product_image = product?.image;
        },

        makeImage(path) {
            if (typeof path === "string") {
                return "asset" in window ? window.asset(path) : path;
            }

            if (path !== null && Object.isExtensible(path)) {
                return URL.createObjectURL(path);
            }

            return null;
        },

        // feature
        featureHandler(product) {
            this.productFeature.status = true;
            this.productFeature.product_id = product?.id;
            this.productFeature.feature_description = "";
        },

        clearFeature() {
            this.productFeature.status = false;
            this.productFeature.product_id = undefined;
            this.productFeature.feature_description = "";
        },

        cancelAddFeature(event) {
            event.preventDefault();
            this.clearFeature();
        },

        // add product-feature handler/form-submit/api-request
        async addFeature() {
            try {
                const productId = this.productFeature.product_id;
                const create = await axios.post(
                    `/product/${productId}/feature/store`,
                    {
                        feature_description:
                            this.productFeature.feature_description,
                    }
                );

                if (create.data?.status === "success") {
                    const index = this.products.findIndex(
                        (pdt) => pdt.id === productId
                    );
                    if (index !== -1) {
                        this.products[index]?.features?.push(create.data?.data);
                    }

                    this.clearFeature();
                    notification(create.data?.message);
                } else {
                    notificationWrong();
                }
            } catch (error) {
                axiosCatchErrorNotify(error);
                // console.log(error);
            }
        },

        addFeatureMoreHandler() {
            const nextId =
                this.features.reduce((acc, curr) => Math.max(acc, curr.id), 0) +
                1;
            this.features.push({
                id: nextId,
                name: `features_${nextId}`,
                description: "",
            });
            // console.log({ nextId, features: this.features });
        },

        cancelMoreFeature(featureId) {
            const index = this.features.findIndex(
                (feature) => feature.id === featureId
            );
            if (index !== -1) this.features.splice(index, 1);
        },
    },
};
</script>
