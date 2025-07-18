<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const isMenuOpen = ref(false);
</script>

<template>
    <Head title="DEKRA" />

    <header>
        <nav class="nav-welcome">
            <!-- Logo -->
            <div>
                <img src="/assets/logo/dekra-logo-white.svg" alt="Logo" class="nav-welcome_logo" />
            </div>

            <!-- Desktop links -->
            <div class="nav-welcome-links desktop">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</Link>
                <template v-else>
                    <Link :href="route('register')" class="nav-welcome-links_faq">FAQ</Link>
                    <Link :href="route('register')" class="nav-welcome-links_tags">Tags</Link>
                    <Link :href="route('register')" class="nav-welcome-links_tags">Fragen</Link>
                    <Link :href="route('login')" class="nav-welcome-links_login">
                        <span class="nav-welcome-links_login_icon"></span>
                        Login
                    </Link>
                </template>
            </div>

            <!-- Hamburger button -->
            <button class="hamburger" @click="isMenuOpen = !isMenuOpen">☰</button>
        </nav>

        <!-- Mobile menu -->
        <div v-if="isMenuOpen" class="mobile-menu">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')">Dashboard</Link>
            <template v-else>
                <Link :href="route('register')" class="nav-welcome-links_faq">FAQ</Link>
                <Link :href="route('register')" class="nav-welcome-links_tags">Tags</Link>
                <Link :href="route('login')" class="nav-welcome-links_login">
                    <span class="nav-welcome-links_login_icon"></span>
                    Login
                </Link>
            </template>
        </div>
    </header>
</template>
