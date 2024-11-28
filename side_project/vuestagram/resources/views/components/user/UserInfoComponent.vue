<template>
    <div class="user-info-box">
        <img @click="openModal($store.state.user.userInfo.user_id)" :src="$store.state.user.userInfo.profile">
        <!-- <img :src="$store.state.user.userInfo.profile"> -->
        <div class="user-info-content">
            <h2>{{ $store.state.user.userInfo.account }}</h2>
            <h3>작성글 수 : {{ $store.state.user.userInfo.boards_count }}</h3>
        </div>
        <router-link to="/boards/create"><button class="btn btn-submit">글 작성</button></router-link>
    </div>

    <div v-show="modalFlg" class="board-detail-box">
        <div v-if="userDetail" class="item">
            <!-- <img :src="userDetail.profile"> -->
            <hr>
            <p>{{ userDetail.name }}</p>
            <p>{{ userDetail.account }}</p>
            <p>{{ userDetail.gender }}</p>
            <hr>
            <div class="etc-box">
                <button @click="closeModal" class="btn btn-header btn-bg-black">닫기</button>
            </div>
        </div>
    </div>
</template> 

<script setup>

import { computed, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const userDetail = computed(() => { store.state.user.userInfo});
// const user = computed(() => store.state.user.userInfo);


const modalFlg = ref(false);
const openModal = (id) => {
    // console.log(id);
    store.dispatch('user/showUser', id);
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}

</script>

<style>
@import url('../../../css/userInfo.css');
</style>