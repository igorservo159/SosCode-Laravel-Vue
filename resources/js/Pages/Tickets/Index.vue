<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Ticket from '@/Components/Ticket.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
 
defineProps(['tickets']);

const form = useForm({
    message: '',
    category: '',
});

</script>
 
<template>
    <Head title="Tickets" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('tickets.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="Escreva seu ticket"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />

                <select v-model="form.category" class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="" disabled selected>Select a category</option>
                    <option value="Desenvolvimento Web">Desenvolvimento Web</option>
                    <option value="Programação Embarcada">Programação Embarcada</option>
                    <option value="Inteligência Artificial">Inteligência Artificial</option>
                    <option value="Banco de Dados">Banco de Dados</option>
                    <option value="Outros">Outros</option>
                </select>
                <InputError :message="form.errors.category" class="mt-2" />

                <PrimaryButton class="mt-4">Ticket</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Ticket
                    v-for="ticket in tickets"
                    :key="ticket.id"
                    :ticket="ticket"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>