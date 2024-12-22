<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';


defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="container mx-auto py-5">
            <div class="max-w-sm mx-auto bg-gray-100 rounded shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col sm:justify-center items-center border-b pb-3 border-b mb-4" >
                        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </div>

                    <form class="space-y-4" @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                placeholder="Email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                placeholder="Password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="pt-3">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Log in
                            </PrimaryButton>
                        </div>

                        <div class="flex justify-between text-sm text-gray-600 mt-2">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                            </label>
                            <a :href="route('password.request')" class="hover:underline">Reset Password</a>
                        </div>
                    </form>

                    <div class="text-center text-sm mt-4 pt-3 border-t">
                        <a class="border-r pr-2 mr-2 text-gray-600 hover:underline" :href="route('register')">Don't have an account?</a>
                        <a :href="route('database.selector')" target="_blank" class="text-gray-600 hover:underline">Manage Databases</a>
                    </div>
                </div>
            </div>
        </div>

    </GuestLayout>
</template>
