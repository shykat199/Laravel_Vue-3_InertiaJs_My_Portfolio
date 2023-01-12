<template>
    <Head title="Project Index"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link
                        :href="route('projects.create')"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">
                        Create New Project
                    </Link>
                </div>

                <div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Project Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Project Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Skill Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Project Url
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Project Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(project,index) in projects.data" :key="project.id"
                                class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ index + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ project.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.skill.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ project.project_url }}
                                </td>
                                <td class="px-6 py-4">
                                    <img class="h-20 w-20 rounded-full" :src="project.image" alt="">
                                </td>
                                <td class="px-6 py-4">
                                    <Link :href="route('projects.edit',project.id)" type="button"
                                          class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </Link>
                                    <Link :href="route('projects.destroy',project.id)" type="button"
                                          method="delete"
                                          as="button"
                                          class="ml-2 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </AuthenticatedLayout>

</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import route from "../../../../vendor/tightenco/ziggy/src/js";

defineProps({
    projects: Object,
})

</script>
