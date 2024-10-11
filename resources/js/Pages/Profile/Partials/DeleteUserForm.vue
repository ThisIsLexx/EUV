<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title>
            Eliminar cuenta
            <!-- Delete Account -->
        </template>

        <template #description>
            Elimina tu cuenta de manera permanente.
            <!-- Permanently delete your account. -->
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Una vez que su cuenta sea eliminada, todos los datos relacionados a ella serán borrados de manera permanente. Antes de eliminar tu cuenta, por favor descarga cualquier información que desees conservar.
                <!-- Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. -->
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmUserDeletion">
                    Eliminar cuenta
                    <!-- Delete Account -->
                </DangerButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Eliminar cuenta
                    <!-- Delete Account -->
                </template>

                <template #content>
                    ¿Esta seguro que desea eliminar su cuenta? Una vez que su cuenta sea eliminada, todos los datos relacionados a ella serán eliminados permanentemente. Por favor, ingrese su contraseña para confirmar que desea eliminar su cuenta de manera permanente.
                    <!-- Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. -->

                    <div class="mt-4">
                        <TextInput
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="Contraseña"
                            autocomplete="current-password"
                            @keyup.enter="deleteUser"
                        />

                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton @click="closeModal">
                        Cancelar
                        <!-- Cancel -->
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Eliminar cuenta
                        <!-- Delete Account -->
                    </DangerButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
