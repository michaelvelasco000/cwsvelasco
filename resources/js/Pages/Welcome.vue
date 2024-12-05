<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="container-fluid" >
        <div class="row vh-100">
          
            <div class="col-md-6 d-flex justify-content-center">    
                <div class=" align-self-center">
                  
                        <div class="bg-gray-900 w-64 h-80 rounded-lg">
                                <div class="flex p-2 gap-1">
                                <div class="">
                                <span class="bg-red-500 inline-block center w-3 h-3 rounded-full"></span>
                                </div>
                                <div class="circle">
                                <span class="bg-yellow-500 inline-block center w-3 h-3 rounded-full"></span>
                                </div>
                                <div class="circle">
                                <span class="bg-green-500 box inline-block center w-3 h-3 rounded-full"></span>
                                </div>
                            </div>
                        <div class="card__content">
                            <div class="container">  
                                   <h2 class=" text-white text-center font-semibold text-xl text-light-800 leading-tight">
                 Test Task Created by Velasco, Michael Arian
                </h2>
                                            <nav v-if="canLogin" class="-mx-3 w3-panel p-4 flex flex-column w3-card gap-6">
                                                <Link
                                                    v-if="$page.props.auth.user"
                                                    :href="route('dashboard')"
                                                    class=" btn btn-primary text-white rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                                >
                                                    Dashboard
                                                </Link>
                                            
                                                <template v-else>
                                                    <Link
                                                        :href="route('login')"
                                                        class=" btn btn-primary text-white rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                                    >
                                                        Log in
                                                    </Link>

                                                    <Link
                                                        v-if="canRegister"
                                                        :href="route('register')"
                                                        class="btn btn-primary text-white rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                                    >
                                                        Register
                                                    </Link>
                                                </template>
                                        </nav>

                            </div>
                        </div>
                        </div>
                   

                </div>
          </div>
           <div class="col-md-6 d-none d-lg-block" style="  background: linear-gradient(to right, #bdc3c7, #2c3e50)">
                    </div>
        </div>
    </div>
    

</template>
