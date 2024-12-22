<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="container mx-auto py-5">
            <div class="max-w-sm mx-auto bg-gray-100 rounded shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col sm:justify-center items-center border-b pb-3 border-b mb-4" >
                        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </div>
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                placeholder="E.g. John Smith"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
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

                        <div class="mt-4">
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password_confirmation" value="Confirm Password" />

                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>

                        <div class="pt-3">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Register
                            </PrimaryButton>
                        </div>
                    </form>
                    <div class="text-center text-sm mt-4 pt-3 border-t">
                        <a class="border-r pr-2 mr-2 text-gray-600 hover:underline" :href="route('login')">Already registered?</a>
                        <a :href="route('database.selector')" target="_blank" class="text-gray-600 hover:underline">Manage Databases</a>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
