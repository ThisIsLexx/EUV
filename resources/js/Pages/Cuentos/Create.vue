<script setup lang="ts">
import { router, useForm, Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Separator from '@/Components/Separator.vue';
import Button from '@/Components/Custom/Button.vue';
import { Cuento } from '@/types/cuento';
import { onMounted } from 'vue';
import { Breadcrumb } from '@/types/breadcrumb';

const form = useForm({
    titulo: null,
    contenido: null,
});

const props = defineProps({
    editable : {
        type: Boolean,
        default: false,
    },
    cuento: {
        type: Object as () => Cuento,
        default: null,
    },
    breadcrumbs: Array<Breadcrumb>,
});

onMounted(() => {
    if (props.editable) {
        form.titulo = props.cuento.titulo;
        form.contenido = props.cuento.contenido;
    }
});

</script>

<template>
    <Head :title="props.editable ? 'Editar cuento' : 'Registrar cuento'"/>
    <AppLayout title="Crear Cuento" :breadcrumbs="props.breadcrumbs">
        <div class="relative">
            <div class="absolute top-0 left-0 right-0 p-10 flex justify-center min-w-full h-[268px] rounded-md bg-gradient-to-r from-indigo-500/80 to-indigo-800/80 z-[-1] shadow-xl">
                <h1 class="text-white font-semibold text-3xl" v-if="props.editable === false">
                    Registrar nuevo cuento
                    <Separator />
                </h1>
                <h1 class="text-white font-semibold text-3xl" v-else>
                    Editar cuento: {{ cuento?.titulo }}
                    <Separator />
                </h1>
            </div>
        </div>
        <div class="px-24 pt-32">
            <div class="bg-white rounded-md shadow-xl p-5">
                <form @submit.prevent="props.editable ? form.put(route('cuento.update', cuento?.id)) : form.post('/cuento') " class="mt-5">
                    <div class="mb-4">
                        <div class="flex flex-col space-y-2 mb-2">
                            <label for="titulo">Titulo del cuento <span class="text-red-500 font-semibold">*</span></label>
                            <input type="text" name="titulo"
                                class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring-indigo-200 focus:border-indigo-200"
                                :class="{ 'border-red-600' : form.errors.titulo }"
                                v-model="form.titulo"
                            >
                            <div v-if="form.errors.titulo" class="text-red-500 text-xs uppercase">
                                {{ form.errors.titulo }}
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2 mb-2">
                            <label for="contenido">Contenido del cuento <span class="text-red-500 font-semibold">*</span></label>
                            <textarea name="contenido"
                                class="transition duration-100 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-200"
                                :class="{ 'border-red-600' : form.errors.contenido }"
                                v-model="form.contenido"></textarea>
                            <div v-if="form.errors.contenido" class="text-red-500 text-xs uppercase">
                                {{ form.errors.contenido }}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end w-full space-x-1">
                        <Button message="Cancelar" type="button" button="secondary" redirect="cuento.index"/>
                        <Button :message="props.editable ? 'Guardar cambios' : 'Crear cuento'" type="submit" button="primary" redirect="" />
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
