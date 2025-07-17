<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="DEKRA"> </Head>
    <header class="">
        <nav class="nav-welcome">
            <div>
                <img src="/assets/logo/dekra-logo-white.svg" alt="Logo" class="nav-welcome_logo" />
            </div>
            <div class="nav-welcome-links">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class=""> Dashboard </Link>
                <template v-else>
                    <Link :href="route('register')" class="nav-welcome-links_faq">FAQ</Link>
                    <Link :href="route('register')" class="nav-welcome-links_tags">Tags </Link>
                    <Link :href="route('login')" class="nav-welcome-links_login">
                         <span class="nav-welcome-links_login_icon"></span>
                  
                        Login
                    </Link>
                </template>
            </div>
        </nav>
    </header>
</template>
