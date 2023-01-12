<template>
    <Head title="Skills Create"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update Project</h2>
        </template>
        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="mt-4 pt-4" @submit.prevent="updateProject">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Project Name
                        </label>
                        <input v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3
                            text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="name" type="text" placeholder="Project Name">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="project_url">
                            Project Url
                        </label>
                        <input name="project_url" v-model="form.project_url" class="shadow appearance-none border rounded w-full py-2 px-3
                            text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="project_url" type="text" placeholder="Project Url">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="project_url">
                            Skills
                        </label>
                        <div class="flex justify-center">
                            <div class="mb-3 xl:w-96">
                                <select v-model="form.skill_id"
                                        class="form-select appearance-noneblock w-full px-3 py-1.5 text-base
                                font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid
                                border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                                        name="skill_id" id="skill_id">
                                    <option selected>Open this select menu</option>
                                    <option :value="skill.id" v-for="skill in skills" :key="skill.id">
                                        {{skill.name}}
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                            Project Image
                        </label>
                        <input @input="form.image=$event.target.files[0]"
                               class="shadow appearance-none border rounded w-full py-2 px-3
                            text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="image" type="file" name="image">
                    </div>


                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Update
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </AuthenticatedLayout>

</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {createInertiaApp, Head, Link, useForm} from '@inertiajs/inertia-vue3';
import InputError from "../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/InputError.vue";
import InputLabel from "../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/InputLabel.vue";
import TextInput from "../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/TextInput.vue";
import PrimaryButton
    from "../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/PrimaryButton.vue";

import {Inertia} from "@inertiajs/inertia";

 const props=defineProps({
    skills: Array,
    project:Object
});
const form = useForm({
    name: props.project?.name,
    image: null,
    project_url:props.project?.project_url,
    skill_id:props.project?.skill_id
});

const updateProject=()=>{
    Inertia.post(`/projects/${props.project.id}`,{
        _method:"put",
        name:form.name,
        image:form.image,
        skill_id:form.skill_id,
        project_url:form.project_url
    })
}



</script>

