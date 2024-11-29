<template>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="header-content">
                <div class="title">
                    <router-link to="/boards"><h1>Pingstagram</h1></router-link>
                </div>
                <img src="/hachu.png" alt="img-logo">
                <div class="btn-group">
                    <div>
                        <router-link to="/login"><button class="btn btn-header btn-bg-black">로그인</button></router-link>
                        <router-link to="/registration"><button class="btn btn-header btn-bg-white">회원가입</button></router-link>
                    </div>
                    <!-- <div>
                        <button class="btn btn-header btn-bg-black">로그아웃</button>
                    </div> -->
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main>
        <UserInfoComponent />
        <br>
        <div class="main_container">
            <router-view></router-view>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>ⓒ 2024. PINGSTAGRAM All rights reserved.</p>
    </footer>
</template>

<script setup>
import UserInfoComponent from './user/UserInfoComponent.vue';
</script>

<style>
    @import url('../../css/common.css');
</style>