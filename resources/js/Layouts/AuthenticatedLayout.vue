<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

// Properti reaktif untuk kontrol sidebar dan menu dropdown
const sidebarVisible = ref(true);
const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside
            :class="{
                'w-64': sidebarVisible,
                'w-16': !sidebarVisible,
            }"
            class="bg-white dark:bg-gray-800 shadow-lg transition-all duration-300 ease-in-out flex flex-col"
        >
            <!-- Logo -->
            <div class="flex p-4 cursor-pointer" @click="sidebarVisible = !sidebarVisible">
                <ApplicationLogo class="h-9 w-9 fill-current text-gray-800 dark:text-gray-200" />
            </div>

            <!-- Navigation -->
            <nav class="flex-1 mt-4">
                <ul :class="{ 'space-y-2': sidebarVisible, 'space-y-0': !sidebarVisible }" class="transition-all">
                    <li>
                        <Link
                            href="#"
                            class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            <!-- Ganti SVG dengan <img> -->
                            <img
                                src="/assets/icon/apps.png"
                                alt="Apps Icon"
                                class="h-9 w-9 object-contain"
                            />
                            <span v-if="sidebarVisible" class="ml-4">Apps</span>
                        </Link>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- NavBar -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <!-- Toggle Button -->
                        <button
                            @click="sidebarVisible = !sidebarVisible"
                            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none sm:hidden"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="hidden sm:flex sm:items-center">
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </NavLink>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex items-center rounded-md">
                                        <!-- Foto Profil -->
                                        <img
                                            v-if="$page.props.auth.user.profile_photo_path"
                                            :src="`/storage/${$page.props.auth.user.profile_photo_path}`"
                                            alt="Profile Photo"
                                            class="h-8 w-8 rounded-full object-cover"
                                        />
                                        <img
                                            v-else
                                            src="https://via.placeholder.com/150"
                                            alt="Default Profile Photo"
                                            class="h-8 w-8 rounded-full object-cover"
                                        />

                                        <!-- Nama Pengguna -->
                                        <span class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ $page.props.auth.user.name }}
                                        </span>

                                        <!-- Panah Dropdown -->
                                        <svg
                                            class="ms-2 -me-0.5 h-4 w-4 text-gray-500 dark:text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </nav>
            <main class="flex-1 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
