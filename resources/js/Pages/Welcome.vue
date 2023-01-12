<template>
    <Head title="Welcome To My Portfolio" />
    <Frontend>
      <!--   Hero Primary     -->
        <Hero></Hero>
      <!--   Promote tail-100   -->
        <Promote></Promote>
      <!--   About secondary    -->
       <About></About>
      <!--   Skill tail-100    -->
        <Skills :skills="skills"></Skills>
      <!--   Portfolio Primary    -->
        <Portfolio :skills="skills" :projects="projects"></Portfolio>
      <!--   Services secondary    -->
        <Services></Services>
      <!--  Contact primary    -->
        <Contact></Contact>
    </Frontend>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Frontend from "@/Layouts/Frontend.vue";
import Hero from "@/Components/Frontend/Hero.vue";
import Promote from "@/Components/Frontend/Promote.vue";
import About from "@/Components/Frontend/About.vue";
import Skills from "@/Components/Frontend/Skills.vue";
import Portfolio from "@/Components/Frontend/Portfolio.vue";
import Services from "@/Components/Frontend/Services.vue";
import Contact from "@/Components/Frontend/Contact.vue";

defineProps({
    skills:Object,
    projects:Object
})
</script>
