<template>
    <with-header>
        <div class="w-full mt-6 p-10 bg-white rounded-2xl">
            <h1 class="font-bold text-slate-500 text-2xl">
                <span class="tracking-[-4px]">---</span>
                <span class="px-2">Category</span>
            </h1>

            <form
                @submit.prevent="formHandler"
                class="flex w-full items-center justify-between py-2 my-2 bg-slate-50 pt-5 px-3 rounded-lg mt-6 gap-6"
            >
                <div
                    class="flex flex-col gap-1 w-full relative border border-primary-main/20 rounded-sm bg-white"
                >
                    <label
                        for="name"
                        class="font-medium uppercase text-slate-500 absolute left-3 -top-3 text-sm bg-white px-1 border border-primary-main/20 rounded-sm"
                        >Category Name</label
                    >
                    <input
                        type="text"
                        v-model="formData.category_name"
                        placeholder="e.g Electronics"
                        class="border-none outline-none placeholder:text-slate-400 placeholder:font-normal font-medium w-full bg-white rounded-sm block pt-4 focus:outline-none focus:border-none"
                    />
                </div>
                <div v-if="isEdit.status" class="flex gap-3">
                    <button
                        type="submit"
                        class="text-nowrap bg-cyan-500/80 hover:bg-cyan-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                    >
                        edit category
                    </button>
                    <button
                        type="button"
                        @click="cancelEdit"
                        class="text-nowrap bg-red-500/80 hover:bg-red-500 px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                    >
                        cancel
                    </button>
                </div>

                <div v-else>
                    <button
                        type="submit"
                        class="text-nowrap bg-primary-main/80 hover:bg-primary-main px-5 hover:tracking-[0.1px] duration-300 py-3 text-md uppercase text-slate-100 font-medium rounded-md"
                    >
                        add category
                    </button>
                </div>
            </form>
            <div class="w-full pt-10">
                <h1
                    class="text-slate-400 text-sm font-bold pb-1.5 mb-3 border-b border-dashed border-slate-300 block"
                >
                    <span class="tracking-[-4px]">---</span>
                    <span class="px-2">All Categories</span>
                </h1>

                <div
                    class="flex flex-wrap w-full gap-4 items-center justify-center mt-6"
                >
                    <div
                        v-for="category in categories"
                        class="bg-slate-100 flex items-center gap-3 px-4 text-md font-medium py-1.5 border border-dashed duration-300 text-slate-600 hover:border-primary-main hover:text-primary-main border-slate-300 rounded-full"
                    >
                        <p class="text-nowrap">{{ category.name }}</p>
                        <button
                            @click="editHandler(category)"
                            class="bg-white text-xs px-2 py-1.5 rounded-full border border-yellow-500 text-yellow-500 duration-300 hover:bg-yellow-500 hover:text-white"
                        >
                            <font-awesome-icon :icon="faPencil" />
                        </button>
                        <button
                            @click="deleteCategory(category.id)"
                            class="bg-white text-xs px-2 py-1.5 rounded-full border border-red-500 text-red-500 duration-300 hover:bg-red-500 hover:text-white"
                        >
                            <font-awesome-icon :icon="faTrash" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </with-header>
</template>

<script>
import { faPencil, faTrash } from "@fortawesome/free-solid-svg-icons";
import {
    notification,
    axiosCatchErrorNotify,
    notificationWrong,
    makeAlert,
} from "@/utils/swal-tost";
import { ref } from "vue";
import axios from "@/utils/axios";

export default {
    name: "Category",
    data() {
        const formData = ref({ category_name: "" });
        const categories = ref([]);
        const isEdit = ref({
            status: false,
            category_name: null,
            id: undefined,
        });

        return {
            menus: ["Home", "Products", "Category"],
            categories,
            formData,
            isEdit,
        };
    },

    async created() {
        // await this.$data. getCategories();
        await this.getCategories();
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

        // add new category handler/form-submit/api-request
        async addCategory(event) {
            event.preventDefault();

            try {
                const create = await axios.post(
                    "/category/store",
                    this.$data.formData
                );

                if (create.data?.status === "success") {
                    this.categories.unshift(create.data.data);

                    this.clearIsEdit();
                    notification(create.data?.message);
                } else notificationWrong();
            } catch (error) {
                axiosCatchErrorNotify(error);
            }
        },

        // category edit button action functions
        editHandler(category = { id: undefined, category_name: null }) {
            this.isEdit.status = !this.isEdit.status;
            this.isEdit.id = category.id;
            this.isEdit.category_name = category.name;
            this.formData.category_name = category.name;
        },

        // category edit cancel button action functions
        cancelEdit(event) {
            event.preventDefault();
            this.clearIsEdit();
        },

        // clear all form data withe edit cancellation
        clearIsEdit() {
            this.isEdit.status = false;
            this.isEdit.id = undefined;
            this.isEdit.category_name = "";
            this.formData.category_name = "";
        },

        // update category handler/form-submit/api-request
        async updateCategory(event) {
            event.preventDefault();

            try {
                const update = await axios.put(
                    `/category/${this.isEdit.id}/update`,
                    this.$data.formData
                );

                if (update.data?.status === "success") {
                    // this.categories.unshift(create.data.data);

                    const index = this.categories.findIndex(
                        (cat) => cat.id === update?.data?.data?.id
                    );
                    if (index !== -1)
                        this.categories.splice(index, 1, update.data?.data);

                    this.clearIsEdit();
                    notification(update.data?.message);
                } else notificationWrong();

                // console.log("create", create.data);
            } catch (error) {
                // console.log(error);

                if (typeof error?.response?.data?.message === "string") {
                    notification(error.response.data?.message, "error");
                } else notificationWrong();
            }
        },

        async formHandler(event) {
            event.preventDefault();

            if (this.isEdit.status) {
                await this.updateCategory(event);
            } else this.addCategory(event);
        },

        // delete category with it's all product handler/form-submit/api-request
        async deleteCategory(categoryId) {
            const alertConfirm = await makeAlert(
                "Delete Category!",
                "Are you sure to delete the category with it's products!",
                "warning"
            );

            if (alertConfirm) {
                try {
                    const update = await axios.delete(
                        `/category/${categoryId}/delete`,
                        this.$data.formData
                    );

                    if (update.data?.status === "success") {
                        const index = this.categories.findIndex(
                            (cat) => cat.id === categoryId
                        );
                        if (index !== -1) this.categories.splice(index, 1);

                        this.clearIsEdit();
                        notification(update.data?.message);
                    } else notificationWrong();
                } catch (error) {
                    if (typeof error?.response?.data?.message === "string") {
                        notification(error.response.data?.message, "error");
                    } else notificationWrong();
                }
            }

            console.log({ alertConfirm, categoryId });
        },
    },

    computed: {
        faPencil: () => faPencil,
        faTrash: () => faTrash,
    },
};
</script>
