<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const isMenuOpen = ref(false);
</script>

<template>
    <header>
        <nav class="nav-welcome">
            <!-- Logo -->
            <div>
                <img src="/assets/logo/dekra-logo-white.svg" alt="Logo" class="nav-welcome_logo" />
            </div>

            <!-- Desktop links -->
            <div class="nav-welcome-links desktop">
                <template v-if="$page.props.auth.user">
                    <!-- Show Tags and Fragen only for admin users -->
                    <template v-if="$page.props.auth.user.role === 'admin'">
                        <Link :href="route('home')" class="nav-welcome-links_faq">FAQ</Link>
                        <Link :href="route('tags.index')" class="nav-welcome-links_tags">Tags</Link>
                        <Link :href="route('faqs.index')" class="nav-welcome-links_tags">Fragen</Link>
                    </template>
                    <Link :href="route('logout')" method="post" class="nav-welcome-links_login">
                        <img src="/assets/icons/logout.svg" alt="Logout Icon" class="search-icon" />
                        Logout
                    </Link>
                </template>
                <template v-else>
                    <Link :href="route('home')" class="nav-welcome-links_faq">FAQ</Link>
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
                <Link :href="route('home')" class="nav-welcome-links_faq">FAQ</Link>
                <Link :href="route('tags.index')" class="nav-welcome-links_tags">Tags</Link>
                <Link :href="route('faqs.index')" class="nav-welcome-links_tags">Fragen</Link>
                <Link :href="route('login')" class="nav-welcome-links_login">
                    <span class="nav-welcome-links_login_icon"></span>
                    Login
                </Link>
            </template>
        </div>
    </header>
</template>
