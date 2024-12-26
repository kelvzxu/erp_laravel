<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const previewPhoto = ref(user.profile_photo_path ? `/storage/${user.profile_photo_path}` : null);

const form = useForm({
    name: user.name,
    email: user.email,
    profile_photo_path: null,
});

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.profile_photo_path = file; // Masukkan file ke form
        console.log('Form Data:', form.data());
        previewPhoto.value = URL.createObjectURL(file); // Update preview dengan URL sementara
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.post(route('profile.update'))" class="mt-6 space-y-6">
            <!-- Foto Profil -->
            <div>
                <InputLabel for="profile_photo" value="Profile Photo" />

                <div class="flex items-center space-x-4">
                    <!-- Tampilkan Pratinjau Foto Profil -->
                    <img
                        v-if="previewPhoto"
                        :src="previewPhoto"
                        alt="Profile Photo"
                        class="h-20 w-20 rounded-full object-cover"
                    />
                    <img
                        v-else
                        src="https://via.placeholder.com/150"
                        alt="Default Profile Photo"
                        class="h-20 w-20 rounded-full object-cover"
                    />

                    <input
                        id="profile_photo_path"
                        type="file"
                        class="mt-1 block w-full"
                        @change="handleFileChange"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.profile_photo" />
            </div>

            <!-- Nama -->
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
