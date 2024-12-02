<template>
    <!-- BoardList -->
    <div class="board-list-box">
        <div v-for="item in boardList" :key="item" @click="openModal(item.board_id)" class="item">
            <img :src="item.img">
        </div>
    </div>

    <!-- Detail Modal -->
    <div v-show="modalFlg" class="board-detail-box">
        <div v-if="boardDetail" class="item">
            <img :src="boardDetail.img">
            <hr>
            <p>제목 : {{ boardDetail.title }}</p>
            <hr>
            <p>내용 : {{ boardDetail.content }}</p>
            <hr>
            <div class="etc-box">
                <span>작성자 : {{ boardDetail.user.name }}</span>
                <div class="etc-box-btn">
                    <!-- <router-link to="/boards/{id}"><button class="btn btn-header btn-bg-black">수정</button></router-link>
                    <router-link to="/boards/{id}"><button class="btn btn-header btn-bg-black">삭제</button></router-link> -->
                    <button @click="closeModal" class="btn btn-header btn-bg-black">닫기</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { computed, onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const boardList = computed(() => store.state.board.boardList);
const boardDetail = computed(() => store.state.board.boardDetail);

onBeforeMount(() => {
    if(store.state.board.boardList.length < 1) {
        store.dispatch('board/boardListPagination');
    }
});

// scroll
const boardScrollEvent = () => {
    if(store.state.board.controllFlg) {

        // console.log('******* 스크롤 이벤트 시작 *******');
        const docHeight = document.documentElement.scrollHeight;
        const winHeight = window.innerHeight;
        const nowHeight = window.scrollY;
        const viewHeight = docHeight - winHeight;
        // console.log('******* 스크롤 이벤트 끝 *******');

        console.log('스크롤 이벤트');

        console.log(viewHeight, nowHeight);

        if(viewHeight <= nowHeight) {
            store.dispatch('board/boardListPagination', true);
        }
    }
}
window.addEventListener('scroll', boardScrollEvent);

// Modal
const modalFlg = ref(false);
const openModal = (id) => {
    // console.log(id);
    store.dispatch('board/showBoard', id);
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}

</script>

<style>
@import url('../../../css/boardList.css');
</style>