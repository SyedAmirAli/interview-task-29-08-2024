<template>
    <div
        class="w-full min-h-screen bg-white bg-gradient-to-tr from-blue-300/10 via-pink-300/10 to-purple-300/10"
    >
        <div class="container">
            <!-- <header>
                <div class="logo"></div>
                <div>
                    <nav><ul></ul></nav>
                    <div>
                        <button>reload</button>
                    </div>
                </div>
            </header> -->
            <header
                class="w-full relative py-6"
            >
                <div class="container relative z-10">
                    <nav class="w-full flex justify-between items-center">
                        <figure class="fill-primary-main flex gap-4 items-end">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 512"
                                width="60"
                                height="49"
                            >
                                <path
                                    d="M322.1 252v-1l-51.2-65.8s-12 1.6-25 15.1c-9 9.3-242.1 239.1-243.4 240.9-7 10 1.6 6.8 15.7 1.7 .8 0 114.5-36.6 114.5-36.6 .5-.6-.1-.1 .6-.6-.4-5.1-.8-26.2-1-27.7-.6-5.2 2.2-6.9 7-8.9l92.6-33.8c.6-.8 88.5-81.7 90.2-83.3zm160.1 120.1c13.3 16.1 20.7 13.3 30.8 9.3 3.2-1.2 115.4-47.6 117.8-48.9 8-4.3-1.7-16.7-7.2-23.4-2.1-2.5-205.1-245.6-207.2-248.3-9.7-12.2-14.3-12.9-38.4-12.8-10.2 0-106.8 .5-116.5 .6-19.2 .1-32.9-.3-19.2 16.9C250 75 476.5 365.2 482.2 372.1zm152.7 1.6c-2.3-.3-24.6-4.7-38-7.2 0 0-115 50.4-117.5 51.6-16 7.3-26.9-3.2-36.7-14.6l-57.1-74c-5.4-.9-60.4-9.6-65.3-9.3-3.1 .2-9.6 .8-14.4 2.9-4.9 2.1-145.2 52.8-150.2 54.7-5.1 2-11.4 3.6-11.1 7.6 .2 2.5 2 2.6 4.6 3.5 2.7 .8 300.9 67.6 308 69.1 15.6 3.3 38.5 10.5 53.6 1.7 2.1-1.2 123.8-76.4 125.8-77.8 5.4-4 4.3-6.8-1.7-8.2z"
                                ></path>
                            </svg>
                            <h1 class="text-5xl font-extrabold font-nunito">
                                App<span class="text-7xl text-red-500"
                                    >.</span
                                >
                            </h1>
                        </figure>

                        <div class="flex gap-20 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] p-2 rounded-full">
                            <ul
                                class="flex gap-20 text-lg font-semibold text-slate-700 px-8 py-4 rounded-full"
                            >
                                <li
                                    v-for="(menu, index) in menus"
                                    :key="index"
                                    :class="[ 'group', menu.active ? 'active' : '',]"
                                >
                                    <router-link
                                        :to="menu.path"
                                        class="px-1 duration-300 hover:text-primary-main relative group-[.active]:text-primary-main before:absolute before:left-0 before:-bottom-1 before:w-0 before:duration-300 before:rounded-full before:content-[''] before:h-0.5 before:bg-primary-main hover:before:w-full group-[.active]:before:!w-full"
                                    >
                                        {{ menu.name }}
                                    </router-link>
                                </li>
                            </ul>

                            <button
                                @click="reload"
                                class="px-8 py-4 text-lg font-extrabold z-10 uppercase rounded-full hover:tracking-wide duration-500 min-w-36 bg-secondary-main relative before:content-[''] before:w-0 before:absolute before:left-0 before:top-0 before:h-full before:bg-primary-main before:rounded-full hover:before:w-full before:duration-500 hover:text-white"
                            >
                                <span
                                    class="absolute z-20 left-0 top-0 w-full py-4"
                                    >reload</span
                                >
                            </button>
                        </div>
                    </nav>
                </div>
            </header>

            <!-- inject body -->
            <div class="w-full">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
import { useRouter } from 'vue-router';

export default {
    name: "Category",
    data() {
        const router = useRouter();
        const pathname = router.currentRoute.value.path; 

        return {
            menus: [
                { name: "Home", path: '/', active: pathname === '/' }, 
                { name: "Products", path: '/products', active: pathname === '/products' }, 
                { name: "Category", path: '/category', active: pathname === '/category' },
            ],
        };
    },

    methods:{
        reload: () => window.location.reload()
    }
};
</script>
